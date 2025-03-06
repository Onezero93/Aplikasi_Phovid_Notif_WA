@extends('layout.index')

@section('content')
<div class="container">
    <div class="card shadow-lg position-relative">
        <!-- Tombol kembali di pojok kiri atas -->
        <a href="{{ route('jasa.datajasa') }}" class="position-absolute top-0 start-0 m-3 text-dark">
            <i class="fas fa-arrow-left fa-lg"></i>
        </a>
        
        <div class="card-body">
            <div class="text-center">
                <img src="{{ asset($jasa->gambar) }}" alt="Gambar Jasa" class="img-fluid shadow border-radius-lg mb-3" style="max-width: 300px;">
                <h4 class="text-dark font-weight-bold">{{ $jasa->namajasa }}</h4>
            </div>
            <div class="text-start mt-3">
                <p class="text-muted" style="white-space: pre-wrap;">{{  $jasa->deskripsi }}</p>
                <p class="text-success font-weight-bold">Harga: Rp {{ number_format($jasa->harga, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
