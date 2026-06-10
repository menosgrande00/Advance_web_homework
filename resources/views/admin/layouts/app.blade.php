@extends('adminlte::page')

@section('title', 'Admin Panel')

@section('content_header')
    <h1>@yield('page_title', 'Dashboard')</h1>
@endsection

@section('admin_content')
    @yield('admin_content')
@endsection