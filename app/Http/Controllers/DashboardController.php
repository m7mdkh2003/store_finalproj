<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $ordersCount = Order::count();
        $totalSales = Order::sum('total_price');

        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();

        $latestOrders = Order::with(['user', 'product'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'productsCount',
            'categoriesCount',
            'ordersCount',
            'totalSales',
            'pendingOrders',
            'completedOrders',
            'latestOrders'
        ));
    }
}