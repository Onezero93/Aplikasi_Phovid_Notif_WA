@extends('layout.index')
@section('content')
    <div class="col-10 mx-auto">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div
                    class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between px-3">
                    <h6 class="text-white text-capitalize">Tabel Rekening</h6>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambahDataRekening"
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Pemilik</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Rekening</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nomor Rekening</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekening as $rek)
                                    <tr>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $rek->namapemilik }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $rek->namabang }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $rek->nomorrek }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="#sidebarDelete{{ $rek->id_rekening }}" class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                data-bs-toggle="offcanvas">
                                                <i class="material-symbols-rounded text-sm me-2">delete</i>Delete
                                            </a>
                                            {{-- untuk delete --}}
                                            <div class="offcanvas offcanvas-end" tabindex="-1"
                                                id="sidebarDelete{{ $rek->id_rekening }}" aria-labelledby="offcanvasLabel"
                                                data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn ms-auto" data-bs-dismiss="offcanvas"
                                                        aria-label="Close"><i class="fas fa-times"></i></button>
                                                </div>
                                                <div class="offcanvas-body">
                                                    <p>Apakah Anda yakin ingin menghapus<br>
                                                        Rekening<strong> {{ $rek->namabang }}</strong> ini?</p>
                                                    <form action="{{ route('rekening.hapus', $rek->id_rekening) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger w-100 mt-3">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- untuk Edit -->
                                            <a href="#sidebarUpdate{{ $rek->id_rekening }}"
                                                class="btn btn-link text-warning px-3 mb-0" data-bs-toggle="offcanvas">
                                                <i class="material-symbols-rounded text-sm me-2">edit</i>Edit
                                            </a>

                                            <!-- Offcanvas untuk Perbarui Data Pengguna -->
                                            <div class="offcanvas offcanvas-end" tabindex="-1"
                                                id="sidebarUpdate{{ $rek->id_rekening }}" aria-labelledby="offcanvasLabel"
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
                                                    <form action="{{ route('rekening.perbarui', $rek->id_rekening) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <!-- Input Fields -->
                                                        <div class="mb-3">
                                                            <label for="namapemilik" class="form-label">Nama
                                                                Pemilik</label><br>
                                                            <input type="text"
                                                                class="border-radius-lg text-sm w-100 px-3 py-2"
                                                                id="namapemilik" name="namapemilik"
                                                                value="{{ $rek->namapemilik }}" required
                                                                oninput="this.value = this.value.toUpperCase();">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="namabang" class="form-label">Nama
                                                                Bang</label><br>
                                                            <input type="text"
                                                                class="border-radius-lg text-sm w-100 px-3 py-2"
                                                                id="namabang" name="namabang" value="{{ $rek->namabang }}"
                                                                required oninput="this.value = this.value.toUpperCase();">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="nomorrek" class="form-label">Nomor
                                                                Rekening</label><br>
                                                            <input type="number"
                                                                class="border-radius-lg text-sm w-100 px-3 py-2"
                                                                id="nomorrek" name="nomorrek"
                                                                value="{{ $rek->nomorrek }}" required>
                                                        </div>

                                                        <div class="mt-4">
                                                            <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
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
    <div class="modal fade" id="tambahDataRekening" tabindex="-1" aria-labelledby="tambahPenggunaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable"> <!-- Tambahkan class ini -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPenggunaLabel">Tambah Data Rekening</h5>
                    <button type="button" class="btn ms-auto" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah Pengguna -->
                    <form action="{{ route('rekening.tambah') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div>
                                <label for="namapemilik" class="form-label">Nama Pemilik</label>
                                <input type="text" class="border-radius-lg text-sm w-100 px-3 py-2" id="namapemilik"
                                    name="namapemilik" placeholder="Nama Pemilik" required
                                    oninput="this.value = this.value.toUpperCase();">
                            </div>
                            <div class="col-md-6">
                                <label for="namabang" class="form-label">Nama Bang</label>
                                <input type="text" class="border-radius-lg text-sm w-100 px-3 py-2" id="namabang"
                                    name="namabang" placeholder="Nama Bang" required
                                    oninput="this.value = this.value.toUpperCase();">
                            </div>
                            <div class="col-md-6">
                                <label for="nomorrek" class="form-label">Nomor Rekening</label>
                                <input type="number" class="border-radius-lg text-sm w-100 px-3 py-2" id="nomorrek"
                                    name="nomorrek" placeholder="Nomor Rekening" required>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
