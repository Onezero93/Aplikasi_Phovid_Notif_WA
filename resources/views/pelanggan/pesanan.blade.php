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
                @if (session('error'))
                    <div class="alert alert-danger text-white">{{ session('error') }}</div>
                @endif
                <form id="pesanForm" action="{{ route('simpan.pesanan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_jasa" value="{{ $pesananjasa->id_jasa }}">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="border-radius-lg text-sm px-3 py-2 w-100" id="namapelanggan"
                                name="namapelanggan" placeholder="Masukkan nama pelanggan" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="nomorwa" class="form-label">Nomor WhatsApp</label>
                            <input type="number" class="border-radius-lg text-sm px-3 py-2 w-100" id="nomorwa"
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
                                    value="Kontan" required>
                                <label class="form-check-label" for="lunas">Kontan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Metode Pembayaran</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="cash" name="metodepembayaran"
                                    value="Tunai" required>
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
                    <input type="hidden" id="statuspemesanan" name="statuspemesanan" value="Proses">
                    <div class="mb-3 d-flex justify-content-center">
                        <button type="button" class="btn btn-primary" id="bayarSekarang">Bayar Sekarang</button>
                    </div>

                    <div id="buktiPembayaranSection" style="display: none;">
                        <div class="mb-3 text-center">
                            <label for="buktibayar" class="form-label d-block">Bukti Pembayaran</label>
                            <div class="border p-2 d-inline-block" style="border-radius: 10px; overflow: hidden;">
                                <img id="preview" src="https://via.placeholder.com/250?text=Upload+Image"
                                    class="img-fluid rounded" style="max-width: 250px; height: auto; cursor: pointer;">
                            </div>
                            <input type="file" class="d-none" id="buktibayar" name="gambarbuktipembayaran"
                                accept="image/*" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" id="btnKirimPesanan">Kirim Pesanan</button>
                </form>
                <!-- Modal Konfirmasi -->
                <div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-labelledby="modalKonfirmasiLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalKonfirmasiLabel">Konfirmasi Pembayaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nama:</strong> <span id="konfNama"></span></p>
                                <p><strong>WhatsApp:</strong> <span id="konfWA"></span></p>
                                <p><strong>Jadwal:</strong> <span id="konfJadwal"></span></p>
                                <p><strong>Alamat:</strong> <span id="konfAlamat"></span></p>
                                <p><strong>Tipe Pembayaran:</strong> <span id="konfTipePembayaran"></span></p>
                                <p><strong>Metode Pembayaran:</strong> <span id="konfMetodePembayaran"></span></p>
                                <p><strong>Jumlah DP:</strong> <span id="konfDP"></span></p>
                                <p><strong>Total Harga:</strong> <span id="konfTotal"></span></p>
                                <p><strong>Sisa Pembayaran:</strong> <span id="konfSisa"></span></p>
                                <hr>
                                <h5>Informasi Rekening Transfer</h5>
                                @foreach ($rekenings as $rekening)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rekening"
                                            id="rekening{{ $rekening->id_rekening }}"
                                            value="{{ $rekening->id_rekening }}">
                                        <label class="form-check-label" for="rekening{{ $rekening->id_rekening }}">
                                            {{ $rekening->namabang }} - {{ $rekening->nomorrek }} -
                                            {{ $rekening->namapemilik }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" id="tombolKomplit">Komplit</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script>
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
            // document.getElementById("preview").addEventListener("click", function () {
            //     document.getElementById("buktibayar").click();
            // });
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

            document.addEventListener("DOMContentLoaded", function() {
                const transferRadio = document.getElementById("transfer");
                const cashRadio = document.getElementById("cash");
                const buktiPembayaranInput = document.getElementById("buktibayar");
                const bayarSekarangButton = document.getElementById("bayarSekarang");
                const form = document.getElementById("pesanForm");

                form.addEventListener("submit", function(event) {
                    if (!buktiPembayaranInput.files.length) {
                        alert("Bukti pembayaran wajib diunggah!");
                        event.preventDefault();
                    }
                });

                transferRadio.addEventListener("change", function() {
                    buktiPembayaranInput.required = true;
                });

                cashRadio.addEventListener("change", function() {
                    buktiPembayaranInput.required = true;
                });

            });

            document.addEventListener("DOMContentLoaded", function() {
                const bayarSekarangButton = document.getElementById("bayarSekarang");
                const tombolKomplit = document.getElementById("tombolKomplit");

                bayarSekarangButton.addEventListener("click", function() {
                    // Ambil nilai dari inputan
                    document.getElementById("konfNama").innerText = document.getElementById("namapelanggan")
                        .value;
                    document.getElementById("konfWA").innerText = document.getElementById("nomorwa").value;
                    document.getElementById("konfJadwal").innerText = document.getElementById(
                        "jadwalpemotretan").value;
                    document.getElementById("konfAlamat").innerText = document.getElementById("alamat").value;

                    const tipePembayaran = document.querySelector("input[name='tipepembayaran']:checked");
                    const metodePembayaran = document.querySelector("input[name='metodepembayaran']:checked");
                    const jumlahDP = document.getElementById("jumlahdp").value || "-";
                    const totalHarga = document.getElementById("totalharga").value;
                    const sisa = document.getElementById("sisapembayaran").value;

                    document.getElementById("konfTipePembayaran").innerText = tipePembayaran ? tipePembayaran
                        .value : "-";
                    document.getElementById("konfMetodePembayaran").innerText = metodePembayaran ?
                        metodePembayaran.value : "-";
                    document.getElementById("konfDP").innerText = jumlahDP;
                    document.getElementById("konfTotal").innerText = totalHarga;
                    document.getElementById("konfSisa").innerText = sisa;

                    const modal = new bootstrap.Modal(document.getElementById("modalKonfirmasi"));
                    modal.show();
                });

                tombolKomplit.addEventListener("click", function() {
                    alert("Data berhasil dikonfirmasi!");

                    // Tampilkan input gambar bukti pembayaran
                    document.getElementById("buktiPembayaranSection").style.display = "block";

                    // Sembunyikan tombol Bayar Sekarang
                    document.getElementById("bayarSekarang").style.display = "none";

                    // Tutup modal
                    const modalElement = document.getElementById("modalKonfirmasi");
                    const modalInstance = bootstrap.Modal.getInstance(modalElement);
                    modalInstance.hide();
                });

            });



            document.addEventListener("DOMContentLoaded", function() {
                const form = document.getElementById("pesanForm");
                const bayarSekarangButton = document.getElementById("bayarSekarang");

                const requiredFields = [
                    "namapelanggan",
                    "nomorwa",
                    "jadwalpemotretan",
                    "alamat",
                    "totalharga"
                ];

                const tipePembayaranRadios = document.querySelectorAll("input[name='tipepembayaran']");
                const metodePembayaranRadios = document.querySelectorAll("input[name='metodepembayaran']");

                function isRadioChecked(radioNodeList) {
                    return Array.from(radioNodeList).some(radio => radio.checked);
                }

                function checkFormValidity() {
                    let isValid = true;

                    // Cek semua inputan teks
                    requiredFields.forEach(id => {
                        const field = document.getElementById(id);
                        if (!field.value.trim()) {
                            isValid = false;
                        }
                    });

                    // Cek radio button dipilih
                    if (!isRadioChecked(tipePembayaranRadios) || !isRadioChecked(metodePembayaranRadios)) {
                        isValid = false;
                    }

                    // Jika DP dipilih, pastikan jumlahdp diisi
                    const dpRadio = document.getElementById("dp");
                    if (dpRadio.checked) {
                        const jumlahDP = document.getElementById("jumlahdp").value;
                        if (!jumlahDP || parseFloat(jumlahDP) <= 0) {
                            isValid = false;
                        }
                    }

                    // Enable/Disable tombol
                    bayarSekarangButton.disabled = !isValid;
                }

                // Tambahkan event listener ke semua field
                requiredFields.forEach(id => {
                    const field = document.getElementById(id);
                    field.addEventListener("input", checkFormValidity);
                });

                [...tipePembayaranRadios, ...metodePembayaranRadios].forEach(radio => {
                    radio.addEventListener("change", checkFormValidity);
                });

                document.getElementById("jumlahdp").addEventListener("input", checkFormValidity);

                // Jalankan saat pertama kali
                checkFormValidity();
            });
            document.addEventListener('DOMContentLoaded', function() {
                const inputNomorWA = document.getElementById('nomorwa');

                inputNomorWA.addEventListener('blur', function() {
                    let nomor = inputNomorWA.value.trim();

                    // Hapus awalan 0 jika ada
                    if (nomor.startsWith('0')) {
                        nomor = nomor.slice(1);
                    }

                    // Tambahkan awalan 62 jika belum ada
                    if (!nomor.startsWith('62')) {
                        nomor = '62' + nomor;
                    }

                    inputNomorWA.value = nomor;
                });
            });

            document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("pesanForm");
        const btnKirim = document.getElementById("btnKirimPesanan");

        btnKirim.addEventListener("click", function (e) {
            e.preventDefault(); // Cegah submit langsung

            Swal.fire({
                title: 'Kirim Pesanan?',
                text: "Pastikan data sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kirim!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit manual setelah konfirmasi
                }
            });
        });
    });
        </script>
    @endsection
