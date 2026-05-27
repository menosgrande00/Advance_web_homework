@extends('admin.layouts.app')

@section('content')
    <h1>Products</h1>

    <a href="{{ route('admin.products.create') }}">Add Product</a>

    <hr>

    @if($products->count() > 0)
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" width="80">
                            @else
                                No image
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->status ? 'Active' : 'Passive' }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}">Edit</a>

                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No products found.</p>
    @endif
@endsection