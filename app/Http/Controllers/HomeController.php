<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('products')->get();

        $search = $request->search;

        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('welcome', compact('products', 'categories', 'search'));
    }

    public function category(Request $request, Category $category)
    {
        $categories = Category::withCount('products')->get();

        $search = $request->search;

        $products = Product::with('category')
            ->where('category_id', $category->id)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('welcome', compact('products', 'categories', 'category', 'search'));
    }
}