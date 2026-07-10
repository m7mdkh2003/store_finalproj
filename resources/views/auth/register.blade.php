@extends('layouts.app')

@section('title', 'تسجيل حساب')

@section('content')
    <div class="card">
        <h1>تسجيل حساب جديد</h1>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label>الاسم</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn">تسجيل</button>
        </form>

        <p>
            لديك حساب؟
            <a href="{{ route('login') }}">تسجيل الدخول</a>
        </p>
    </div>
@endsection