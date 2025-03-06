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
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
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
                                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#hapusDataPengguna{{ $pdk->id_user }}">
                                                        <i class="material-symbols-rounded text-sm me-2">delete</i>Delete
                                                    </a>
                                                    <a href="{{ route('pengguna.edit', $pdk->id_user) }}" class="btn btn-link text-warning px-3 mb-0">
                                                        <i class="material-symbols-rounded text-sm me-2">edit</i>Edit
                                                    </a>
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
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable"> <!-- Tambahkan class ini -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPenggunaLabel">Tambah Data Pengguna</h5>
                    <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah Pengguna -->
                    <form action="{{ route('pengguna.tambah') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="gambar" class="form-label d-block text-center">Foto Profil</label>
                        <div class="d-flex justify-content-center">
                            <div class="position-relative"
                                style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 2px solid #ddd;">
                                <input type="file" id="gambar" name="gambar" accept="image/*" class="d-none"
                                    onchange="previewImage(event)">
                                <label for="gambar" class="m-0 p-0"
                                    style="cursor: pointer; width: 100%; height: 100%;">
                                    <img id="preview" src="https://via.placeholder.com/120" alt=""
                                        style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 50%;">
                                </label>
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
                                <input type="password" class="border-radius-lg text-sm w-100 px-3 py-2" id="password"
                                    name="password" placeholder="Password" required>
                                <span class="input-group-text border-start-0 px-3" onclick="togglePassword()"
                                    style="cursor: pointer;">
                                    <i id="eyeIcon" class="fas fa-eye"></i>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Pengguna -->
    <div class="modal fade" id="hapusDataPengguna{{ $pdk->id_user }}"
        tabindex="-1" aria-labelledby="hapusPenggunaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusPenggunaLabel">Hapus Data
                        Pengguna</h5>
                    <button type="button" class="btn ms-auto"
                        data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Perbarui Pengguna -->
                    <form
                        action="{{ route('pengguna.hapus', $pdk->id_user) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')

                        <!-- Foto Profil -->

                        <div class="d-flex justify-content-center">
                            <div class="position-relative"
                                style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 2px solid #ddd;">
                                <label for="gambar{{ $pdk->id_user }}"
                                    class="m-0 p-0"
                                    style="cursor: pointer; width: 100%; height: 100%;">
                                    <img id="preview{{ $pdk->id_user }}"
                                        src="{{ asset($pdk->gambar ?? 'https://via.placeholder.com/120') }}"
                                        alt="Foto Profil"
                                        style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 50%;">
                                </label>
                            </div>
                        </div>
                        <label class="form-label d-block text-center">Apakah
                            Anda ingin
                            mengahapus data Pengguna
                            {{ $pdk->namalengkap }}?</label>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit"
                                class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var img = document.getElementById('preview');
                img.src = reader.result;
            }
            reader.readAsDataURL(input.files[0]);
        }

        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eyeIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
@endsection
