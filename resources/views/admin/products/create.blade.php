@extends('admin.layouts.app')

@section('content')
    <h1>Add Product</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('admin.products.form')
    </form>
@endsection