@extends('admin.layouts.app')

@section('content')
    <h1>Add Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        @include('admin.categories.form')
    </form>
@endsection