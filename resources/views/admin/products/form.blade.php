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

<div class="row">
    <div class="form-group col-md-6">
        <label for="category_id">Category</label>
        <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id" required>
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="name">Product Name</label>
        <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name"
               value="{{ old('name', $product->name ?? '') }}" required autofocus>
    </div>
</div>

<div class="form-group">
    <label for="keywords">Keywords</label>
    <input id="keywords" class="form-control @error('keywords') is-invalid @enderror" type="text" name="keywords"
           value="{{ old('keywords', $product->keywords ?? '') }}">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
              rows="3">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="detail">Detail</label>
    <textarea id="detail" class="form-control @error('detail') is-invalid @enderror" name="detail"
              rows="5">{{ old('detail', $product->detail ?? '') }}</textarea>
</div>

<div class="row">
    <div class="form-group col-md-3">
        <label for="price">Price</label>
        <input id="price" class="form-control @error('price') is-invalid @enderror" type="number" step="0.01" min="0"
               name="price" value="{{ old('price', $product->price ?? '') }}" required>
    </div>
    <div class="form-group col-md-3">
        <label for="stock">Stock</label>
        <input id="stock" class="form-control @error('stock') is-invalid @enderror" type="number" min="0"
               name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required>
    </div>
    <div class="form-group col-md-3">
        <label for="minstock">Minimum Stock</label>
        <input id="minstock" class="form-control @error('minstock') is-invalid @enderror" type="number" min="0"
               name="minstock" value="{{ old('minstock', $product->minstock ?? 0) }}">
    </div>
    <div class="form-group col-md-3">
        <label for="discount">Discount</label>
        <input id="discount" class="form-control @error('discount') is-invalid @enderror" type="number" min="0"
               name="discount" value="{{ old('discount', $product->discount ?? 0) }}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6">
        <label for="status">Status</label>
        <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
            <option value="1" @selected(old('status', $product->status ?? 1) == 1)>Active</option>
            <option value="0" @selected(old('status', $product->status ?? 1) == 0)>Passive</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="image">Image</label>
        <div class="custom-file">
            <input id="image" class="custom-file-input @error('image') is-invalid @enderror" type="file" name="image" accept="image/*">
            <label class="custom-file-label" for="image">Choose image</label>
        </div>
    </div>
</div>

@if (isset($product) && $product->image)
    <div class="mb-3">
        <p class="mb-1 font-weight-bold">Current Image</p>
        <img class="img-thumbnail" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="120">
    </div>
@endif

<div class="d-flex justify-content-between">
    <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">Cancel</a>
    <button class="btn btn-primary" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
</div>
