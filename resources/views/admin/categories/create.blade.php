@extends('admin.layouts.app')

@section('page_title', 'Add Category')

@section('admin_content')
    <div class="card card-primary">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="card-body">@include('admin.categories.form')</div>
        </form>
    </div>
@endsection
