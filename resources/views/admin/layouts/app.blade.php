@extends('adminlte::page')

@section('title', 'Admin Panel')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">@yield('page_title', 'Dashboard')</h1>
        @yield('page_actions')
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @yield('admin_content')
@endsection
