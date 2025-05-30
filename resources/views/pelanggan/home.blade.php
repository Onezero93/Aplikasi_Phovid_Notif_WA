@extends('layoutpelanggan.indexpelanggan')
@section('contentpelanggan')
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="text-center position-absolute w-100" style="top: 70%; transform: translateY(-50%);">
            <h3 class="text-white">Selamat Datang di Aplikasi Phovid</h3>
        </div>
    </div>
    <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="mb-5 ps-3">
                    <h6 class="mb-1">Jasa</h6>
                    <p class="text-sm">Architects design houses</p>
                </div>
                <div class="container pt-4">
                    <div class="row">
                        @foreach ($jasahome as $jsh)
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card card-blog card-plain bg-gradient-dark">
                                    <div class="card-header p-0 m-2">
                                        <a class="d-block shadow-xl border-radius-xl">
                                            <img src="{{ asset($jsh->gambar) }}" alt="img-blur-shadow"
                                                class="img-fluid shadow border-radius-lg">
                                        </a>
                                    </div>
                                    <div class="card-body p-3">
                                        <a href="javascript:;">
                                            <h5 class="text-white">{{ $jsh->namajasa }}</h5>
                                        </a>
                                        <p class="mb-4 text-sm">Rp {{ number_format($jsh->harga, 0, ',', '.') }}
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <button type="button" class="btn btn-primary btn-sm mb-0"
                                                data-bs-toggle="modal" data-bs-target="#modalDetail{{ $jsh->id_jasa }}">
                                                Detail Jasa
                                            </button>
                                            <a href="{{ route('pesanan.jasa', $jsh->id_jasa) }}"
                                                class="btn btn-success btn-sm mb-0">
                                                Pesan
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalDetail{{ $jsh->id_jasa }}" tabindex="-1"
                                        aria-labelledby="modalLabel{{ $jsh->id_jasa }}" aria-hidden="true"
                                        data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $jsh->id_jasa }}">
                                                        {{ $jsh->namajasa }}</h5>
                                                    <button type="button" class="btn ms-auto" data-bs-dismiss="modal"
                                                        aria-label="Close"><i class="fas fa-times"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset($jsh->gambar) }}" alt="Gambar Jasa"
                                                        class="img-fluid mb-3">
                                                    <p><strong>Harga:</strong> Rp
                                                        {{ number_format($jsh->harga, 0, ',', '.') }}</p>
                                                    <p class="mb-1"><strong>Deskripsi</strong></p>
                                                    <p class="text-muted" style="white-space: pre-line;">{{ $jsh->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
