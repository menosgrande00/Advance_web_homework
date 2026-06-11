@extends('layouts.frontend')

@section('title', $category->name)
@section('meta_description', $category->description ?: 'Browse products in '.$category->name.'.')

@section('content')
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>{{ $category->name }}</h2>
                        <span>{{ $category->description ?: 'Browse all active products in this category.' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>{{ $category->name }} Products</h2>
                        <span>{{ $products->count() }} {{ Str::plural('product', $products->count()) }} available.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-lg-4 col-md-6">
                        @include('partials.product-card', ['product' => $product])
                    </div>
                @empty
                    <div class="col-12"><div class="section-empty">No products are available in this category.</div></div>
                @endforelse
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <div class="main-border-button"><a href="{{ route('home') }}">Back to All Products</a></div>
                </div>
            </div>
        </div>
    </section>
@endsection
