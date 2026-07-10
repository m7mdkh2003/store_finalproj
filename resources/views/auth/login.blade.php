@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
    <div class="card">
        <h1>تسجيل الدخول</h1>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn">دخول</button>
        </form>

        <p>
            لا تملك حساب؟
            <a href="{{ route('register') }}">تسجيل حساب جديد</a>
        </p>
    </div>
@endsection