<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Web Bán Đồ Điện Tử</title>

    <!-- Link tới Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS (nếu cần) -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Header -->
    <header class="bg-dark text-white p-4">
        <div class="container">
            <div class="d-flex justify-content-between">
                <h1 class="logo">Đồ Điện Tử</h1>
                <nav>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="/" class="text-white">Trang Chủ</a></li>
                        <li class="list-inline-item"><a href="/products" class="text-white">Sản Phẩm</a></li>
                        <li class="list-inline-item"><a href="/cart" class="text-white">Giỏ Hàng</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Banner -->
    
    <!-- Main content -->
    <main class="container mt-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-4 mt-5">
        <p>&copy; 2025 Đồ Điện Tử - Mọi quyền được bảo lưu.</p>
    </footer>

    <!-- Link tới Bootstrap JS và Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
