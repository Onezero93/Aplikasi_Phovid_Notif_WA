@extends('layout.index')
@section('content')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div
                    class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between px-3">
                    <h6 class="text-white text-capitalize">Tabel Admin</h6>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambahDataPengguna"
                        class="d-flex align-items-center justify-content-center bg-white rounded-circle shadow"
                        style="width: 35px; height: 35px; text-decoration: none;">
                        <i class="material-symbols-rounded text-dark" style="font-size: 24px;">add</i>
                    </a>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Lengkap</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pengguna</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengguna as $pdk)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $pdk->gambar ? asset($pdk->gambar) : asset('assets/img/team-2.jpg') }}"
                                                        class="avatar avatar-sm me-3 border-radius-lg">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $pdk->namalengkap }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $pdk->nomortelepon }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pdk->username }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($pdk->status == 'admin')
                                                <span class="badge badge-sm bg-gradient-success">Admin</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">Karyawan</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            {{-- Offcanvas untuk Delete Data Pengguna --}}
                                            <a href="" class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#sidebarDelete{{ $pdk->id_user }}">
                                                <i class="material-symbols-rounded text-sm me-2">delete</i>Delete
                                            </a>
                                            {{-- untuk delete --}}
                                            <div class="offcanvas offcanvas-end" tabindex="-1"
                                                id="sidebarDelete{{ $pdk->id_user }}" aria-labelledby="offcanvasLabel"
                                                data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn ms-auto" data-bs-dismiss="offcanvas"
                                                        aria-label="Close"><i class="fas fa-times"></i></button>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <div class="position-relative"
                                                        style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 2px solid #ddd;">
                                                        <label for="gambar{{ $pdk->id_user }}" class="m-0 p-0"
                                                            style="cursor: pointer; width: 100%; height: 100%;">
                                                            <img id="preview{{ $pdk->id_user }}"
                                                                src="{{ asset($pdk->gambar ?? 'https://via.placeholder.com/120') }}"
                                                                alt="Foto Profil"
                                                                style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 50%;">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="offcanvas-body">
                                                    <p>Apakah Anda yakin ingin menghapus pengguna<br>
                                                        <strong>{{ $pdk->namalengkap }}</strong> ini?
                                                    </p>
                                                    <form action="{{ route('pengguna.hapus', $pdk->id_user) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger w-100 mt-3">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- tombol untuk Edit -->
                                            <a href="#sidebarUpdate{{ $pdk->id_user }}"
                                                class="btn btn-link text-warning px-3 mb-0" data-bs-toggle="offcanvas">
                                                <i class="material-symbols-rounded text-sm me-2">edit</i>Edit
                                            </a>

                                            <!-- Offcanvas untuk Perbarui Data Pengguna -->
                                            <div class="offcanvas offcanvas-end" tabindex="-1"
                                                id="sidebarUpdate{{ $pdk->id_user }}" aria-labelledby="offcanvasLabel"
                                                data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasLabel">Perbarui Data Pengguna
                                                    </h5>
                                                    <button type="button" class="btn ms-auto" data-bs-dismiss="offcanvas"
                                                        aria-label="Close">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="offcanvas-body">
                                                    <form action="{{ route('pengguna.perbarui', $pdk->id_user) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Foto Profil -->
                                                        <label for="gambar{{ $pdk->id_user }}"
                                                            class="form-label d-block text-center">Foto Profil</label>
                                                        <div class="d-flex justify-content-center mb-3">
                                                            <div class="position-relative"
                                                                style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; border: 3px solid #007bff; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">

                                                                <!-- Input file hidden -->
                                                                <input type="file" id="gambar{{ $pdk->id_user }}"
                                                                    name="gambar" accept="image/*" class="d-none"
                                                                    onchange="previewImage(event, {{ $pdk->id_user }})">

                                                                <!-- Label sebagai tombol upload -->
                                                                <label for="gambar{{ $pdk->id_user }}"
                                                                    class="m-0 p-0 d-flex align-items-center justify-content-center"
                                                                    style="cursor: pointer; width: 100%; height: 100%;">

                                                                    <!-- Gambar Profil -->
                                                                    <img id="previews{{ $pdk->id_user }}"
                                                                        src="{{ asset($pdk->gambar ?? 'https://via.placeholder.com/150') }}"
                                                                        alt="Foto Profil"
                                                                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; transition: 0.3s ease-in-out;">
                                                                </label>
                                                            </div>
                                                        </div>


                                                        <!-- Input Fields -->
                                                        <div class="mb-3">
                                                            <label for="namalengkap" class="form-label">Nama
                                                                Lengkap</label><br>
                                                            <input type="text"
                                                                class="border-radius-lg text-sm w-100 px-3 py-2"
                                                                id="namalengkap" name="namalengkap"
                                                                value="{{ $pdk->namalengkap }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Username</label><br>
                                                            <input type="text"
                                                                class="border-radius-lg text-sm w-100 px-3 py-2"
                                                                id="username" name="username"
                                                                value="{{ $pdk->username }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="password{{ $pdk->id_user }}"
                                                                class="form-label">Password (Kosongkan jika tidak ingin
                                                                mengubah)</label>
                                                            <div class="position-relative">
                                                                <input type="password"
                                                                    class="border-radius-lg text-sm w-100 px-3 py-2 pe-5"
                                                                    id="password{{ $pdk->id_user }}" name="password"
                                                                    placeholder="Masukkan password baru">
                                                                <span
                                                                    class="position-absolute end-0 top-50 translate-middle-y me-3"
                                                                    onclick="togglePassword({{ $pdk->id_user }})"
                                                                    style="cursor: pointer;">
                                                                    <i id="eyeIcon{{ $pdk->id_user }}"
                                                                        class="fas fa-eye"></i>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="nomortelepon" class="form-label">Nomor
                                                                Telepon</label><br>
                                                            <input type="text"
                                                                class="border-radius-lg text-sm w-100 px-3 py-2"
                                                                id="nomortelepon" name="nomortelepon"
                                                                value="{{ $pdk->nomortelepon }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="alamat" class="form-label">Alamat</label><br>
                                                            <textarea class="border-radius-lg text-sm w-100 px-3 py-2" id="alamat" name="alamat" rows="3" required>{{ $pdk->alamat }}</textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">Status</label><br>
                                                            <select
                                                                class="form-select border-radius-lg text-sm w-100 px-3 py-2"
                                                                id="status" name="status" required>
                                                                <option value="admin"
                                                                    {{ $pdk->status == 'admin' ? 'selected' : '' }}>Admin
                                                                </option>
                                                                <option value="karyawan"
                                                                    {{ $pdk->status == 'karyawan' ? 'selected' : '' }}>
                                                                    Karyawan</option>
                                                            </select>
                                                        </div>

                                                        <div class="mt-4">
                                                            <button type="submit"
                                                                class="btn btn-primary w-100 mt-3">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Pengguna -->
    <div class="modal fade" id="tambahDataPengguna" tabindex="-1" aria-labelledby="tambahPenggunaLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable"> <!-- Tambahkan class ini -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPenggunaLabel">Tambah Data Pengguna</h5>
                    <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pengguna.tambah') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="gambar" class="form-label d-block text-center">Foto Profil</label>
                        <div class="d-flex justify-content-center">
                            <div class="position-relative"
                                style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 2px solid #ddd;">
                                <label for="gambaradd" class="m-0 p-0"
                                    style="cursor: pointer; width: 100%; height: 100%;">
                                    <img id="preview-add" src="https://via.placeholder.com/120" alt=""
                                        style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 50%;">
                                </label>
                                <input type="file" id="gambaradd" name="gambar" accept="image/*" class="d-none"
                                    onchange="previewAdd()">
                            </div>
                        </div>
                        <label for="namalengkap" class="form-label">Nama Lengkap</label><br>
                        <input type="text" class="border-radius-lg text-sm w-100 px-3 py-2" id="namalengkap"
                            name="namalengkap" placeholder="Nama Lengkap" required>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="border-radius-lg text-sm w-100 px-3 py-2" id="username"
                                name="username" placeholder="Nama Akses" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="border-radius-lg text-sm w-100 px-3 py-2"
                                    id="passwordInput" name="password" placeholder="Password" required>
                                <span class="input-group-text border-start-0 px-3" onclick="togglePasswordadd()"
                                    style="cursor: pointer;">
                                    <i id="togglePassword" class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nomortelepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="border-radius-lg text-sm w-100 px-3 py-2" id="nomortelepon"
                                name="nomortelepon" placeholder="Nomor Telepon" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="border-radius-lg text-sm w-100 px-3 py-2" id="alamat" name="alamat"
                                placeholder="Masukkan alamat" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select border-radius-lg text-sm w-100 px-3 py-2" id="status"
                                name="status" required>
                                <option value="admin">Admin</option>
                                <option value="karyawan">Karyawan</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewAdd() {
            const input = document.getElementById('gambaradd');
            const preview = document.getElementById('preview-add');

            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "#";
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.querySelector("#togglePassword");
            const passwordInput = document.querySelector("#passwordInput");

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener("click", function() {
                    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                    passwordInput.setAttribute("type", type);
                    this.classList.toggle("fa-eye");
                    this.classList.toggle("fa-eye-slash");
                });
            }
        });
    </script>
    <script>
        function previewImage(event, id_user) {
            let input = event.target;
            let preview = document.getElementById('previews' + id_user);

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.transform = "scale(1.1)"; // Efek kecil saat diubah
                    setTimeout(() => preview.style.transform = "scale(1)", 200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function togglePassword(id_user) {
            let passwordField = document.getElementById('password' + id_user);
            let eyeIcon = document.getElementById('eyeIcon' + id_user);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordField.type = "password";
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
@endsection
