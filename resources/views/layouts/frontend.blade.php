<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Product Store')</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
            color: #222;
        }

        .navbar {
            background: #222;
            padding: 15px 40px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 30px auto;
        }

        .page-title {
            margin-bottom: 20px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: white;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
        }

        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .product-card h2 {
            font-size: 20px;
            margin: 10px 0;
        }

        .product-card p {
            margin: 6px 0;
        }

        .button {
            display: inline-block;
            background: #222;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .detail-card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .detail-card img {
            max-width: 400px;
            width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('admin.index') }}">Admin Panel</a>

        @auth
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>