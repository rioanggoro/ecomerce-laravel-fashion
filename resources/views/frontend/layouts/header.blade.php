<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <img src="{{ asset('backend/img/logo_primary.png') }}" alt="Logo Prolific" style="height: 30px; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('product-grids') }}">Toko</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about-us') }}">Tentang Kami</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                {{-- Whitlist --}}
                {{-- <li class="nav-item position-relative">
                    <a class="nav-link" href="{{ route('wishlist') }}">
                        <i class="fa-solid fa-heart"></i>
                        <span id="wishlist-count"
                            class="position-absolute top-25 start-70 translate-middle badge rounded-pill bg-danger opacity-75">
                            {{ Helper::wishlistCount() }}
                        </span>
                    </a>
                </li> --}}
                <li class="nav-item position-relative">
                    <a class="nav-link" href="{{ route('cart') }}">
                        <i class="fa-solid fa-shopping-cart"></i>
                        <span id="cart-count"
                            class="position-absolute top-25 start-70 translate-middle badge rounded-pill bg-danger opacity-75">
                            {{ Helper::cartCount() }}
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        @auth
                            @if (Auth::user()->role == 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin') }}" target="_blank"><i></i> Admin
                                        Dashboard</a></li>
                            @else
                                <li><i class="ti-user"></i><a class="dropdown-item" href="{{ route('user') }}"><i></i>Akun
                                        Saya</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('user.logout') }}"><i></i> Logout</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('login.form') }}">Masuk</a></li>
                            <li><a class="dropdown-item" href="{{ route('register.form') }}">Register</a></li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
