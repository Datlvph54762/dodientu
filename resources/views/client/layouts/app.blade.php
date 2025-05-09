<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Đồ Điện Tử')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Đồ Điện Tử</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Sản phẩm</a>
                    </li>
                </ul>
                <form action="{{ route('products.index') }}" method="GET" class="d-flex align-items-center me-4"
                    role="search">
                    <input class="form-control me-2" type="search" name="keyword" placeholder="Tìm sản phẩm..."
                        value="{{ request('keyword') }}" style="width: 300px;">
                    <button class="btn btn-outline-light" type="submit" title="Tìm kiếm">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light" title="Giỏ hàng">
                        <i class="fas fa-shopping-cart"></i>
                    </a>

                    @auth
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-light" title="Lịch sử mua hàng">
                            <i class="fas fa-history"></i>
                        </a>

                        <span class="badge bg-success" style="font-size: 1rem; padding: 0.6em 1.2em;">
                            👋 {{ Auth::user()->name }}
                        </span>

                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning" title="Quản trị">
                                <i class="fas fa-cogs"></i>
                            </a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" class="d-inline" title="Đăng xuất">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light" title="Đăng nhập">
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                    @endauth
                </div>

            </div>
        </div>
        </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Về chúng tôi</h5>
                    <p>Cửa hàng đồ điện tử uy tín, chất lượng</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <p>Email: info@dodientu.com</p>
                    <p>Điện thoại: 0123 456 789</p>
                </div>
                <div class="col-md-4">
                    <h5>Theo dõi chúng tôi</h5>
                    <div class="social-links">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>