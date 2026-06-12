@extends('layouts.frontend')

@section('title', $product->name)
@section('meta_description', $product->description ?: 'View details for '.$product->name.'.')

@section('content')
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>{{ $product->name }}</h2>
                        <span>{{ $product->category->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-detail-image">
                        @if ($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        @else
                            <i class="fa fa-image product-placeholder" aria-hidden="true"></i>
                        @endif
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="right-content">
                        <h4>{{ $product->name }}</h4>
                        <span class="price">{{ number_format((float) $product->price, 2) }} TL</span>
                        <span>{{ $product->description ?: 'No description is available for this product.' }}</span>

                        @if ($product->detail)
                            <div class="quote">
                                <i class="fa fa-info-circle"></i>
                                <p>{!! nl2br(e($product->detail)) !!}</p>
                            </div>
                        @endif

                        <span class="stock-label">
                            <strong>Available Stock:</strong> {{ $product->stock }}
                        </span>
                        <span class="stock-label">
                            <strong>Category:</strong>
                            <a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a>
                        </span>

                        @if ($product->stock > 0)
                            <form class="store-form mt-4" action="{{ route('cart.store', $product) }}" method="POST">
                                @csrf
                                <label for="quantity">Quantity</label>
                                <input id="quantity" style="max-width: 100px;" type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1">
                                <button class="store-button ml-2" type="submit">Add To Cart</button>
                            </form>
                        @else
                            <p class="stock-label"><strong>Out of stock</strong></p>
                        @endif

                        <div class="total">
                            <div class="main-border-button">
                                <a href="{{ route('categories.show', $product->category) }}">More from {{ $product->category->name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
