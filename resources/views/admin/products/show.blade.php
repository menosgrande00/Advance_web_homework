@extends('admin.layouts.app')

@section('page_title', 'Product Detail')

@section('page_actions')
    <a class="btn btn-warning" href="{{ route('admin.products.edit', $product) }}"><i class="fas fa-edit mr-1"></i> Edit</a>
@endsection

@section('admin_content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    @if ($product->image)
                        <img class="img-fluid rounded" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="text-muted py-5"><i class="fas fa-image fa-4x mb-3"></i><p>No image</p></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">{{ $product->name }}</h3></div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <tr><th>Category</th><td>{{ $product->category?->name ?? 'No category' }}</td></tr>
                        <tr><th>Price</th><td>{{ number_format($product->price, 2) }}</td></tr>
                        <tr><th>Stock / Minimum</th><td>{{ $product->stock }} / {{ $product->minstock }}</td></tr>
                        <tr><th>Discount</th><td>{{ $product->discount }}</td></tr>
                        <tr><th>Status</th><td>{{ $product->status ? 'Active' : 'Passive' }}</td></tr>
                        <tr><th>Keywords</th><td>{{ $product->keywords ?: '-' }}</td></tr>
                        <tr><th>Description</th><td>{{ $product->description ?: '-' }}</td></tr>
                        <tr><th>Detail</th><td>{!! nl2br(e($product->detail ?: '-')) !!}</td></tr>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">Back to Products</a>
                </div>
            </div>
        </div>
    </div>
@endsection
