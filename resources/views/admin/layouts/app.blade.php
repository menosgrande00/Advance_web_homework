<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f4f4;
            color: #222;
        }

        .admin-navbar {
            background: #111;
            padding: 15px 40px;
        }

        .admin-navbar a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }

        .admin-container {
            width: 90%;
            max-width: 1100px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        h1 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background: #f0f0f0;
        }

        input,
        textarea,
        select {
            width: 100%;
            max-width: 500px;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #bbb;
            border-radius: 4px;
        }

        textarea {
            height: 100px;
        }

        button,
        .admin-button {
            display: inline-block;
            background: #111;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .danger-button {
            background: #b00020;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .actions form {
            display: inline;
        }
    </style>
</head>
<body>

    <nav class="admin-navbar">
        <a href="{{ route('admin.index') }}">Dashboard</a>
        <a href="{{ route('admin.categories.index') }}">Categories</a>
        <a href="{{ route('admin.products.index') }}">Products</a>
        <a href="{{ route('home') }}">Frontend</a>
    </nav>

    <div class="admin-container">
        @yield('content')
    </div>

</body>
</html>