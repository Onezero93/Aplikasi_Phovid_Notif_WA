@extends('layout.index') {{-- Sesuaikan dengan layout yang digunakan --}}

@section('content')
<div class="container">
    <h3 class="mb-4">Perbarui Data Pengguna</h3>

    <form action="{{ route('pengguna.perbarui', $perbarui->id_user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Foto Profil -->
        <!-- Label di luar div untuk tetap berada di atas gambar -->
<label for="gambar{{ $perbarui->id_user }}" class="form-label d-block text-center">Foto Profil</label>

<div class="d-flex justify-content-center mb-3">
    <div class="position-relative" style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; border: 2px solid #ddd;">
        <input type="file" id="gambar{{ $perbarui->id_user }}" name="gambar" accept="image/*" class="d-none"
            onchange="previewImage(event, {{ $perbarui->id_user }})">
        <label for="gambar{{ $perbarui->id_user }}" class="m-0 p-0" style="cursor: pointer;">
            <img id="preview{{ $perbarui->id_user }}" 
                src="{{ asset($perbarui->gambar ?? 'https://via.placeholder.com/120') }}"
                alt="Foto Profil" 
                style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; aspect-ratio: 1/1; display: block;">
        </label>
    </div>
</div>


        <!-- Nama Lengkap -->
        <label for="namalengkap" class="form-label">Nama Lengkap</label>
        <input type="text" class="border-radius-lg text-sm w-100 px-3 py-2" id="namalengkap" name="namalengkap" value="{{ $perbarui->namalengkap }}" required>

        <!-- Username -->
        <label for="username" class="form-label">Username</label>
        <input type="text" class="border-radius-lg text-sm w-100 px-3 py-2" id="username" name="username" value="{{$perbarui->username}}" required>

        <!-- Password (Opsional) -->
        <label for="password{{ $perbarui->id_user }}" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
        <div class="input-group">
            <input type="password" class="border-radius-lg text-sm w-100 px-3 py-2" id="password{{ $perbarui->id_user }}" name="password"
                placeholder="Masukkan password baru">
                <span class="input-group-text border-start-0" onclick="togglePassword({{ $perbarui->id_user }})" style="cursor: pointer; padding-right: 12px;">
                    <i id="eyeIcon{{ $perbarui->id_user }}" class="fas fa-eye ms-2"></i>
                </span>
                
        </div>

        <!-- Nomor Telepon -->
        <label for="nomortelepon" class="form-label">Nomor Telepon</label>
        <input type="text" class="border-radius-lg text-sm w-100 px-3 py-2" id="nomortelepon" name="nomortelepon" value="{{$perbarui->nomortelepon }}" required>

        <!-- Alamat -->
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="border-radius-lg text-sm w-100 px-3 py-2" id="alamat" name="alamat" rows="3" required>{{  $perbarui->alamat }}</textarea>

        <!-- Status -->
        <label for="status" class="form-label">Status</label>
        <select class="form-select ps-3" id="status" name="status" required>
            <option value="admin" {{ $perbarui->status == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="karyawan" {{ $perbarui->status == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
        </select>        

        <div class="mt-4">
            <a href="{{ route('pengguna.datapengguna') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script>
    function previewImage(event, id_user) {
        let reader = new FileReader();
        reader.onload = function() {
            document.getElementById('preview' + id_user).src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
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

