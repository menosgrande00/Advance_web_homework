@extends('admin.layouts.app')

@section('page_title', 'Dashboard')

@section('admin_content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['products'] }}</h3>
                    <p>Total Products</p>
                </div>
                <div class="icon"><i class="fas fa-box"></i></div>
                <a href="{{ route('admin.products.index') }}" class="small-box-footer">
                    Manage products <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['categories'] }}</h3>
                    <p>Total Categories</p>
                </div>
                <div class="icon"><i class="fas fa-list"></i></div>
                <a href="{{ route('admin.categories.index') }}" class="small-box-footer">
                    Manage categories <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['low_stock_products'] }}</h3>
                    <p>Low Stock Products</p>
                </div>
                <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
                <a href="{{ route('admin.products.index') }}" class="small-box-footer">
                    Review stock <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $stats['orders'] }}</h3>
                    <p>Orders ({{ $stats['pending_orders'] }} pending)</p>
                </div>
                <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">
                    Manage orders <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Latest Products</h3>
            <div class="card-tools">
                <span class="badge badge-success">{{ $stats['active_products'] }} active products</span>
                <span class="badge badge-info">{{ $stats['active_categories'] }} active categories</span>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestProducts as $product)
                        <tr>
                            <td><a href="{{ route('admin.products.show', $product) }}">{{ $product->name }}</a></td>
                            <td>{{ $product->category?->name ?? 'No category' }}</td>
                            <td>{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <span class="badge badge-{{ $product->status ? 'success' : 'secondary' }}">
                                    {{ $product->status ? 'Active' : 'Passive' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No products found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
