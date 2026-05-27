<?php

namespace App\Http\Controllers;

use App\Models\Product;

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
}