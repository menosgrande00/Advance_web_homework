@extends('admin.layouts.app')

@section('admin_content')
    <h1>Categories</h1>

    <a class="admin-button" href="{{ route('admin.categories.create') }}">Add Category</a>

    <hr>

    @if($categories->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->status ? 'Active' : 'Passive' }}</td>
                        <td>
                            <div class="actions">
                                <a class="admin-button" href="{{ route('admin.categories.edit', $category) }}">Edit</a>

                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="danger-button" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No categories found.</p>
    @endif
@endsection