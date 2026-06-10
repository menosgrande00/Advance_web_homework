@extends('admin.layouts.app')

@section('admin_content')
    <h1>Product Detail</h1>

    <p>
        <a class="admin-button" href="{{ route('admin.products.index') }}">Back to Products</a>
    </p>

    @if($product->image)
        <p>
            <img src="{{ asset($product->image) }}" width="150">
        </p>
    @endif

    <p><strong>ID:</strong> {{ $product->id }}</p>
    <p><strong>Name:</strong> {{ $product->name }}</p>
    <p><strong>Title:</strong> {{ $product->title }}</p>
    <p><strong>Category:</strong> {{ $product->category->name ?? 'No Category' }}</p>
    <p><strong>Keywords:</strong> {{ $product->keywords }}</p>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Detail:</strong> {{ $product->detail }}</p>
    <p><strong>Price:</strong> {{ $product->price }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>
    <p><strong>Minimum Stock:</strong> {{ $product->minstock }}</p>
    <p><strong>Discount:</strong> {{ $product->discount }}</p>
    <p><strong>Status:</strong> {{ $product->status ? 'Active' : 'Passive' }}</p>
@endsection