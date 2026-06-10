@extends('admin.layouts.app')

@section('page_title', 'Edit Product')

@section('admin_content')
    <div class="card card-warning">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">@include('admin.products.form')</div>
        </form>
    </div>
@endsection
