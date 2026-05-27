@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <p>
        <a href="{{ route('home') }}">← Back to Products</a>
    </p>

    <h1 class="page-title">{{ $category->name }}</h1>

    @if($category->description)
        <p>{{ $category->description }}</p>
    @endif

    @if($products->count() > 0)
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @endif

                    <h2>{{ $product->name }}</h2>

                    <p>Price: {{ $product->price }} TL</p>
                    <p>Stock: {{ $product->stock }}</p>

                    <a class="button" href="{{ route('products.show', $product) }}">
                        View Detail
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p>No products found in this category.</p>
    @endif
@endsection