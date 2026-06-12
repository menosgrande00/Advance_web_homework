<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(CartService $cart)
    {
        return view('cart.index', [
            'categories' => Category::where('status', true)->orderBy('name')->get(),
            'items' => $cart->items(),
            'total' => $cart->total(),
        ]);
    }

    public function store(Request $request, Product $product, CartService $cart)
    {
        $data = $request->validate(['quantity' => 'nullable|integer|min:1']);

        abort_unless($product->status && $product->category?->status, 404);

        if ($product->stock < 1) {
            return back()->with('error', 'This product is out of stock.');
        }

        $quantity = (int) ($data['quantity'] ?? 1);

        if ($quantity + (int) ($cart->quantities()[$product->id] ?? 0) > $product->stock) {
            return back()->withErrors(['quantity' => 'Requested quantity exceeds available stock.']);
        }

        $cart->add($product, $quantity);

        return back()->with('success', 'Product added to cart.');
    }

    public function update(Request $request, Product $product, CartService $cart)
    {
        $data = $request->validate(['quantity' => 'required|integer|min:1']);

        if ($data['quantity'] > $product->stock) {
            return back()->withErrors(['quantity' => 'Requested quantity exceeds available stock.']);
        }

        $cart->put($product, $data['quantity']);

        return back()->with('success', 'Cart updated.');
    }

    public function destroy(Product $product, CartService $cart)
    {
        $cart->remove($product);

        return back()->with('success', 'Product removed from cart.');
    }
}
