<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function create(CartService $cart)
    {
        abort_if($cart->items()->isEmpty(), 404);

        return view('checkout.create', [
            'categories' => Category::where('status', true)->orderBy('name')->get(),
            'items' => $cart->items(),
            'total' => $cart->total(),
        ]);
    }

    public function store(Request $request, CartService $cart)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:2000',
            'note' => 'nullable|string|max:2000',
        ]);
        $quantities = $cart->quantities();

        if ($quantities === []) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $order = DB::transaction(function () use ($data, $quantities, $request) {
            $products = Product::with('category')
                ->whereIn('id', array_keys($quantities))
                ->lockForUpdate()
                ->get();

            if ($products->count() !== count($quantities)) {
                throw ValidationException::withMessages(['cart' => 'A product in your cart is no longer available.']);
            }

            foreach ($products as $product) {
                $quantity = (int) $quantities[$product->id];

                if (! $product->status || ! $product->category?->status || $quantity < 1 || $quantity > $product->stock) {
                    throw ValidationException::withMessages(['cart' => $product->name.' is unavailable or has insufficient stock.']);
                }
            }

            $total = $products->sum(fn ($product) => (float) $product->price * (int) $quantities[$product->id]);
            $order = Order::create([
                'user_id' => $request->user()->id,
                'order_number' => 'ORD-'.Str::upper(Str::random(12)),
                ...$data,
                'total' => $total,
                'status' => 'pending',
            ]);

            foreach ($products as $product) {
                $quantity = (int) $quantities[$product->id];
                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'unit_price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => (float) $product->price * $quantity,
                ]);
                $product->decrement('stock', $quantity);
            }

            return $order;
        });

        $cart->clear();

        return redirect()->route('orders.show', $order)->with('success', 'Your order has been placed.');
    }
}
