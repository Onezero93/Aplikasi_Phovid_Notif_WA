<div class="container">
    <h3>Pesan Jasa - {{ $pesananjasa->namajasa }}</h3>
    <div class="card">
        <div class="card-body">
            <img src="{{ asset($pesananjasa->gambar) }}" alt="Jasa Image" class="img-fluid mb-3" style="max-height: 200px;">
            <p>Harga: Rp {{ number_format($pesananjasa->harga, 0, ',', '.') }}</p>
            <form id="pesanForm">
                <div class="mb-3">
                    <label for="telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan nomor telepon" required>
                </div>
                <button type="button" class="btn btn-success" onclick="kirimPesan()">Kirim Pesanan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function kirimPesan() {
        let nomor = document.getElementById("telepon").value;
        let namaJasa = "{{ $pesananjasa->namajasa }}";
        let harga = "{{ number_format($pesananjasa->harga, 0, ',', '.') }}";
        
        if (nomor === "") {
            alert("Harap masukkan nomor telepon!");
            return;
        }

        let pesan = encodeURIComponent(`Halo, saya ingin memesan jasa ${namaJasa} dengan harga Rp ${harga}.`);
        
        // URL Fonnte API
        let url = `https://api.fonnte.com/send?target=${nomor}&message=${pesan}&token=U3p7CTBeSY5KardjtWPu`;

        // Redirect ke URL Fonnte
        window.open(url, "_blank");
    }
</script>
