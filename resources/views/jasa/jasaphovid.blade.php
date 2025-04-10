@extends('layout.index')
@section('content')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 mb-4">
                <div
                    class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between px-3">
                    <h6 class="text-white text-capitalize">Data Jasa</h6>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambahDataJasa"
                        class="d-flex align-items-center justify-content-center bg-white rounded-circle shadow"
                        style="width: 35px; height: 35px; text-decoration: none;">
                        <i class="material-symbols-rounded text-dark" style="font-size: 24px;">add</i>
                    </a>
                </div>
            </div>

            <div class="container pt-4">
                <div class="row">
                    @foreach ($jasa as $js)
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card card-blog card-plain shadow-lg border-radius-xl h-100">
                                <div class="card-header p-0 position-relative">
                                    <a class="d-block shadow-xl border-radius-xl overflow-hidden">
                                        <img src="{{ asset($js->gambar) }}" alt="Gambar Jasa"
                                            class="img-fluid shadow border-radius-lg">
                                    </a>

                                    <!-- Dropdown More (Titik Tiga) di Pojok Kanan -->
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm shadow-sm" type="button"
                                                id="dropdownMenuButton{{ $js->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i> <!-- Ikon titik tiga -->
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="dropdownMenuButton{{ $js->id }}">
                                                <li>
                                                    <button class="dropdown-item text-info" data-bs-toggle="offcanvas"
                                                    data-bs-target="#sidebarDetail{{ $js->id_jasa }}">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </button>
                                                </li>

                                                <li>
                                                    <button class="dropdown-item text-warning"
                                                    data-bs-toggle="offcanvas"
                                                    data-bs-target="#sidebarUpdate{{ $js->id_jasa }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item text-danger" data-bs-toggle="offcanvas"
                                                        data-bs-target="#sidebarDelete{{ $js->id_jasa }}">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </li>
                                            </ul>
                                            {{-- untuk delete --}}
                                            <div class="offcanvas offcanvas-end" tabindex="-1"
                                                id="sidebarDelete{{ $js->id_jasa }}" aria-labelledby="offcanvasLabel"
                                                data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasLabel">Konfirmasi Hapus
                                                    </h5>
                                                    <button type="button" class="btn ms-auto" data-bs-dismiss="offcanvas"
                                                        aria-label="Close"><i class="fas fa-times"></i></button>
                                                </div>
                                                <div class="offcanvas-body">
                                                    <p>Apakah Anda yakin ingin menghapus<br>
                                                        Jasa<strong> {{ $js->namajasa }}</strong> ini?</p>
                                                    <form action="{{ route('jasa.hapus', $js->id_jasa) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger w-100 mt-3">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                            {{-- untuk edit --}}
                                            <div class="offcanvas offcanvas-end" tabindex="-1" id="sidebarUpdate{{ $js->id_jasa }}" aria-labelledby="offcanvasLabel"
                                                data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasLabel">Perbarui Jasa</h5>
                                                    <button type="button" class="btn ms-auto" data-bs-dismiss="offcanvas" aria-label="Close">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="offcanvas-body">
                                                    <form action="{{ route('jasa.perbarui', $js->id_jasa) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-3 text-center">
                                                            <label for="gambar{{ $js->id_jasa }}" class="form-label d-block">Gambar Jasa</label>
                                                            <img src="{{ asset($js->gambar) }}" alt="Gambar Jasa" class="img-fluid mb-2" width="150" id="previewGambar{{ $js->id_jasa }}" style="cursor: pointer;">
                                                            <input type="file" name="gambar" id="gambar{{ $js->id_jasa }}" class="form-control d-none" accept="image/*">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="namajasa{{ $js->id_jasa }}" class="form-label">Nama Jasa</label>
                                                            <input type="text" name="namajasa" id="namajasa{{ $js->id_jasa }}" class="border-radius-lg text-sm w-100 px-3 py-2" value="{{ $js->namajasa }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="deskripsi{{ $js->id_jasa }}" class="form-label">Deskripsi</label>
                                                            <textarea class="border-radius-lg text-sm w-100 px-3 py-2" id="deskripsi{{ $js->id_jasa }}" name="deskripsi" placeholder="Masukkan Deskripsi" rows="3" required>{{ $js->deskripsi }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga{{ $js->id_jasa }}" class="form-label">Harga</label>
                                                            <input type="text" name="harga" id="harga{{ $js->id_jasa }}" class="border-radius-lg text-sm w-100 px-3 py-2" value="{{ $js->harga }}" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary w-100 mt-3">Perbarui</button>
                                                    </form>
                                                </div>
                                            </div>
                                            {{-- untuk detail --}}
                                            <div class="offcanvas offcanvas-end" tabindex="-1" id="sidebarDetail{{ $js->id_jasa }}" aria-labelledby="offcanvasLabel"
                                                data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasLabel">Detail Jasa</h5>
                                                    <button type="button" class="btn ms-auto" data-bs-dismiss="offcanvas" aria-label="Close">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="offcanvas-body text-center">
                                                    <!-- Gambar Jasa -->
                                                    <img src="{{ asset($js->gambar) }}" alt="Gambar Jasa" class="img-fluid shadow border-radius-lg mb-3" style="max-width: 300px;">

                                                    <!-- Nama Jasa -->
                                                    <h4 class="text-dark font-weight-bold">{{ $js->namajasa }}</h4>

                                                    <!-- Deskripsi & Harga -->
                                                    <div class="text-start mt-3">
                                                        <p class="text-muted" style="white-space: pre-wrap;">{{ $js->deskripsi }}</p>
                                                        <p class="text-success font-weight-bold text-center">Harga: Rp {{ number_format($js->harga, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Dropdown More -->

                                </div>
                                <div class="card-body p-3 text-center">
                                    <a href="#">
                                        <h5 class="text-dark font-weight-bold">{{ $js->namajasa }}</h5>
                                    </a>
                                    <p class="mb-3 text-sm">
                                        Harga: <strong class="text-success">Rp
                                            {{ number_format($js->harga, 0, ',', '.') }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Jasa -->
    <div class="modal fade" id="tambahDataJasa" tabindex="-1" aria-labelledby="tambahJasaLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
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
                                <label for="gambar" class="m-0 p-0" style="cursor: pointer; width: 100%; height: 100%;">
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
                            <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
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
    <script>
        document.querySelectorAll('[id^="previewGambar"]').forEach((preview) => {
            const id = preview.id.replace('previewGambar', '');
            const fileInput = document.getElementById('gambar' + id);

            preview.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

@endsection
