<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jasa;
use App\Models\Pemesanan;

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
        return view('pelanggan.pesanan', compact('pesananjasa'));
    }

    public function simpanPesanan(Request $request)
{
    // dd($request->all());
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
        'statuspemesanan' => 'nullable|in:Menunggu,Dikonfirmasi,Selesai,Dibatalkan',
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

    return redirect()->route('jasa.jasahome')->with('success', 'Pesanan berhasil dibuat!');

}
}
