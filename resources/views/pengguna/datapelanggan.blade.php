@extends('layout.index')
@section('content')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div
                    class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between px-3">
                    <h6 class="text-white text-capitalize">Tabel Pelanggan</h6>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Lengkap</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pengguna</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alamat</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelanggan as $pl)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $pl->gambar ? asset($pl->gambar) : asset('assets/img/team-2.jpg') }}"
                                                        class="avatar avatar-sm me-3 border-radius-lg">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $pl->namalengkap }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $pl->nomortelepon }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pl->username }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $pl->alamat ?? 'Tidak ada alamat' }}
                                            </p>
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            @if ($pl->status == 'pelanggan')
                                                <span class="badge badge-sm bg-gradient-danger">Pelanggan</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">Tidak Ada Status</span>
                                            @endif
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
        function previewImage(event, id_user) {
            let input = event.target;
            let preview = document.getElementById('previews' + id_user);

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.transform = "scale(1.1)"; // Efek kecil saat diubah
                    setTimeout(() => preview.style.transform = "scale(1)", 200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
