<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'product'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $quantity = $request->quantity;

        if ($product->stock <= 0) {
            return redirect()->route('home')->with('error', 'هذا المنتج غير متوفر حالياً.');
        }

        if ($quantity > $product->stock) {
            return redirect()->route('home')->with('error', 'الكمية المطلوبة أكبر من المخزون المتوفر.');
        }

        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity,
            'status' => 'pending',
        ]);

        $product->decrement('stock', $quantity);

        return redirect()->route('home')->with('success', 'تم إرسال الطلب بنجاح.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,approved,rejected,completed'],
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('orders.index')->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'تم حذف الطلب بنجاح.');
    }
}