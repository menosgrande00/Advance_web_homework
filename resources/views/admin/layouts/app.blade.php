<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>

    <nav>
        <a href="{{ route('admin.index') }}">Dashboard</a>
        |
        <a href="{{ route('admin.categories.index') }}">Categories</a>
        |
        <a href="{{ route('admin.products.index') }}">Products</a>
    </nav>

    <hr>

    <main>
        @yield('content')
    </main>

</body>
</html>