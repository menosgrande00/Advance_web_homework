@extends('layouts.frontend')

@section('title', 'My Orders')

@section('content')
    <div class="page-heading" id="top"><div class="container"><div class="inner-content"><h2>My Orders</h2><span>Your order history.</span></div></div></div>
    <section class="section"><div class="container">
        <table class="store-table">
            <thead><tr><th>Order</th><th>Date</th><th>Status</th><th>Total</th></tr></thead>
            <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td><a href="{{ route('orders.show', $order) }}">{{ $order->order_number }}</a></td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ number_format((float) $order->total, 2) }} TL</td>
                </tr>
            @empty
                <tr><td colspan="4" class="section-empty">You have no orders yet.</td></tr>
            @endforelse
            </tbody>
        </table>
        {{ $orders->links() }}
    </div></section>
@endsection
