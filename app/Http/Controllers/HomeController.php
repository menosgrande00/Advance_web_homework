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
            ->get();

        return view('home', compact('products'));
    }

    public function show(Product $product)
    {
        return view('product-detail', compact('product'));
    }

    public function category(Category $category)
    {
        $products = $category->products()
            ->with('category')
            ->where('status', 1)
            ->get();

        return view('category-products', compact('category', 'products'));
    }
}