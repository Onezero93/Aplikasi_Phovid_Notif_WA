@extends('layoutpelanggan.indexpelanggan')
@section('contentpelanggan')
    <div class="container mt-5">
        @if ($riwayat->isEmpty())
            <div class="alert alert-info">Belum ada riwayat pemesanan.</div>
        @else
            <div class="row">
                @foreach ($riwayat as $index => $p)
                    <div class=" mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Gambar di kiri -->
                                    <div class="col-md-4">
                                        @if ($p->jasa->gambar)
                                            <img src="{{ asset($p->jasa->gambar) }}" alt="Gambar Jasa"
                                                class="img-fluid rounded">
                                        @else
                                            <div class="text-muted small">Tidak ada gambar</div>
                                        @endif
                                    </div>

                                    <!-- Informasi di kanan -->
                                    <div class="col-md-8">
                                        <h5 class="card-title">{{ $p->jasa->namajasa ?? '-' }}</h5>
                                        <div class="row mb-1">
                                            <div class="col-6">
                                                <strong>Jadwal:</strong> {{ $p->jadwalpemotretan }}
                                            </div>
                                            <div class="col-6">
                                                <strong>Metode Pembayaran:</strong> {{ $p->tipepembayaran }} -
                                                {{ $p->metodepembayaran }}
                                            </div>
                                        </div>
                                        @if ($p->tipepembayaran == 'dp')
                                            <p class="mb-1"><strong>Jumlah DP:</strong> Rp
                                                {{ number_format($p->jumlahdp, 0, ',', '.') }}</p>
                                            <p class="mb-1"><strong>Sisa Pembayaran:</strong> Rp
                                                {{ number_format($p->sisapembayaran, 0, ',', '.') }}</p>
                                        @endif
                                        <p class="mb-1"><strong>Total Harga:</strong> Rp
                                            {{ number_format($p->totalharga, 0, ',', '.') }}</p>
                                        <p class="mb-1">
                                            <strong>Status:</strong>
                                            <span
                                                class="badge {{ $p->statuspemesanan == 'Proses' ? 'bg-gradient-warning' : ($p->statuspemesanan == 'Setujui' ? 'bg-gradient-success' : 'bg-secondary') }}">
                                                {{ ucfirst($p->statuspemesanan) }}
                                            </span>
                                        </p>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <p class="mb-1"><strong>Bukti Pembayaran DP:</strong></p>
                                                @if ($p->gambarbuktipembayaran)
                                                    <a href="{{ asset('storage/' . $p->gambarbuktipembayaran) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/' . $p->gambarbuktipembayaran) }}"
                                                            alt="Bukti Pembayaran DP" class="img-fluid rounded mb-2"
                                                            style="max-height: 150px;">
                                                    </a>
                                                @else
                                                    <p>-</p>
                                                @endif
                                            </div>
                                            @if ($p->tipepembayaran == 'dp')
                                                <div class="col-md-6">
                                                    <p class="mb-1"><strong>Bukti Pelunasan:</strong></p>
                                                    @if ($p->statuspemesanan == 'Setujui')
                                                        @if ($p->gambarbuktipelunasan)
                                                            {{-- Gambar jika sudah upload --}}
                                                            <a href="{{ asset('storage/' . $p->gambarbuktipelunasan) }}"
                                                                target="_blank">
                                                                <img src="{{ asset('storage/' . $p->gambarbuktipelunasan) }}"
                                                                    alt="Bukti Pelunasan" class="img-fluid rounded mb-2"
                                                                    style="max-height: 150px;">
                                                            </a>
                                                        @else
                                                            {{-- Form upload langsung buka file picker saat tombol diklik --}}
                                                            <form
                                                                action="{{ route('upload.pelunasan', $p->id_pemesanan) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <label class="btn btn-primary">
                                                                    Upload Bukti Pelunasan
                                                                    <input type="file" name="gambarbuktipelunasan"
                                                                        onchange="this.form.submit()" hidden required>
                                                                </label>
                                                            </form>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
