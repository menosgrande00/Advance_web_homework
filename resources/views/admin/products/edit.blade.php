@extends('admin.layouts.app')

@section('content')
    <h1>Edit Product</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.products.form')
    </form>
@endsection