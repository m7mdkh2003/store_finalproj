<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Store App')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #111827;
            direction: rtl;
        }

        .container {
            width: 92%;
            margin: 0 auto;
            padding: 30px 0;
        }

        /* Navbar */
        .navbar {
            background: #111827;
            color: white;
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-title {
            font-size: 22px;
            font-weight: bold;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        /* Buttons */
        .btn,
        .store-btn {
            display: inline-block;
            padding: 11px 20px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
            background: #2563eb;
            transition: 0.2s;
        }

        .btn:hover,
        .store-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .btn-primary {
            background: #2563eb;
        }

        .btn-secondary,
        .store-btn-dark {
            background: #4b5563;
        }

        .btn-success,
        .store-btn-success {
            background: #16a34a;
        }

        .btn-danger {
            background: #dc2626;
        }

        /* Cards */
        .page-card,
        .store-section,
        .table-card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .page-header h1 {
            margin: 0;
            font-size: 36px;
            color: #111827;
        }

        .subtitle {
            color: #6b7280;
            font-size: 18px;
            margin-top: 8px;
        }

        /* Hero */
        .store-hero {
            background: white;
            color: #111827;
            padding: 35px;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
            text-align: right;
        }

        .store-hero h1 {
            font-size: 36px;
            margin-top: 0;
            margin-bottom: 12px;
            color: #111827;
        }

        .store-hero p {
            font-size: 18px;
            margin-bottom: 22px;
            color: #4b5563;
        }

        /* Dashboard */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }

        .dashboard-card {
            background: white;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
            text-align: center;
            transition: 0.2s;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card h2 {
            font-size: 28px;
            color: #111827;
            margin-bottom: 12px;
        }

        .dashboard-card p {
            color: #4b5563;
            font-size: 17px;
            margin-bottom: 22px;
        }

        /* Categories */
        .category-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        .category-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 11px 18px;
            background: #f3f4f6;
            color: #111827;
            border-radius: 999px;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #e5e7eb;
            transition: 0.2s;
        }

        .category-pill:hover {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .category-pill.active {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        /* Products */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
        }

        .product-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 22px;
            transition: 0.2s;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
            background: white;
        }

        .product-card h3 {
            font-size: 24px;
            color: #111827;
            margin-top: 0;
            margin-bottom: 12px;
        }

        .product-category {
            display: inline-block;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .product-description {
            color: #4b5563;
            line-height: 1.7;
            min-height: 45px;
            margin-bottom: 14px;
        }

        .product-price {
            font-size: 24px;
            color: #2563eb;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .product-stock {
            color: #374151;
            margin-bottom: 18px;
            font-weight: bold;
        }

        .product-actions {
            margin-top: 15px;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        thead {
            background: #f9fafb;
        }

        th,
        td {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 16px;
            color: #111827;
        }

        th {
            font-weight: bold;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .actions form {
            display: inline-block;
        }

        /* Forms */
        form {
            margin: 0;
        }

        input,
        textarea,
        select {
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 15px;
            margin-bottom: 12px;
        }

        input,
        textarea {
            width: 100%;
        }

        textarea {
            min-height: 110px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        /* Messages */
        .alert-success,
        .success-message {
            background: #dcfce7;
            color: #166534;
            padding: 13px 16px;
            border-radius: 10px;
            margin-top: 18px;
            font-weight: bold;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 13px 16px;
            border-radius: 10px;
            margin-top: 18px;
            font-weight: bold;
        }

        .empty-products,
        .empty-row {
            background: #f9fafb;
            border: 1px dashed #d1d5db;
            padding: 35px;
            border-radius: 14px;
            text-align: center;
            color: #6b7280;
            font-size: 18px;
        }

        .pagination,
        .pagination-wrapper {
            margin-top: 30px;
        }
        .order-form {
    display: block;
}

.quantity-input {
    width: 90px;
    display: block;
    margin: 8px 0 14px;
    text-align: center;
}

.stock-available {
    color: #16a34a;
    font-weight: bold;
}

.stock-empty {
    color: #dc2626;
    font-weight: bold;
}

.status-badge {
    display: inline-block;
    padding: 7px 13px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: bold;
}

.status-pending {
    background: #fef3c7;
    color: #92400e;
}

.status-approved {
    background: #dcfce7;
    color: #166534;
}

.status-rejected {
    background: #fee2e2;
    color: #991b1b;
}

.status-completed {
    background: #dbeafe;
    color: #1e40af;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 24px;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
    text-align: center;
}

.stat-card h3 {
    color: #4b5563;
    font-size: 17px;
    margin-bottom: 12px;
}

.stat-card p {
    color: #2563eb;
    font-size: 32px;
    font-weight: bold;
    margin: 0;
}

.search-form {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}

.search-input {
    flex: 1;
    min-width: 260px;
    margin-bottom: 0;
}

.order-form {
    display: block;
}

.quantity-input {
    width: 90px;
    display: block;
    margin: 8px 0 14px;
    text-align: center;
}

.stock-available {
    color: #16a34a;
    font-weight: bold;
}

.stock-empty {
    color: #dc2626;
    font-weight: bold;
}

.status-badge {
    display: inline-block;
    padding: 7px 13px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: bold;
}

.status-pending {
    background: #fef3c7;
    color: #92400e;
}

.status-approved {
    background: #dcfce7;
    color: #166534;
}

.status-rejected {
    background: #fee2e2;
    color: #991b1b;
}

.status-completed {
    background: #dbeafe;
    color: #1e40af;
}
    </style>
</head>

<body>

    <div class="navbar">
        <div class="navbar-title">
            Store App
        </div>

        <div class="navbar-links">
            <a href="{{ route('home') }}">الرئيسية</a>

            @auth
                <a href="{{ route('dashboard') }}">لوحة التحكم</a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">تسجيل الخروج</button>
                </form>
            @else
                <a href="{{ route('login') }}">تسجيل الدخول</a>
                <a href="{{ route('register') }}">إنشاء حساب</a>
            @endauth
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>