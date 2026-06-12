<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('meta_description', 'Discover products selected for everyday life at Product Store.')">
    <title>@yield('title', 'Product Store') | Product Store</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/templatemo-hexashop.css') }}">

    <style>
        .header-area .main-nav .logo-text {
            color: #2a2a2a;
            display: inline-block;
            font-size: 25px;
            font-weight: 700;
            letter-spacing: -1px;
            line-height: 80px;
        }
        .header-area .main-nav .logo-text span { color: #777; font-weight: 400; }
        .header-area .main-nav .nav li form { display: inline; }
        .header-area .main-nav .nav li button {
            background: transparent;
            border: 0;
            color: #2a2a2a;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 0;
        }
        .header-area .main-nav .nav li button:hover,
        .header-area .main-nav .nav li a:hover { color: #aaa; }
        .product-thumb {
            align-items: center;
            background: #f7f7f7;
            display: flex;
            height: 350px;
            justify-content: center;
            overflow: hidden;
        }
        .product-thumb img { height: 100%; object-fit: cover; width: 100%; }
        .product-placeholder { color: #aaa; font-size: 64px; }
        .product-meta { color: #777; font-size: 14px; margin-top: 8px; }
        .product-meta a { color: #777; }
        .section-empty { color: #777; padding: 40px 0; text-align: center; }
        .category-card .thumb img { height: 260px; object-fit: cover; width: 100%; }
        .store-intro .right-content img { height: 255px; object-fit: cover; width: 100%; }
        .product-detail-image {
            align-items: center;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            min-height: 480px;
        }
        .product-detail-image img { max-height: 650px; object-fit: contain; width: 100%; }
        .stock-label { color: #777; display: block; margin-top: 20px; }
        .footer-link-button {
            background: transparent;
            border: 0;
            color: #fff;
            padding: 0;
        }
        .store-search { display: flex !important; margin: 20px 8px 0; }
        .store-search input { border: 1px solid #ddd; height: 38px; padding: 0 10px; width: 150px; }
        .store-search button { background: #2a2a2a !important; color: #fff !important; height: 38px; padding: 0 12px !important; }
        .store-form input, .store-form textarea {
            border: 1px solid #ddd;
            padding: 10px;
            width: 100%;
        }
        .store-form label { display: block; font-weight: 600; margin: 15px 0 6px; }
        .store-button {
            background: #2a2a2a;
            border: 1px solid #2a2a2a;
            color: #fff;
            cursor: pointer;
            padding: 10px 18px;
        }
        .store-table { width: 100%; }
        .store-table td, .store-table th { border-bottom: 1px solid #eee; padding: 14px 8px; text-align: left; }
        .store-alert { margin: 110px auto -70px; max-width: 1100px; padding: 14px; }
        .store-alert-success { background: #e8f7ed; color: #236b37; }
        .store-alert-error { background: #fdecec; color: #9b2727; }
        @media (max-width: 991px) {
            .header-area .main-nav .logo-text { line-height: 100px; }
            .header-area .main-nav .nav li form { display: block; }
            .header-area .main-nav .nav li button { height: 50px; width: 100%; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="preloader">
        <div class="jumper"><div></div><div></div><div></div></div>
    </div>

    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <a href="{{ route('home') }}" class="logo logo-text">Product <span>Store</span></a>
                        <ul class="nav">
                            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                            <li>
                                <form class="store-search" action="{{ route('search') }}" method="GET">
                                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Search products">
                                    <button type="submit" aria-label="Search"><i class="fa fa-search"></i></button>
                                </form>
                            </li>
                            @if (($categories ?? collect())->isNotEmpty())
                                <li class="submenu">
                                    <a href="javascript:;">Categories</a>
                                    <ul>
                                        @foreach ($categories as $navigationCategory)
                                            <li><a href="{{ route('categories.show', $navigationCategory) }}">{{ $navigationCategory->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                            @auth
                                <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                                @if (auth()->user()->hasRole('admin'))
                                    <li><a href="{{ route('admin.index') }}">Admin Panel</a></li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit">Logout</button>
                                    </form>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @endauth
                            <li><a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i> Cart ({{ app(\App\Services\CartService::class)->count() }})</a></li>
                        </ul>
                        <a class="menu-trigger"><span>Menu</span></a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    @if (session('success'))
        <div class="store-alert store-alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="store-alert store-alert-error">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="store-alert store-alert-error">{{ $errors->first() }}</div>
    @endif

    <main>@yield('content')</main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="first-item">
                        <h4>Product Store</h4>
                        <p class="text-white">Thoughtfully selected products, clearly presented.</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Browse</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">All Products</a></li>
                        @foreach (($categories ?? collect())->take(3) as $footerCategory)
                            <li><a href="{{ route('categories.show', $footerCategory) }}">{{ $footerCategory->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h4>Account</h4>
                    <ul>
                        @auth
                            @if (auth()->user()->hasRole('admin'))
                                <li><a href="{{ route('admin.index') }}">Admin Panel</a></li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="footer-link-button" type="submit">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Create Account</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <p>&copy; {{ date('Y') }} Product Store. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('frontend/js/jquery-2.1.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/storefront.js') }}"></script>
    @stack('scripts')
</body>
</html>
