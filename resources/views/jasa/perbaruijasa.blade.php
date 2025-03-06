@extends('layout.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Perbarui Jasa</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('jasa.perbarui', $jasa->id_jasa) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 text-center">
                            <label for="gambar" class="form-label d-block">Gambar Jasa</label>
                            <img src="{{ asset($jasa->gambar) }}" alt="Gambar Jasa" class="img-fluid mb-2" width="150" id="previewGambar" style="cursor: pointer;">
                            <input type="file" name="gambar" id="gambar" class="form-control d-none" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="namajasa" class="form-label">Nama Jasa</label>
                            <input type="text" name="namajasa" id="namajasa" class="form-control" value="{{ $jasa->namajasa }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="border-radius-lg text-sm w-100 px-3 py-2" id="deskripsi" name="deskripsi"
                                placeholder="Masukkan Deskripsi" rows="3" required oninput="formatText(this)">{{ $jasa->deskripsi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control" value="{{ $jasa->harga }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="{{ route('jasa.datajasa') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('previewGambar')?.addEventListener('click', function() {
        document.getElementById('gambar').click();
    });

    document.getElementById('gambar')?.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewGambar').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

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

@endsection
