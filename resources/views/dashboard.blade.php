@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="page-card">
    <div class="page-header">
        <div>
            <h1>لوحة التحكم</h1>
            <p class="subtitle">أهلاً {{ auth()->user()->name }}</p>
        </div>

        <a href="{{ route('home') }}" class="btn btn-secondary">
            عرض المتجر
        </a>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h3>المنتجات</h3>
        <p>{{ $productsCount }}</p>
    </div>

    <div class="stat-card">
        <h3>الأصناف</h3>
        <p>{{ $categoriesCount }}</p>
    </div>

    <div class="stat-card">
        <h3>الطلبات</h3>
        <p>{{ $ordersCount }}</p>
    </div>

    <div class="stat-card">
        <h3>إجمالي المبيعات</h3>
        <p>${{ number_format($totalSales, 2) }}</p>
    </div>

    <div class="stat-card">
        <h3>طلبات قيد الانتظار</h3>
        <p>{{ $pendingOrders }}</p>
    </div>

    <div class="stat-card">
        <h3>طلبات مكتملة</h3>
        <p>{{ $completedOrders }}</p>
    </div>
</div>

<div class="dashboard-grid">

    <div class="dashboard-card">
        <h2>Categories</h2>
        <p>إدارة الأصناف</p>

        <a href="{{ route('categories.index') }}" class="btn btn-primary">
            عرض
        </a>
    </div>

    <div class="dashboard-card">
        <h2>Products</h2>
        <p>إدارة المنتجات</p>

        <a href="{{ route('products.index') }}" class="btn btn-primary">
            عرض
        </a>
    </div>

    <div class="dashboard-card">
        <h2>Orders</h2>
        <p>إدارة الطلبات</p>

        <a href="{{ route('orders.index') }}" class="btn btn-primary">
            عرض
        </a>
    </div>

</div>

<div class="table-card">
    <h2>آخر الطلبات</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>المستخدم</th>
                <th>المنتج</th>
                <th>الكمية</th>
                <th>الإجمالي</th>
                <th>الحالة</th>
                <th>التاريخ</th>
            </tr>
        </thead>

        <tbody>
            @forelse($latestOrders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'مستخدم غير معروف' }}</td>
                    <td>{{ $order->product->name ?? 'منتج غير معروف' }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>${{ number_format($order->total_price, 2) }}</td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="status-badge status-pending">قيد الانتظار</span>
                        @elseif($order->status == 'approved')
                            <span class="status-badge status-approved">مقبول</span>
                        @elseif($order->status == 'rejected')
                            <span class="status-badge status-rejected">مرفوض</span>
                        @elseif($order->status == 'completed')
                            <span class="status-badge status-completed">مكتمل</span>
                        @endif
                    </td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-row">لا توجد طلبات حالياً</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection