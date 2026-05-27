<!DOCTYPE html>
<html>
<head>
    <title>{{ $category->name }}</title>
</head>
<body>

    <p>
        <a href="{{ route('home') }}">Back to Products</a>
    </p>

    <h1>{{ $category->name }}</h1>

    @if($category->description)
        <p>{{ $category->description }}</p>
    @endif

    <hr>

    @if($products->count() > 0)
        @foreach($products as $product)
            <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px;">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" width="150">
                @endif

                <h2>{{ $product->name }}</h2>

                <p>Price: {{ $product->price }} TL</p>

                <p>Stock: {{ $product->stock }}</p>

                <a href="{{ route('products.show', $product) }}">View Detail</a>
            </div>
        @endforeach
    @else
        <p>No products found in this category.</p>
    @endif

</body>
</html>