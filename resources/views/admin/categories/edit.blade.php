@extends('admin.layouts.app')

@section('content')
    <h1>Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Category Name</label>
            <input type="text" name="name" value="{{ $category->name }}">
        </div>

        <div>
            <label>Description</label>
            <textarea name="description">{{ $category->description }}</textarea>
        </div>

        <div>
            <label>Status</label>
            <select name="status">
                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Passive</option>
            </select>
        </div>

        <button type="submit">Update</button>
    </form>
@endsection