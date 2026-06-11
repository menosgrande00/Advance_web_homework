<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', true)
            ->withCount(['products' => fn ($query) => $query->where('status', true)])
            ->orderBy('name')
            ->get();

        $products = Product::with('category')
            ->where('status', true)
            ->whereHas('category', function ($query) {
                $query->where('status', true);
            })
            ->latest()
            ->get();

        return view('home', compact('categories', 'products'));
    }

    public function show(Product $product)
    {
        $product->load('category');

        if (! $product->status || ! $product->category?->status) {
            abort(404);
        }

        $categories = Category::where('status', true)->orderBy('name')->get();

        return view('product-detail', compact('categories', 'product'));
    }

    public function category(Category $category)
    {
        if (! $category->status) {
            abort(404);
        }

        $categories = Category::where('status', true)->orderBy('name')->get();

        $products = $category->products()
            ->with('category')
            ->where('status', true)
            ->latest()
            ->get();

        return view('category-products', compact('categories', 'category', 'products'));
    }
}
