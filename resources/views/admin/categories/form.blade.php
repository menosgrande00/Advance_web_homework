@if ($errors->any())
    <div>
        <strong>There were some problems:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div>
    <label>Category Name</label>
    <input 
        type="text" 
        name="name" 
        value="{{ old('name', $category->name ?? '') }}"
    >
</div>

<div>
    <label>Description</label>
    <textarea name="description">{{ old('description', $category->description ?? '') }}</textarea>
</div>

<div>
    <label>Status</label>
    <select name="status">
        <option value="1" {{ old('status', $category->status ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>
        <option value="0" {{ old('status', $category->status ?? 1) == 0 ? 'selected' : '' }}>
            Passive
        </option>
    </select>
</div>

<button type="submit">Save</button>