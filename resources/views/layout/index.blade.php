<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logos/logo.svg') }}">
    <title>
        Phovid
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Material Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Sidebar -->
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand px-4 py-3 m-0" href="" target="_blank">
                <img src="{{ asset('img/logos/logo2.png') }}" class="navbar-brand-img" alt="main_logo">
                <span class="ms-1 text-sm text-dark">PHOVID</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0 mb-2">
        @include('layout.sidebar')
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Aplikasi Jasa FotoGrafer And VidioGrafer</li>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    </div>
                    <ul class="navbar-nav d-flex align-items-center  justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                        </li>
                        <li class="nav-item dropdown pe-3 d-flex align-items-center">
                        </li>
                        <li class="nav-item dropdown pe-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownUser"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @auth
                                    @if (Auth::user())
                                        <img src="{{ asset(Auth::user()->gambar) }}" alt="Foto Pengguna"
                                            class="avatar avatar-sm rounded-circle" style="height: 40px; width: 40px;">
                                    @else
                                        <img src="{{ asset('media/logos/man.png') }}" alt="Default Foto"
                                            class="avatar avatar-sm rounded-circle" style="height: 40px; width: 40px;">
                                    @endif
                                @else
                                    <img src="{{ asset('media/logos/man.png') }}" alt="Default Foto"
                                        class="avatar avatar-sm rounded-circle" style="height: 40px; width: 40px;">
                                @endauth
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownUser">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="#ubahProfil" data-bs-toggle="offcanvas">
                                        <i class="material-symbols-rounded me-2">person</i> Profil Saya
                                    </a>
                                </li>
                                <li>
                                    @auth
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button class="dropdown-item border-radius-md" type="submit">
                                                <i class="material-symbols-rounded me-2">logout</i> Logout
                                            </button>
                                        </form>
                                    @endauth
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Offcanvas Ubah Profil -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="ubahProfil" aria-labelledby="ubahProfilLabel" data-bs-backdrop="static">
    <div class="offcanvas-header">
        <h5 id="ubahProfilLabel">Ubah Profil</h5>
        <button type="button" class="btn ms-auto" data-bs-dismiss="offcanvas" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('profil.perbarui') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="gambar" class="form-label d-block text-center">Foto Profil</label>
            <div class="d-flex justify-content-center mb-3">
                <div class="position-relative"
                    style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 2px solid #ddd;">
                    <input type="file" id="gambar" name="gambar" accept="image/*" class="d-none"
                        onchange="previewImageUbah(event)">
                    <label for="gambar" class="m-0 p-0" style="cursor: pointer; width: 100%; height: 100%;">
                        <img id="previewUbah"
                            src="{{ asset(auth()->user()->gambar ?? 'https://via.placeholder.com/120') }}"
                            alt="Foto Profil"
                            style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 50%;">
                    </label>
                </div>
            </div>

            <label for="namalengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control mb-3" id="namalengkap"
                name="namalengkap" value="{{ auth()->user()->namalengkap }}" required>

            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control mb-3" id="username"
                name="username" value="{{ auth()->user()->username }}" required>

            <label for="password" class="form-label">Password Baru</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control" id="password"
                    name="password" placeholder="Kosongkan jika tidak ingin mengganti">
                <span class="input-group-text" onclick="togglePasswordUbah()" style="cursor: pointer;">
                    <i id="eyeIconUbah" class="fas fa-eye"></i>
                </span>
            </div>

            <label for="nomortelepon" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control mb-3" id="nomortelepon"
                name="nomortelepon" value="{{ auth()->user()->nomortelepon }}">

            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control mb-3" id="alamat" name="alamat" rows="3">{{ auth()->user()->alamat }}</textarea>

            <label for="status" class="form-label">Status</label>
            <input type="text" class="form-control mb-3" id="status"
                name="status" value="{{ auth()->user()->status }}" readonly>

            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
        </form>
    </div>
</div>

        <!-- End Navbar -->
        <div class="container-fluid py-2">
            <div class="row">
                @yield('content')
                {{-- @include('layout.footer') --}}
            </div>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
    <script>
        //untuk spiner
        function togglePasswordUbah() {
        const input = document.getElementById("password");
        const icon = document.getElementById("eyeIconUbah");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }

    function previewImageUbah(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('previewUbah').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
        window.addEventListener("load", function() {
            document.getElementById("preloader").style.display = "none";
        });


    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-dashboard.min.js?v=3.2.0') }}"></script>
</body>

</html>
