@extends('layouts.frontend')

@section('title', 'Search Products')

@section('content')
    <div class="page-heading" id="top">
        <div class="container"><div class="inner-content">
            <h2>Search Products</h2>
            <span>{{ $term === '' ? 'Browse all active products.' : 'Results for "'.$term.'"' }}</span>
        </div></div>
    </div>
    <section class="section">
        <div class="container">
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-lg-4 col-md-6">@include('partials.product-card', ['product' => $product])</div>
                @empty
                    <div class="col-12"><div class="section-empty">No matching products found.</div></div>
                @endforelse
            </div>
            {{ $products->links() }}
        </div>
    </section>
@endsection
