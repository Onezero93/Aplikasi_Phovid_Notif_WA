@extends('layout.index')
@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Pelanggan</p>
                                <h4 class="mb-0">{{ $jumlahPelangganDiproses }}</h4>
                            </div>
                            <div
                                class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">person</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm"><span class="text-warning font-weight-bolder">Proses</span></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Pelanggan</p>
                                <h4 class="mb-0">{{ $jumlahPelangganDisetujui }}</h4>
                            </div>
                            <div
                                class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">person</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">Setujui
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Pelanggan</p>
                                <h4 class="mb-0">{{ $jumlahPelangganDibatalkan }}</h4>
                            </div>
                            <div
                                class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">person</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">Batal </span></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-4 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Pendapatan</p>
                                <h4 class="mb-0">Rp {{ number_format($totalPendapatan) }}</h4>
                            </div>
                            <div
                                class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">account_balance_wallet</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0">Grafik pendapatan per bulan</h6>
                        {{-- <p class="text-sm">Last Campaign Performance</p> --}}
                        <div class="pe-2">
                            <div class="chart">
                                <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                        <hr class="dark horizontal">
                        {{-- <div class="d-flex">
                  <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                  <p class="mb-0 text-sm">campaign sent 2 days ago</p>
                </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Data Pelanggan</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                            Pelanggan</th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Jasa</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Karyawan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($semuadatapemesanan as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->namapelanggan }}</h6>
                                                        <!-- hapus tanda "<" -->
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset($item->jasa->gambar) }}"
                                                            class="avatar avatar-sm me-3" alt="xd">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $item->jasa ? $item->jasa->namajasa : '-' }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> <span
                                                        style="font-weight:bold; color:
                    @if ($item->statuspemesanan == 'Setujui') green
                    @elseif($item->statuspemesanan == 'Proses') orange
                    @elseif($item->statuspemesanan == 'Batal') red
                    @else black @endif
                ">
                                                        {{ $item->statuspemesanan }}
                                                    </span> </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $item->user ? $item->user->namalengkap : '-' }}
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data pemesanan</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
  <div class="card h-100">
    <div class="card-header pb-0">
      <h6>Data Karyawan</h6>
      <p class="text-sm">
        <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
        <span class="font-weight-bold">{{ $semuadatakaryawan->count() }} Karyawan</span>
      </p>
    </div>
    <div class="card-body p-3">
      <div class="timeline timeline-one-side">
        @foreach($semuadatakaryawan as $karyawan)
          <div class="timeline-block mb-3">
            <span class="timeline-step">
  <img src="{{ $karyawan->gambar ? asset($karyawan->gambar) : asset('assets/img/team-2.jpg') }}" alt="Foto Karyawan" style="width:30px; height:30px; border-radius:50%;">
</span>

            <div class="timeline-content">
              <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $karyawan->namalengkap }}</h6>
              <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $karyawan->nomortelepon }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

        </div>
        <footer class="footer py-4  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                Tim</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                    target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: "Total Pendapatan",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "#43A047",
                        data: {!! json_encode($values) !!},
                        barThickness: 'flex'
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let value = context.parsed.y;
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: '#e5e5e5'
                            },
                            ticks: {
                                beginAtZero: true,
                                padding: 10,
                                font: {
                                    size: 14,
                                    lineHeight: 2
                                },
                                color: "#737373",
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#737373',
                                padding: 10,
                                font: {
                                    size: 14,
                                    lineHeight: 2
                                },
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
