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
    <label>Category</label>
    <select name="category_id">
        <option value="">Select Category</option>

        @foreach($categories as $category)
            <option 
                value="{{ $category->id }}"
                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div>
    <label>Product Name</label>
    <input 
        type="text" 
        name="name" 
        value="{{ old('name', $product->name ?? '') }}"
    >
</div>

<div>
    <label>Keywords</label>
    <input 
        type="text" 
        name="keywords" 
        value="{{ old('keywords', $product->keywords ?? '') }}"
    >
</div>

<div>
    <label>Description</label>
    <textarea name="description">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div>
    <label>Detail</label>
    <textarea name="detail">{{ old('detail', $product->detail ?? '') }}</textarea>
</div>

<div>
    <label>Price</label>
    <input 
        type="number" 
        step="0.01" 
        name="price" 
        value="{{ old('price', $product->price ?? '') }}"
    >
</div>

<div>
    <label>Stock</label>
    <input 
        type="number" 
        name="stock" 
        value="{{ old('stock', $product->stock ?? 0) }}"
    >
</div>

<div>
    <label>Minimum Stock</label>
    <input 
        type="number" 
        name="minstock" 
        value="{{ old('minstock', $product->minstock ?? 0) }}"
    >
</div>

<div>
    <label>Discount</label>
    <input 
        type="number" 
        name="discount" 
        value="{{ old('discount', $product->discount ?? 0) }}"
    >
</div>

<div>
    <label>Status</label>
    <select name="status">
        <option value="1" {{ old('status', $product->status ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>
        <option value="0" {{ old('status', $product->status ?? 1) == 0 ? 'selected' : '' }}>
            Passive
        </option>
    </select>
</div>

<div>
    <label>Image</label>
    <input type="file" name="image">
</div>

@if(isset($product) && $product->image)
    <div>
        <p>Current Image:</p>
        <img src="{{ asset($product->image) }}" width="100">
    </div>
@endif

<button type="submit">Save</button>