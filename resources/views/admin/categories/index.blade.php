@extends('admin.layouts.app')

@section('content')
    <h1>Categories</h1>

    <a href="{{ route('admin.categories.create') }}">Add Category</a>

    <hr>

    @if($categories->count() > 0)
        <ul>
            @foreach($categories as $category)
                <li>
                    {{ $category->name }}

                    <a href="{{ route('admin.categories.edit', $category) }}">Edit</a>

                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No categories found.</p>
    @endif
@endsection