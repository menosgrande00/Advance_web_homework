<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class AdminHomeController extends Controller
{
    public function index()
    {
        $stats = [
            'categories' => Category::count(),
            'active_categories' => Category::where('status', true)->count(),
            'products' => Product::count(),
            'active_products' => Product::where('status', true)->count(),
            'low_stock_products' => Product::whereColumn('stock', '<=', 'minstock')->count(),
        ];

        $latestProducts = Product::with('category')->latest()->take(5)->get();

        return view('admin.index', compact('stats', 'latestProducts'));
    }
}
