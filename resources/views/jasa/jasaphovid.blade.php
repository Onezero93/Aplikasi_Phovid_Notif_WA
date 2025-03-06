@extends('layout.index')
@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 mb-4">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between px-3">
                <h6 class="text-white text-capitalize">Data Jasa</h6>
                <a href="#" data-bs-toggle="modal" data-bs-target="#tambahDataJasa"
                    class="d-flex align-items-center justify-content-center bg-white rounded-circle shadow"
                    style="width: 35px; height: 35px; text-decoration: none;">
                    <i class="material-symbols-rounded text-dark" style="font-size: 24px;">add</i>
                </a>
            </div>
        </div>

        <div class="container pt-4">
            <div class="row px-3">
                @foreach ($jasa as $js)
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card card-blog card-plain shadow-lg border-radius-xl h-100">
                            <div class="card-header p-0 position-relative">
                                <a class="d-block shadow-xl border-radius-xl overflow-hidden">
                                    <img src="{{ asset($js->gambar) }}" alt="Gambar Jasa" class="img-fluid shadow border-radius-lg">
                                </a>

                                <!-- Dropdown More (Titik Tiga) di Pojok Kanan -->
                                <div class="position-absolute top-0 end-0 m-2">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton{{ $js->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i> <!-- Ikon titik tiga -->
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $js->id }}">
                                            <li>
                                                <a href="{{ route('jasa.detail', $js->id_jasa) }}" class="dropdown-item text-info">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a class="dropdown-item text-warning" href="{{ route('jasa.edit', $js->id_jasa) }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            
                                                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hapusDataPengguna">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Dropdown More -->

                            </div>
                            <div class="card-body p-3 text-center">
                                <a href="#">
                                    <h5 class="text-dark font-weight-bold">{{ $js->namajasa }}</h5>
                                </a>
                                <p class="mb-3 text-sm">
                                    Harga: <strong class="text-success">Rp {{ number_format($js->harga, 0, ',', '.') }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="tambahDataJasa" tabindex="-1" aria-labelledby="tambahJasaLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable"> <!-- Tambahkan class ini -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="tambahJasaLabel">Tambah Data Jasa</h5>
            <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form Tambah Pengguna -->
            <form action="{{ route('jasa.tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="gambar" class="form-label d-block text-center">Foto Jasa</label>
                <div class="d-flex justify-content-center">
                    <div class="position-relative"
                        style="width: 180px; height: 120px; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 2px solid #ddd;">
                        <input type="file" id="gambar" name="gambar" accept="image/*" class="d-none"
                            onchange="previewImage(event)">
                        <label for="gambar" class="m-0 p-0"
                            style="cursor: pointer; width: 100%; height: 100%;">
                            <img id="preview" src="https://via.placeholder.com/180x120" alt=""
                                style="width: 100%; height: 100%; object-fit: cover; display: block;">
                        </label>
                    </div>
                </div>   
                <label for="namajasa" class="form-label">Nama Jasa</label><br>
                <input type="text" class="border-radius-lg text-sm w-100 px-3 py-2" id="namajasa"
                    name="namajasa" placeholder="Nama Jasa" required>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="border-radius-lg text-sm w-100 px-3 py-2" id="harga"
                        name="harga" placeholder="Harga" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="border-radius-lg text-sm w-100 px-3 py-2" id="deskripsi" name="deskripsi"
                        placeholder="Masukkan Deskripsi" rows="3" required oninput="formatText(this)"></textarea>
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
        
        function formatText(textarea) {
    let lines = textarea.value.split('\n');
    for (let i = 0; i < lines.length; i++) {
        if (!lines[i].startsWith('• ')) {
            lines[i] = '• ' + lines[i].trim();
        }
    }
    textarea.value = lines.join('\n');
}

</script>
@endsection
