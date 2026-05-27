<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>

    <h1>Products</h1>

    <p>
        <a href="{{ route('admin.index') }}">Admin Panel</a>
    </p>

    <hr>

    @if($products->count() > 0)
        @foreach($products as $product)
            <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px;">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" width="150">
                @endif

                <h2>{{ $product->name }}</h2>

                <p>Category: {{ $product->category->name }}</p>

                <p>Price: {{ $product->price }} TL</p>

                <p>Stock: {{ $product->stock }}</p>

                <a href="{{ route('products.show', $product) }}">View Detail</a>
            </div>
        @endforeach
    @else
        <p>No products found.</p>
    @endif

</body>
</html>