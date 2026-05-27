<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->get();

        return view('home', compact('products'));
    }

    public function show(Product $product)
    {
        if ($product->status != 1 || $product->category->status != 1) {
            abort(404);
        }

        return view('product-detail', compact('product'));
    }

    public function category(Category $category)
    {
        if ($category->status != 1) {
            abort(404);
        }

        $products = $category->products()
            ->with('category')
            ->where('status', 1)
            ->get();

        return view('category-products', compact('category', 'products'));
    }
}