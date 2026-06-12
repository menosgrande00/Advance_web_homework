<div class="item mb-5">
    <div class="thumb product-thumb">
        <div class="hover-content">
            <ul>
                <li>
                    <a href="{{ route('products.show', $product) }}" aria-label="View {{ $product->name }}">
                        <i class="fa fa-eye"></i>
                    </a>
                </li>
                @if ($product->stock > 0)
                    <li>
                        <form action="{{ route('cart.store', $product) }}" method="POST">
                            @csrf
                            <button type="submit" aria-label="Add {{ $product->name }} to cart"><i class="fa fa-shopping-cart"></i></button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
        @if ($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
        @else
            <i class="fa fa-image product-placeholder" aria-hidden="true"></i>
        @endif
    </div>
    <div class="down-content">
        <h4><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h4>
        <span>{{ number_format((float) $product->price, 2) }} TL</span>
        <div class="product-meta">
            <a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a>
            <span class="ml-2">Stock: {{ $product->stock }}</span>
        </div>
        @if ($product->stock < 1)
            <div class="product-meta">Out of stock</div>
        @endif
    </div>
</div>
