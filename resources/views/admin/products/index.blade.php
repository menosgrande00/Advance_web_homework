@extends('admin.layouts.app')

@section('admin_content')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            padding: 8px;
            font-size: 14px;
            word-wrap: break-word;
            vertical-align: middle;
        }

        img {
            max-width: 60px;
            height: auto;
        }

        .actions {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .admin-button,
        .danger-button {
            padding: 6px 10px;
            font-size: 13px;
        }

        .product-image-cell {
            text-align: center;
            vertical-align: middle;
        }

        .product-image-cell img {
            display: block;
            margin: 0 auto;
            max-width: 70px;
            max-height: 70px;
            object-fit: contain;
        }
    </style>

    <h1>Products</h1>

    <a class="admin-button" href="{{ route('admin.products.create') }}">Add Product</a>

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
                    <th>Discount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="product-image-cell">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                            @else
                                No image
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->discount }}</td>
                        <td>{{ $product->status ? 'Active' : 'Passive' }}</td>
                        <td>
                            <div class="actions">
                                <a class="admin-button" href="{{ route('admin.products.show', $product) }}">Show</a>

                                <a class="admin-button" href="{{ route('admin.products.edit', $product) }}">Edit</a>

                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="danger-button" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No products found.</p>
    @endif
@endsection