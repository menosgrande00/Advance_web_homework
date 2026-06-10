@extends('admin.layouts.app')

@section('page_title', 'Categories')

@section('page_actions')
    <a class="btn btn-primary" href="{{ route('admin.categories.create') }}">
        <i class="fas fa-plus mr-1"></i> Add Category
    </a>
@endsection

@section('admin_content')
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td class="text-wrap">{{ $category->description ?: '-' }}</td>
                            <td><span class="badge badge-info">{{ $category->products_count }}</span></td>
                            <td>
                                <span class="badge badge-{{ $category->status ? 'success' : 'secondary' }}">
                                    {{ $category->status ? 'Active' : 'Passive' }}
                                </span>
                            </td>
                            <td class="text-right">
                                <a class="btn btn-sm btn-warning" href="{{ route('admin.categories.edit', $category) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form class="d-inline" action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                      onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No categories found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($categories->hasPages())
            <div class="card-footer">{{ $categories->links() }}</div>
        @endif
    </div>
@endsection
