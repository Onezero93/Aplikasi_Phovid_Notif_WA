<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-dark {{ request()->is('dashboard') ? 'active bg-gradient-dark text-white' : '' }}" 
                href="{{ url('/dashboard') }}">
                <i class="material-symbols-rounded opacity-5">dashboard</i>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        @if (auth()->user()->status == 'karyawan')
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->is('tugas') ? 'active bg-gradient-dark text-white' : '' }}"
                    href="{{ url('/karyawan/tugas') }}">
                    <i class="material-symbols-rounded opacity-5">event_note</i>
                    <span class="nav-link-text ms-1">Tugas</span>
                </a>
            </li>
        @endif
        @if (auth()->user()->status == 'admin')
            <li class="nav-item">
                <a class="nav-link text-dark{{ request()->is('datapemesanan') ? 'active bg-gradient-dark text-white' : '' }}"
                    href="{{ url('/datapemesanan') }}">
                    <i class="material-symbols-rounded opacity-5">work</i>
                    <span class="nav-link-text ms-1">Data Orderan Jasa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark{{ request()->is('datajasa') ? 'active bg-gradient-dark text-white' : '' }}"
                    href="{{ url('/datajasa') }}">
                    <i class="material-symbols-rounded opacity-5">box</i>
                    <span class="nav-link-text ms-1">Data Jasa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark{{ request()->is('datarekening') ? 'active bg-gradient-dark text-white' : '' }}"
                    href="{{ url('/datarekening') }}">
                    <i class="material-symbols-rounded opacity-5">account_balance</i>
                    <span class="nav-link-text ms-1">Data Rekening</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Data Hak Akses
                </h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->is('datapengguna') ? 'active bg-gradient-dark text-white' : '' }}"
                    href="{{ url('/datapengguna') }}">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Data Pengguna</span>
                </a>
            </li>
        @endif

    </ul>
</div>
