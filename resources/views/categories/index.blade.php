@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="card">
        <h1>إدارة الأصناف</h1>

        <a href="{{ route('categories.create') }}" class="btn">إضافة صنف جديد</a>
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
                    <th>اسم الصنف</th>
                    <th>الوصف</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description ?? '-' }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category) }}" class="btn">تعديل</a>

                            <form method="POST" action="{{ route('categories.destroy', $category) }}" style="display:inline;">
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
                        <td colspan="4">لا توجد أصناف حتى الآن.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px;">
            {{ $categories->links() }}
        </div>
    </div>
@endsection