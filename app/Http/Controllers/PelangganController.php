<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jasa;
use App\Models\Pemesanan;
use App\Models\Rekening;
use Illuminate\Support\Facades\Http;

class PelangganController extends Controller
{
    //
    public function tampilJasaHome(Request $request)
    {
        $jasahome = Jasa::all();
        return view('pelanggan.home', compact('jasahome'));
    }

    public function buatPesanan($id_jasa)
    {
        $pesananjasa = Jasa::findOrFail($id_jasa);
        $rekenings = Rekening::all(); // ambil semua rekening

    return view('pelanggan.pesanan', compact('pesananjasa', 'rekenings'));
    }

    public function simpanPesanan(Request $request)
{
    $jadwalSudahAda = Pemesanan::where('jadwalpemotretan', $request->jadwalpemotretan)->exists();

    if ($jadwalSudahAda) {
        return back()->with('error', 'Jadwal pemotretan sudah dipesan, silakan pilih jadwal lain.')->withInput();
    }
    $request->validate([
        'id_jasa' => 'required|exists:jasa,id_jasa',
        'namapelanggan' => 'required|string|max:255',
        'alamat' => 'required|string',
        'nomorwa' => 'required|string|max:20',
        'jadwalpemotretan' => 'required|date',
        'tipepembayaran' => 'required|in:DP,Kontan',
        'metodepembayaran' => 'required|in:Transfer,Tunai',
        'jumlahdp' => 'nullable|numeric|min:0',
        'sisapembayaran' => 'nullable|numeric|min:0',
        'totalharga' => 'required|numeric|min:0',
        'statuspemesanan' => 'nullable|in:Setujui,Batal,Proses',
        'gambarbuktipembayaran' => $request->metodepembayaran == 'Transfer' ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Cek apakah ada file yang diunggah
    if (!$request->hasFile('gambarbuktipembayaran')) {
        return redirect()->back()->withErrors(['gambarbuktipembayaran' => 'Bukti pembayaran wajib diunggah.'])->withInput();
    }

    $pemesanan = new Pemesanan();
    $pemesanan->id_jasa = $request->id_jasa;
    $pemesanan->namapelanggan = $request->namapelanggan;
    $pemesanan->alamat = $request->alamat;
    $pemesanan->nomorwa = $request->nomorwa;
    $pemesanan->jadwalpemotretan = $request->jadwalpemotretan;
    $pemesanan->tipepembayaran = $request->tipepembayaran;
    $pemesanan->metodepembayaran = $request->metodepembayaran;
    $pemesanan->jumlahdp = $request->jumlahdp ?? 0;
    $pemesanan->sisapembayaran = $request->sisapembayaran ?? 0;
    $pemesanan->totalharga = $request->totalharga;
    $pemesanan->statuspemesanan = $request->statuspemesanan;

    // Simpan gambar bukti pembayaran
    $file = $request->file('gambarbuktipembayaran');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $path = $file->storeAs('bukti_pembayaran', $filename, 'public');
    $pemesanan->gambarbuktipembayaran = $path;

    $pemesanan->save();

    // Kirim WhatsApp via Fonnte
    $token = '9fd5BVdFtu6m4tYmHYMQ'; // Token Fonnte kamu
    $jadwalFormat = str_replace('T', ' ', $pemesanan->jadwalpemotretan);
    // Format pesan ke admin
    $pesanAdmin = "*📸 Pesanan Baru Masuk!*\n";
    $pesanAdmin .= "Nama Pelanggan: {$pemesanan->namapelanggan}\n";
    $pesanAdmin .= "Alamat: {$pemesanan->alamat}\n";
    $pesanAdmin .= "Jadwal: {$jadwalFormat}\n";
    $pesanAdmin .= "Nomor Wa: {$pemesanan->nomorwa}\n";
    $pesanAdmin .= "Tipe: {$pemesanan->tipepembayaran}\n";
    $pesanAdmin .= "Metode: {$pemesanan->metodepembayaran}\n";
    if ($pemesanan->tipepembayaran == 'DP') {
        $pesanAdmin .= "DP: Rp " . number_format($pemesanan->jumlahdp, 0, ',', '.') . "\n";
        $pesanAdmin .= "Sisa: Rp " . number_format($pemesanan->sisapembayaran, 0, ',', '.') . "\n";
    }
    $pesanAdmin .= "Total: Rp " . number_format($pemesanan->totalharga, 0, ',', '.');

    Http::withOptions([
        'verify' => false
    ])->withHeaders([
        'Authorization' => $token
    ])->post('https://api.fonnte.com/send', [
        'target' => '6281917716274',
        'message' => $pesanAdmin,
    ]);


    return redirect()->route('jasa.jasahome')->with('success', 'Pesanan berhasil dibuat!');
}


}
