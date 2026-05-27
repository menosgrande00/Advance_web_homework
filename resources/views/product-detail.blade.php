<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>
</head>
<body>

    <p>
        <a href="{{ route('home') }}">Back to Products</a>
    </p>

    <h1>{{ $product->name }}</h1>

    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" width="300">
    @endif

    <p>Category: {{ $product->category->name }}</p>

    <p>Price: {{ $product->price }} TL</p>

    <p>Stock: {{ $product->stock }}</p>

    <p>Status: {{ $product->status ? 'Active' : 'Passive' }}</p>

    <h3>Description</h3>
    <p>{{ $product->description }}</p>

</body>
</html>