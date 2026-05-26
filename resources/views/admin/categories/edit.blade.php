@extends('admin.layouts.app')

@section('content')
    <h1>Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.categories.form')
    </form>
@endsection