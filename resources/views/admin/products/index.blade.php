@extends('admin.layouts.app')

@section('page_title', 'Products')

@section('page_actions')
    <a class="btn btn-primary" href="{{ route('admin.products.create') }}">
        <i class="fas fa-plus mr-1"></i> Add Product
    </a>
@endsection

@section('admin_content')
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                @if ($product->image)
                                    <img class="img-thumbnail" src="{{ asset('storage/'.$product->image) }}"
                                         alt="{{ $product->name }}" style="width: 52px; height: 52px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td class="align-middle">{{ $product->name }}</td>
                            <td class="align-middle">{{ $product->category?->name ?? 'No category' }}</td>
                            <td class="align-middle">{{ number_format($product->price, 2) }}</td>
                            <td class="align-middle">
                                <span class="badge badge-{{ $product->stock <= $product->minstock ? 'warning' : 'info' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="align-middle">
                                <span class="badge badge-{{ $product->status ? 'success' : 'secondary' }}">
                                    {{ $product->status ? 'Active' : 'Passive' }}
                                </span>
                            </td>
                            <td class="align-middle text-right">
                                <a class="btn btn-sm btn-info" href="{{ route('admin.products.show', $product) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-warning" href="{{ route('admin.products.edit', $product) }}"><i class="fas fa-edit"></i></a>
                                <form class="d-inline" action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No products found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($products->hasPages())
            <div class="card-footer">{{ $products->links() }}</div>
        @endif
    </div>
@endsection
