@extends('admin.layouts.app')

@section('admin_content')
    <h1>Edit Product</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.products.form')
    </form>
@endsection