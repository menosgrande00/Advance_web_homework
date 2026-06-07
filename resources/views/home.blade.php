@extends('layouts.frontend')

@section('title', 'Products')

@section('content')
    <h1 class="page-title">Products</h1>

    @if($products->count() > 0)
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    @endif

                    <h2>{{ $product->name }}</h2>

                    <p>
                        Category:
                        <a href="{{ route('categories.show', $product->category) }}">
                            {{ $product->category->name }}
                        </a>
                    </p>

                    <p>Price: {{ $product->price }} TL</p>
                    <p>Stock: {{ $product->stock }}</p>

                    <a class="button" href="{{ route('products.show', $product) }}">
                        View Detail
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p>No products found.</p>
    @endif
@endsection