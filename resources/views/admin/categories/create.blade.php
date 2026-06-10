@extends('admin.layouts.app')

@section('admin_content')
    <h1>Add Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        @include('admin.categories.form')
    </form>
@endsection