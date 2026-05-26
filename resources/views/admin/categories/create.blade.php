@extends('admin.layouts.app')

@section('content')
    <h1>Add Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div>
            <label>Category Name</label>
            <input type="text" name="name">
        </div>

        <div>
            <label>Description</label>
            <textarea name="description"></textarea>
        </div>

        <div>
            <label>Status</label>
            <select name="status">
                <option value="1">Active</option>
                <option value="0">Passive</option>
            </select>
        </div>

        <button type="submit">Save</button>
    </form>
@endsection