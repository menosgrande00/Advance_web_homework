@extends('layouts.frontend')

@section('title', 'Checkout')

@section('content')
    <div class="page-heading" id="top"><div class="container"><div class="inner-content"><h2>Checkout</h2><span>Enter your delivery information.</span></div></div></div>
    <section class="section"><div class="container"><div class="row">
        <div class="col-lg-7">
            <form class="store-form" action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <label for="customer_name">Customer Name</label>
                <input id="customer_name" name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" required>
                <label for="phone">Phone</label>
                <input id="phone" name="phone" value="{{ old('phone') }}" required>
                <label for="address">Delivery Address</label>
                <textarea id="address" name="address" rows="5" required>{{ old('address') }}</textarea>
                <label for="note">Order Note</label>
                <textarea id="note" name="note" rows="3">{{ old('note') }}</textarea>
                <button class="store-button mt-4" type="submit">Place Order</button>
            </form>
        </div>
        <div class="col-lg-5">
            <h4>Order Summary</h4>
            <table class="store-table">
                @foreach ($items as $product)
                    <tr><td>{{ $product->name }} x {{ $product->cart_quantity }}</td><td>{{ number_format($product->cart_subtotal, 2) }} TL</td></tr>
                @endforeach
                <tr><th>Total</th><th>{{ number_format($total, 2) }} TL</th></tr>
            </table>
        </div>
    </div></div></section>
@endsection
