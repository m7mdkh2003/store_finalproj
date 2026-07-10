@extends('layouts.app')

@section('title', 'Orders')

@section('content')

<div class="page-card">
    <div class="page-header">
        <div>
            <h1>إدارة الطلبات</h1>
            <p class="subtitle">عرض الطلبات وتحديث حالتها</p>
        </div>

        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            رجوع للوحة التحكم
        </a>
    </div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>اسم المستخدم</th>
                <th>اسم المنتج</th>
                <th>الكمية</th>
                <th>السعر الإجمالي</th>
                <th>الحالة</th>
                <th>تاريخ الطلب</th>
                <th>الإجراءات</th>
            </tr>
        </thead>

        <tbody>
            @forelse($orders as $order)
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
                        @else
                            <span class="status-badge">{{ $order->status }}</span>
                        @endif
                    </td>

                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>

                    <td>
                        <div class="actions">
                            <form action="{{ route('orders.status', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <select name="status">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                        قيد الانتظار
                                    </option>

                                    <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }}>
                                        مقبول
                                    </option>

                                    <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>
                                        مرفوض
                                    </option>

                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                        مكتمل
                                    </option>
                                </select>

                                <button type="submit" class="btn btn-success">
                                    تحديث
                                </button>
                            </form>

                            <form action="{{ route('orders.destroy', $order) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger"
                                        onclick="return confirm('هل أنت متأكد من حذف هذا الطلب؟')">
                                    حذف
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="empty-row">
                        لا توجد طلبات حالياً
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $orders->links() }}
    </div>
</div>

@endsection