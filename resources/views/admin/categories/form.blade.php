@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Please check the form.</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="name">Category Name</label>
    <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name"
           value="{{ old('name', $category->name ?? '') }}" required autofocus>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
              rows="4">{{ old('description', $category->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="image">Homepage Card Image</label>
    <input id="image" class="form-control-file @error('image') is-invalid @enderror" type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
    @if (isset($category) && $category->image_url)
        <img class="img-thumbnail mt-2" src="{{ $category->image_url }}" alt="{{ $category->name }}" style="width: 180px; height: 110px; object-fit: cover;">
    @endif
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
        <option value="1" @selected(old('status', $category->status ?? 1) == 1)>Active</option>
        <option value="0" @selected(old('status', $category->status ?? 1) == 0)>Passive</option>
    </select>
</div>

<div class="d-flex justify-content-between">
    <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}">Cancel</a>
    <button class="btn btn-primary" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
</div>
