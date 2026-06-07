<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
            'keywords' => 'nullable|string|max:255',
            'detail' => 'nullable|string',
            'minstock' => 'nullable|integer|min:0',
            'discount' => 'nullable|integer|min:0',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'title' => $request->name,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'detail' => $request->detail,
            'price' => $request->price,
            'stock' => $request->stock,
            'minstock' => $request->minstock ?? 0,
            'discount' => $request->discount ?? 0,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category', 'user');

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|boolean',
            'keywords' => 'nullable|string|max:255',
            'detail' => 'nullable|string',
            'minstock' => 'nullable|integer|min:0',
            'discount' => 'nullable|integer|min:0',
        ]);

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'user_id' => $product->user_id ?? auth()->id(),
            'name' => $request->name,
            'title' => $request->name,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'detail' => $request->detail,
            'price' => $request->price,
            'stock' => $request->stock,
            'minstock' => $request->minstock ?? 0,
            'discount' => $request->discount ?? 0,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
