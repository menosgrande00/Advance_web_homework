@extends('layouts.frontend')

@section('title', 'Order '.$order->order_number)

@section('content')
    <div class="page-heading" id="top"><div class="container"><div class="inner-content"><h2>{{ $order->order_number }}</h2><span>Status: {{ ucfirst($order->status) }}</span></div></div></div>
    <section class="section"><div class="container">
        <p><strong>Customer:</strong> {{ $order->customer_name }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Address:</strong> {{ $order->address }}</p>
        @if ($order->note)<p><strong>Note:</strong> {{ $order->note }}</p>@endif
        <table class="store-table mt-4">
            <thead><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th></tr></thead>
            <tbody>
            @foreach ($order->items as $item)
                <tr><td>{{ $item->product_name }}</td><td>{{ number_format((float) $item->unit_price, 2) }} TL</td><td>{{ $item->quantity }}</td><td>{{ number_format((float) $item->subtotal, 2) }} TL</td></tr>
            @endforeach
            <tr><th colspan="3">Total</th><th>{{ number_format((float) $order->total, 2) }} TL</th></tr>
            </tbody>
        </table>
    </div></section>
@endsection
