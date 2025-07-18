<div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link text-white{{ request()->is('home') ? 'active bg-gradient-dark text-white' : '' }}"
                    href="{{ url('/') }}">Home</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link text-white" href="jasa.html">Riwayat Pesanan</a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('tentang') ? 'active bg-gradient-dark text-white' : '' }}" href="{{ url('/tentang') }}">Tentang</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white{{ request()->is('riwayat') ? 'active bg-gradient-dark text-white' : '' }}"
                    href="{{ url('/riwayat') }}">Riwayat</a>
            </li>
        </ul>
        @guest
            <ul class="navbar-nav d-flex align-items-center  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a class="btn bg-gradient-danger w-100 mb-0 toast-btn" href="{{ route('login') }}">Login</a>
                </li>
            </ul>
        @endguest
        @auth
            @php
                $foto =
                    Auth::user()->gambar && file_exists(public_path(Auth::user()->gambar))
                        ? Auth::user()->gambar
                        : 'fotos/default.png';
            @endphp

            <div class="dropdown position-relative ms-auto me-3">
                <a class="d-flex align-items-center" href="#" data-bs-toggle="dropdown" role="button"
                    aria-expanded="false" style="padding: 0;">
                    <div style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden;">
                        <img src="{{ asset($foto) }}" alt="User"
                            style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end mt-2" style="margin-right: 10px;">
                    <li><span class="dropdown-item-text fw-bold">{{ Auth::user()->namalengkap }}</span></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="text-center mb-2">
                        <a href="#" class="dropdown-btn-custom" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasPengaturan">
                            <i class="fas fa-cog me-2"></i> Pengaturan
                        </a>
                    </li>
                    <li class="text-center">
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button class="btn bg-gradient-danger mb-2 toast-btn mx-auto d-block"
                                type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
</div>
