@extends('layoutpelanggan.indexpelanggan')
@section('contentpelanggan')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h3>Pesan Jasa - {{ $pesananjasa->namajasa }}</h3>
                    <img src="{{ asset($pesananjasa->gambar) }}" alt="Jasa Image" class="img-fluid mb-3"
                        style="max-height: 200px;">
                    <p class="fw-bold">Harga: Rp {{ number_format($pesananjasa->harga, 0, ',', '.') }}</p>
                </div>
                <form id="pesanForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="border-radius-lg text-sm px-3 py-2 w-100" id="namapelanggan"
                                name="namapelanggan" placeholder="Masukkan nama pelanggan" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="nomorwa" class="form-label">Nomor WhatsApp</label>
                            <input type="text" class="border-radius-lg text-sm px-3 py-2 w-100" id="nomorwa"
                                name="nomorwa" placeholder="Masukkan nomor WhatsApp" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="jadwalpemotretan" class="form-label">Jadwal Pemotretan</label>
                            <input type="datetime-local" class="border-radius-lg text-sm px-3 py-2 w-100"
                                id="jadwalpemotretan" name="jadwalpemotretan" required>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="border-radius-lg text-sm w-100 px-3 py-2" id="alamat" name="alamat"
                            placeholder="Masukkan alamat lengkap" required></textarea>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Tipe Pembayaran</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="dp" name="tipepembayaran"
                                    value="DP" required>
                                <label class="form-check-label" for="dp">Down Payment (DP)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="lunas" name="tipepembayaran"
                                    value="Lunas" required>
                                <label class="form-check-label" for="lunas">Lunas</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Metode Pembayaran</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="cash" name="metodepembayaran"
                                    value="Cash" required>
                                <label class="form-check-label" for="cash">Cash</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="transfer" name="metodepembayaran"
                                    value="Transfer" required>
                                <label class="form-check-label" for="transfer">Transfer</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3" id="dpSection" style="display: none;">
                        <label for="jumlahdp" class="form-label">Jumlah DP</label>
                        <input type="number" class="border-radius-lg text-sm w-100 px-3 py-2" id="jumlahdp"
                            name="jumlahdp" placeholder="Masukkan jumlah DP">
                    </div>

                    <div class="mb-3">
                        <label for="totalharga" class="form-label">Total Harga</label>
                        <input type="number" class="border-radius-lg text-sm w-100 px-3 py-2" id="totalharga"
                            name="totalharga" placeholder="Total harga jasa" readonly>
                    </div>

                    <div class="mb-3" id="sisaPembayaranSection">
                        <label for="sisapembayaran" class="form-label">Sisa Pembayaran</label>
                        <input type="number" class="border-radius-lg text-sm w-100 px-3 py-2" id="sisapembayaran"
                            name="sisapembayaran" readonly>
                    </div>

                    <div class="mb-3 text-center">
                        <button type="button" class="btn btn-primary" id="bayarSekarang">Bayar Sekarang</button>
                    </div>

                    <div id="buktiPembayaranSection" style="display: none;">
                        <div class="mb-3 text-center">
                            <label for="buktibayar" class="form-label d-block">Bukti Pembayaran</label>
                            <div class="border p-2 d-inline-block" style="border-radius: 10px; overflow: hidden;">
                                <img id="preview" src="https://via.placeholder.com/250?text=Upload+Image"
                                    class="img-fluid rounded" style="max-width: 250px; height: auto; cursor: pointer;">
                            </div>
                            <input type="file" class="d-none" id="buktibayar" name="buktibayar" accept="image/*"
                                required>
                        </div>
                    </div>


                    <button type="button" class="btn btn-success" onclick="kirimPesan()">Kirim Pesanan</button>
                </form>

                <script>
                    
        
                    function kirimPesan() {
                        let nomor = document.getElementById("nomorwa").value;
                        let namaPelanggan = document.getElementById("namapelanggan").value;
                        let alamat = document.getElementById("alamat").value;
                        let jadwal = document.getElementById("jadwalpemotretan").value;
                        let tipePembayaran = document.getElementById("tipepembayaran").value;
                        let jumlahDP = document.getElementById("jumlahdp").value;
                        let totalHarga = document.getElementById("totalharga").value;
                        let sisaPembayaran = document.getElementById("sisapembayaran").value;
                        let statusPemesanan = document.getElementById("statuspemesanan").value;

                        if (nomor === "" || namaPelanggan === "" || alamat === "" || jadwal === "" || totalHarga === "") {
                            alert("Harap lengkapi semua data!");
                            return;
                        }

                        let pesan = `Halo, saya ${namaPelanggan} ingin memesan jasa fotografi/videografi.
            Alamat: ${alamat}
            Jadwal Pemotretan: ${jadwal}
            Tipe Pembayaran: ${tipePembayaran}`;

                        if (tipePembayaran === "DP") {
                            if (!jumlahDP || jumlahDP <= 0) {
                                alert("Harap masukkan jumlah DP yang valid!");
                                return;
                            }
                            pesan += `\nDP: Rp ${jumlahDP} \nSisa Pembayaran: Rp ${sisaPembayaran}`;
                        } else {
                            pesan += "\nPembayaran: Lunas";
                        }

                        pesan += `\nTotal Harga: Rp ${totalHarga} \nStatus Pemesanan: ${statusPemesanan}`;

                        let url =
                            `https://api.fonnte.com/send?target=${nomor}&message=${encodeURIComponent(pesan)}&token=U3p7CTBeSY5KardjtWPu`;

                        window.open(url, "_blank");
                    }

                    document.getElementById("bayarSekarang").addEventListener("click", function() {
                        document.getElementById("buktiPembayaranSection").style.display = "block";
                        this.style.display = "none"; // Sembunyikan tombol setelah diklik
                    });

                    document.getElementById("preview").addEventListener("click", function() {
                        document.getElementById("buktibayar").click();
                    });

                    document.getElementById("buktibayar").addEventListener("change", function(event) {
                        const file = event.target.files[0];
                        const preview = document.getElementById("preview");

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    //untuk tipe pembayaran
                    document.addEventListener("DOMContentLoaded", function() {
                        const dpRadio = document.getElementById("dp");
                        const lunasRadio = document.getElementById("lunas");
                        const dpSection = document.getElementById("dpSection");
                        const jumlahDP = document.getElementById("jumlahdp");
                        const totalHarga = document.getElementById("totalharga");
                        const sisaPembayaran = document.getElementById("sisapembayaran");
                        const sisaPembayaranSection = document.getElementById("sisaPembayaranSection");

                        // Ambil harga dari elemen harga jasa
                        const hargaText = document.querySelector("p.fw-bold").innerText;
                        const harga = parseInt(hargaText.replace(/\D/g, "")); // Ambil angka dari teks

                        // Set total harga otomatis
                        totalHarga.value = harga;
                        sisaPembayaran.value = harga; // Default sisa pembayaran = total harga

                        function updateVisibility() {
                            if (dpRadio.checked) {
                                dpSection.style.display = "block"; // Tampilkan input DP
                                jumlahDP.required = true;
                                sisaPembayaranSection.style.display = "block"; // Tampilkan sisa pembayaran
                            } else if (lunasRadio.checked) {
                                dpSection.style.display = "none"; // Sembunyikan input DP
                                jumlahDP.required = false;
                                jumlahDP.value = ""; // Reset nilai DP
                                sisaPembayaran.value = "0"; // Sisa pembayaran jadi 0
                                sisaPembayaranSection.style.display = "none"; // Sembunyikan sisa pembayaran
                            } else {
                                // Jika tidak ada yang dipilih, hanya sembunyikan sisa pembayaran
                                dpSection.style.display = "none";
                                sisaPembayaranSection.style.display = "none";
                                jumlahDP.required = false;
                                jumlahDP.value = "";
                                sisaPembayaran.value = harga;
                            }
                        }

                        // Event listener perubahan tipe pembayaran
                        dpRadio.addEventListener("change", updateVisibility);
                        lunasRadio.addEventListener("change", updateVisibility);

                        // Hitung sisa pembayaran saat input DP berubah
                        jumlahDP.addEventListener("input", function() {
                            const dp = parseFloat(jumlahDP.value) || 0;
                            sisaPembayaran.value = harga - dp;
                        });

                        // Pastikan form dimulai dalam keadaan default
                        updateVisibility();
                    });document.addEventListener("DOMContentLoaded", function() {
                        const dpRadio = document.getElementById("dp");
                        const lunasRadio = document.getElementById("lunas");
                        const dpSection = document.getElementById("dpSection");
                        const jumlahDP = document.getElementById("jumlahdp");
                        const totalHarga = document.getElementById("totalharga");
                        const sisaPembayaran = document.getElementById("sisapembayaran");
                        const sisaPembayaranSection = document.getElementById("sisaPembayaranSection");

                        // Ambil harga dari elemen harga jasa
                        const hargaText = document.querySelector("p.fw-bold").innerText;
                        const harga = parseInt(hargaText.replace(/\D/g, "")); // Ambil angka dari teks

                        // Set total harga otomatis
                        totalHarga.value = harga;
                        sisaPembayaran.value = harga; // Default sisa pembayaran = total harga

                        function updateVisibility() {
                            if (dpRadio.checked) {
                                dpSection.style.display = "block"; // Tampilkan input DP
                                jumlahDP.required = true;
                                sisaPembayaranSection.style.display = "block"; // Tampilkan sisa pembayaran
                            } else if (lunasRadio.checked) {
                                dpSection.style.display = "none"; // Sembunyikan input DP
                                jumlahDP.required = false;
                                jumlahDP.value = ""; // Reset nilai DP
                                sisaPembayaran.value = "0"; // Sisa pembayaran jadi 0
                                sisaPembayaranSection.style.display = "none"; // Sembunyikan sisa pembayaran
                            } else {
                                // Jika tidak ada yang dipilih, hanya sembunyikan sisa pembayaran
                                dpSection.style.display = "none";
                                sisaPembayaranSection.style.display = "none";
                                jumlahDP.required = false;
                                jumlahDP.value = "";
                                sisaPembayaran.value = harga;
                            }
                        }

                        // Event listener perubahan tipe pembayaran
                        dpRadio.addEventListener("change", updateVisibility);
                        lunasRadio.addEventListener("change", updateVisibility);

                        // Hitung sisa pembayaran saat input DP berubah
                        jumlahDP.addEventListener("input", function() {
                            const dp = parseFloat(jumlahDP.value) || 0;
                            sisaPembayaran.value = harga - dp;
                        });

                        // Pastikan form dimulai dalam keadaan default
                        updateVisibility();
                    });


                    //untuk metode pembayaran
                    document.addEventListener("DOMContentLoaded", function() {
                        const cashRadio = document.getElementById("cash");
                        const transferRadio = document.getElementById("transfer");
                        const buktiPembayaranSection = document.getElementById("buktiPembayaranSection");
                        const bayarSekarangButton = document.getElementById("bayarSekarang");

                        // Set default state: sembunyikan semua elemen tambahan
                        buktiPembayaranSection.style.display = "none";
                        bayarSekarangButton.style.display = "none";

                        // Event listener untuk metode pembayaran
                        cashRadio.addEventListener("change", function() {
                            if (this.checked) {
                                buktiPembayaranSection.style.display = "block";
                                bayarSekarangButton.style.display = "none";
                            }
                        });

                        transferRadio.addEventListener("change", function() {
                            if (this.checked) {
                                buktiPembayaranSection.style.display = "none";
                                bayarSekarangButton.style.display = "block";
                            }
                        });

                        // Input gambar ketika diklik
                        document.getElementById("preview").addEventListener("click", function() {
                            document.getElementById("buktibayar").click();
                        });

                        // Preview gambar setelah diunggah
                        document.getElementById("buktibayar").addEventListener("change", function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById("preview").src = e.target.result;
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    });

                    //untuk melihat gambar yang telah di kirim
                    document.getElementById("preview").addEventListener("click", function() {
                        document.getElementById("buktibayar").click();
                    });

                    document.getElementById("buktibayar").addEventListener("change", function(event) {
                        const file = event.target.files[0];
                        const preview = document.getElementById("preview");

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                </script>
            @endsection
