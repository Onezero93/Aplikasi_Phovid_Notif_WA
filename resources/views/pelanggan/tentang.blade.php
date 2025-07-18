@extends('layoutpelanggan.indexpelanggan')
@section('contentpelanggan')
<div class="container py-5">
    <!-- Gambar dan Tentang Kami -->
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-4 mb-5">
        <!-- Gambar -->
        <div>
            <img src="{{ asset('img/logos/industri.jpg') }}"
                 alt="Jasa Fotografi"
                 class="rounded-circle shadow"
                 style="width: 200px; height: 200px; object-fit: cover;">
        </div>

        <!-- Tentang Kami -->
        <div class="card shadow rounded-4" style="max-width: 700px;">
            <div class="card-body">
                <h2 class="text-center mb-4">Tentang Kami</h2>
                <p>
                    Kami adalah perusahaan yang bergerak dalam bidang jasa fotografi dan videografi, yang menyediakan layanan dokumentasi untuk berbagai kebutuhan seperti pernikahan, prewedding, ulang tahun, wisuda, acara perusahaan, hingga foto produk.
                </p>
                <p>
                    Dengan didukung oleh tim profesional dan peralatan yang modern, kami berkomitmen untuk memberikan hasil terbaik guna mengabadikan setiap momen spesial Anda.
                    Layanan kami mencakup pemotretan indoor maupun outdoor, editing foto dan video, hingga pembuatan album kenangan.
                </p>
                <p>
                    Kepuasan pelanggan adalah prioritas utama kami. Oleh karena itu, kami selalu berusaha memberikan pelayanan yang ramah, cepat, dan berkualitas.
                </p>
            </div>
        </div>
    </div>

    <!-- Peta Lokasi -->
    <div class="text-center">
    <h4 class="mb-3">Lokasi Kami</h4>
    <div class="map-container">
        <iframe
            src="https://www.google.com/maps?q=-7.7589605,113.4167034&hl=id&z=18&output=embed"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>
</div>

</div>

</div>
@endsection
