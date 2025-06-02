@extends('layout.index')
@section('content')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 mb-4">
                <div
                    class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between px-3">
                    <h6 class="text-white text-capitalize">Tugas</h6>
                </div>
            </div>

            <div class="container pt-4">
                <div class="row">
                    @php
                        $adaTugasDisetujui = $tugas->contains(function ($item) {
                            return $item->statuspemesanan === 'Setujui';
                        });
                    @endphp
                    @if ($adaTugasDisetujui)
                        @foreach ($tugas as $item)
                            @if ($item->statuspemesanan === 'Setujui')
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card card-blog card-plain shadow-lg border-radius-xl h-100">
                                        <div class="card-header p-0 position-relative">
                                            <a class="d-block shadow-xl border-radius-xl overflow-hidden">
                                                <img src="{{ asset($item->jasa->gambar) }}" alt="Gambar Jasa"
                                                    class="img-fluid shadow border-radius-lg">
                                            </a>

                                            <!-- Dropdown More -->
                                            <div class="position-absolute top-0 end-0 m-2">
                                                <div class="dropdown">
                                                    <button class="btn btn-light btn-sm shadow-sm" type="button"
                                                        id="dropdownMenuButton{{ $item->id_pemesanan }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="dropdownMenuButton{{ $item->id_pemesanan }}">
                                                        <li>
                                                            <button class="dropdown-item text-info"
                                                                data-bs-toggle="offcanvas"
                                                                data-bs-target="#sidebarDetail{{ $item->id_pemesanan }}">
                                                                <i class="fas fa-eye"></i> Detail
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body p-3 text-center">
                                            <a href="#">
                                                <h5 class="text-dark font-weight-bold">{{ $item->jasa->namajasa }}</h5>
                                            </a>
                                            <p class="mb-1 text-sm">Pelanggan: <strong>{{ $item->namapelanggan }}</strong>
                                            </p>
                                            <p class="mb-0 text-sm">Jadwal: <strong>{{ $item->jadwalpemotretan }}</strong>
                                            </p>
                                            <p class="mb-2 text-sm">
                                                Harga: <strong
                                                    class="text-success">Rp{{ number_format($item->totalharga) }}</strong>
                                            </p>
                                            <span class="badge bg-secondary mt-2">{{ $item->status }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sidebar Detail -->
                                <div class="offcanvas offcanvas-end" tabindex="-1"
                                    id="sidebarDetail{{ $item->id_pemesanan }}" aria-labelledby="offcanvasLabel"
                                    data-bs-backdrop="static" data-bs-keyboard="false">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="offcanvasLabel">Detail Tugas</h5>
                                        <button type="button" class="btn ms-auto" data-bs-dismiss="offcanvas"
                                            aria-label="Close">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="offcanvas-body text-center">
                                        <img src="{{ asset($item->jasa->gambar) }}" alt="Gambar Jasa"
                                            class="img-fluid shadow border-radius-lg mb-3" style="max-width: 300px;">
                                        <h4 class="text-dark font-weight-bold">{{ $item->jasa->namajasa }}</h4>
                                        <p class="text-muted text-start mt-3" style="white-space: pre-wrap;">
                                            {{ $item->jasa->deskripsi }}</p>
                                        <p class="text-success font-weight-bold text-center">
                                            Rp{{ number_format($item->jasa->harga) }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada tugas.</p>
                        </div>
                    @endif
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
