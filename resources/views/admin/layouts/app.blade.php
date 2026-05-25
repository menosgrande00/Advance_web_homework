<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>

    <nav>
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </nav>

    <hr>

    <main>
        @yield('content')
    </main>

</body>
</html>