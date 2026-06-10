@extends('admin.layouts.app')

@section('page_title', 'Edit Category')

@section('admin_content')
    <div class="card card-warning">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">@include('admin.categories.form')</div>
        </form>
    </div>
@endsection
