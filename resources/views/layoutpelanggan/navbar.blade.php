<div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link text-white{{ request()->is('home') ? 'active bg-gradient-dark text-white' : '' }}" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="jasa.html">Riwayat Pesanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="tentang.html">Tentang</a>
            </li>
        </ul>
        <ul class="navbar-nav d-flex align-items-center  justify-content-end">
            <li class="nav-item d-flex align-items-center">
                <a class="btn bg-gradient-danger w-100 mb-0 toast-btn {{ request()->is('login')}}" href="{{ url('/login') }}" target="_blank">Login</a>
            </li>
        </ul>
    </div>
</div>
