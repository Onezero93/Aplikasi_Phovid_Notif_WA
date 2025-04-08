@extends('layout.index')
@section('content')
    <div class="col-10 mx-auto">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div
                    class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between px-3">
                    <h6 class="text-white text-capitalize">Data Order</h6>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama
                                        Pelanggan</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Nomor Telepon
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Nama Jasa
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Tanda Bukti
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Status
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                        Aksi
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesanan as $order)
                                    <tr>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $order->namapelanggan }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">{{ $order->nomorwa }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $order->jasa->namajasa ?? '-' }}
                                            </p>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ $order->gambarbuktipembayaran
                                                    ? asset('storage/' . $order->gambarbuktipembayaran)
                                                    : asset('assets/img/team-2.jpg') }}"
                                                    class="avatar avatar-sm border-radius-lg">
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <form action="{{ route('status.perbarui', $order->id_pemesanan) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')

                                                <select name="statuspemesanan" id="statusSelect-{{ $order->id }}"
                                                    class="text-center status-dropdown border-0 px-2 py-1 text-xs"
                                                    style="border-radius: 0.5rem; appearance: none; font-size: 0.75rem;"
                                                    onchange="this.form.submit()">
                                                    <option class="text-dark" value="Setujui"
                                                        {{ $order->statuspemesanan == 'Setujui' ? 'selected' : '' }}>Setujui
                                                    </option>
                                                    <option class="text-dark" value="Batal"
                                                        {{ $order->statuspemesanan == 'Batal' ? 'selected' : '' }}>Batal
                                                    </option>
                                                    <option class="text-dark" value="Proses"
                                                        {{ $order->statuspemesanan == 'Proses' ? 'selected' : '' }}>Proses
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="align-middle text-center">
                                            {{-- <a href="" class="btn btn-link text-success text-gradient p-1 m-0"
                                                data-bs-toggle="offcanvas" data-bs-target="">
                                                <i class="fab fa-whatsapp fs-5"></i>
                                            </a> --}}
                                            <a href="javascript:void(0)"
                                                class="btn btn-link text-success text-gradient p-1 m-0 kirim-wa"
                                                data-id="{{ $order->id_pemesanan }}">
                                                <i class="fab fa-whatsapp fs-5"></i>
                                            </a>

                                            <a href="#" class="btn btn-link text-primary p-1 m-0"
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#detailOrder{{ $order->id_pemesanan }}">
                                                <i class="material-symbols-rounded fs-5">article</i>
                                            </a>
                                            <div class="offcanvas offcanvas-end" tabindex="-1"
                                                id="detailOrder{{ $order->id_pemesanan }}"
                                                aria-labelledby="detailLabel{{ $order->id_pemesanan }}">
                                                <div class="offcanvas-header border-bottom">
                                                    <h5 class="offcanvas-title" id="detailLabel{{ $order->id_pemesanan }}">Detail
                                                        Pemesanan</h5>
                                                </div>
                                                <div class="offcanvas-body px-4 py-3">
                                                    <div class="text-start"> <!-- Tambahkan text-start di sini -->
                                                        <h5 class="text-center">{{ $order->jasa->namajasa ?? '-' }}</h5>
                                                        <br>
                                                        <div class="row mb-2">
                                                            <div class="col-6">
                                                                <p class="mb-1"><strong>Nama Pelanggan</strong></p>
                                                                <p>{{ $order->namapelanggan }}</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="mb-1"><strong>No. Telepon</strong></p>
                                                                <p>{{ $order->nomorwa }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <p class="mb-1"><strong>Alamat</strong></p>
                                                            <p class="mb-0" style="white-space: pre-line;">
                                                                {{ $order->alamat }}</p>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-6">
                                                                <p class="mb-1"><strong>Jadwal</strong></p>
                                                                <p>{{ $order->jadwalpemotretan }}</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="mb-1"><strong>Status</strong></p>
                                                                <p>{{ $order->statuspemesanan ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-6">
                                                                <p class="mb-1"><strong>Tipe Pembayaran</strong></p>
                                                                <p>{{ $order->tipepembayaran }}</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="mb-1"><strong>Metode Pembayaran</strong></p>
                                                                <p>{{ $order->metodepembayaran ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-6">
                                                                <p class="mb-1"><strong>Jumlah DP</strong></p>
                                                                <p>
                                                                    {{ $order->jumlahdp ? 'Rp' . number_format($order->jumlahdp, 0, ',', '.') : '---' }}
                                                                </p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="mb-1"><strong>Sisa Pembayaran</strong></p>
                                                                <p>
                                                                    {{ $order->sisapembayaran ? 'Rp' . number_format($order->sisapembayaran, 0, ',', '.') : '---' }}
                                                                </p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="mb-1"><strong>Total Harga</strong></p>
                                                                <p>Rp{{ number_format($order->totalharga, 0, ',', '.') }}
                                                                </p>
                                                            </div>
                                                        </div>


                                                        <hr class="my-3">

                                                        <p class="mb-2"><strong>Bukti Pembayaran:</strong></p>
                                                        <div class="text-center">
                                                            <img src="{{ $order->gambarbuktipembayaran ? asset('storage/' . $order->gambarbuktipembayaran) : asset('assets/img/team-2.jpg') }}"
                                                                alt="Bukti Pembayaran"
                                                                class="img-fluid rounded shadow-sm border"
                                                                style="max-width: 300px;">
                                                        </div>
                                                    </div>
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
    <script>
        function updateSelectColor(select) {
            // Reset dulu semua background gradient dan warna teks
            select.classList.remove(
                'bg-gradient-success',
                'bg-gradient-danger',
                'bg-gradient-warning',
                'bg-gradient-secondary',
                'text-white',
                'text-dark'
            );

            // Tambahkan sesuai value
            switch (select.value) {
                case 'Setujui':
                    select.classList.add('bg-gradient-success', 'text-white');
                    break;
                case 'Batal':
                    select.classList.add('bg-gradient-danger', 'text-white');
                    break;
                case 'Proses':
                    select.classList.add('bg-gradient-warning', 'text-white');
                    break;
                default:
                    select.classList.add('bg-gradient-secondary', 'text-white');
            }
        }

        // Eksekusi awal saat halaman load + pas select berubah
        document.querySelectorAll('.status-dropdown').forEach(function(select) {
            updateSelectColor(select);
            select.addEventListener('change', function() {
                updateSelectColor(this);
            });
        });

        document.querySelectorAll('.kirim-wa').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');

                axios.post("{{ route('kirim.wa') }}", {
                        id: id
                    })
                    .then(function(response) {})
                    .catch(function(error) {});
            });
        });
    </script>
@endsection
