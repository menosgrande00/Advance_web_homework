@extends('admin.layouts.app')

@section('page_title', 'Add Product')

@section('admin_content')
    <div class="card card-primary">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">@include('admin.products.form')</div>
        </form>
    </div>
@endsection
