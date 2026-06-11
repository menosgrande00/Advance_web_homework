@extends('layouts.frontend')

@section('title', 'Home')

@section('content')
    <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                                <h4>Welcome to Product Store</h4>
                                <span>Simple choices, useful products and clear details.</span>
                                <div class="main-border-button">
                                    <a href="#products">Browse Products</a>
                                </div>
                            </div>
                            <img src="{{ asset('frontend/images/left-banner-image.jpg') }}" alt="Product Store collection">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            @forelse ($categories->take(4) as $category)
                                <div class="col-lg-6 category-card">
                                    <div class="right-first-image">
                                        <div class="thumb">
                                            <div class="inner-content">
                                                <h4>{{ $category->name }}</h4>
                                                <span>{{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}</span>
                                            </div>
                                            <div class="hover-content">
                                                <div class="inner">
                                                    <h4>{{ $category->name }}</h4>
                                                    <p>{{ Str::limit($category->description ?: 'Explore products selected for this category.', 90) }}</p>
                                                    <div class="main-border-button">
                                                        <a href="{{ route('categories.show', $category) }}">Discover More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <img src="{{ asset('frontend/images/baner-right-image-0'.($loop->iteration).'.jpg') }}" alt="{{ $category->name }}">
                                        </div>
                                    </div>
                                </div>
                            @empty
                                @foreach (['Everyday Essentials', 'Quality Selection', 'Clear Details', 'Easy Browsing'] as $feature)
                                    <div class="col-lg-6 category-card">
                                        <div class="right-first-image">
                                            <div class="thumb">
                                                <div class="inner-content"><h4>{{ $feature }}</h4><span>Product Store</span></div>
                                                <img src="{{ asset('frontend/images/baner-right-image-0'.($loop->iteration).'.jpg') }}" alt="{{ $feature }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforelse
                        </div>
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
                        <h2>Latest Products</h2>
                        <span>Browse the newest active products in our store.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-lg-4 col-md-6">
                        @include('partials.product-card', ['product' => $product])
                    </div>
                @empty
                    <div class="col-12"><div class="section-empty">No products are available yet.</div></div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section store-intro" id="about-store">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <h2>A Clearer Way to Browse</h2>
                        <span>Product Store keeps shopping simple by presenting the information that matters without unnecessary distractions.</span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i>
                            <p>Useful products deserve clear descriptions and an easy browsing experience.</p>
                        </div>
                        <p>Explore active categories, compare product details and check current stock directly from each product page.</p>
                        <div class="main-border-button"><a href="#products">View Products</a></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="leather"><h4>Selected Products</h4><span>Simple and useful</span></div>
                            </div>
                            <div class="col-lg-6"><div class="first-image"><img src="{{ asset('frontend/images/explore-image-01.jpg') }}" alt="Selected products"></div></div>
                            <div class="col-lg-6"><div class="second-image"><img src="{{ asset('frontend/images/explore-image-02.jpg') }}" alt="Product details"></div></div>
                            <div class="col-lg-6">
                                <div class="types"><h4>Clear Details</h4><span>Everything you need</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
