@extends('layouts.frontend')

@section('title', $product->name)

@section('content')
    <p>
        <a href="{{ route('home') }}">← Back to Products</a>
    </p>

    <div class="detail-card">
        <h1>{{ $product->name }}</h1>

        @if($product->image)
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
        @endif

        <p>
            <strong>Category:</strong>
            <a href="{{ route('categories.show', $product->category) }}">
                {{ $product->category->name }}
            </a>
        </p>

        <p><strong>Price:</strong> {{ $product->price }} TL</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>
        <p><strong>Status:</strong> {{ $product->status ? 'Active' : 'Passive' }}</p>

        <h3>Description</h3>
        <p>{{ $product->description }}</p>
    </div>
@endsection