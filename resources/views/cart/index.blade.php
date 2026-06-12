@extends('layouts.frontend')

@section('title', 'Shopping Cart')

@section('content')
    <div class="page-heading" id="top"><div class="container"><div class="inner-content"><h2>Shopping Cart</h2><span>Review your products before checkout.</span></div></div></div>
    <section class="section"><div class="container">
        @if ($items->isEmpty())
            <div class="section-empty">Your cart is empty.</div>
        @else
            <div class="table-responsive">
                <table class="store-table">
                    <thead><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th></th></tr></thead>
                    <tbody>
                    @foreach ($items as $product)
                        <tr>
                            <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                            <td>{{ number_format((float) $product->price, 2) }} TL</td>
                            <td>
                                <form action="{{ route('cart.update', $product) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input style="border:1px solid #ddd; padding:8px; width:75px;" type="number" name="quantity" min="1" max="{{ $product->stock }}" value="{{ $product->cart_quantity }}">
                                    <button class="store-button" type="submit">Update</button>
                                </form>
                            </td>
                            <td>{{ number_format($product->cart_subtotal, 2) }} TL</td>
                            <td>
                                <form action="{{ route('cart.destroy', $product) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="store-button" type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-right mt-4">
                <h4>Total: {{ number_format($total, 2) }} TL</h4>
                <a class="store-button d-inline-block mt-3" href="{{ route('checkout.create') }}">Proceed to Checkout</a>
            </div>
        @endif
    </div></section>
@endsection
