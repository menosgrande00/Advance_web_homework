<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->string('status')->toString();
        $orders = Order::with('user')
            ->when(in_array($status, Order::STATUSES, true), fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.orders.index', compact('orders', 'status'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', ['order' => $order->load('user', 'items')]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate(['status' => ['required', Rule::in(Order::STATUSES)]]);

        DB::transaction(function () use ($order, $data) {
            $order = Order::whereKey($order->id)->lockForUpdate()->firstOrFail();

            if ($order->cancelled_at === null && $data['status'] === 'cancelled') {
                $order->load('items');
                foreach ($order->items as $item) {
                    if ($item->product_id) {
                        $item->product()->increment('stock', $item->quantity);
                    }
                }
                $order->cancelled_at = now();
            }

            $order->status = $data['status'];
            $order->save();
        });

        return back()->with('success', 'Order status updated.');
    }
}
