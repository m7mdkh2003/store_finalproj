@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="card">
        <h1>إدارة المنتجات</h1>

        <a href="{{ route('products.create') }}" class="btn">إضافة منتج جديد</a>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">رجوع للوحة التحكم</a>
    </div>

    @if (session('success'))
        <div class="card" style="background:#dcfce7;color:#166534;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المنتج</th>
                    <th>الصنف</th>
                    <th>السعر</th>
                    <th>المخزون</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}" class="btn">تعديل</a>

                            <form method="POST" action="{{ route('products.destroy', $product) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">لا توجد منتجات حتى الآن.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px;">
            {{ $products->links() }}
        </div>
    </div>
@endsection