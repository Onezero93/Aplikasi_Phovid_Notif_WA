<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Http;

class PemesananController extends Controller
{
    //
    public function tampilPemesanan(Request $request)
    {
        $pemesanan = Pemesanan::with('jasa')->get();
        return view('pesanan.pemesanan', compact('pemesanan'));
    }
    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'statuspemesanan' => 'required|in:Setujui,Batal,Proses',
    ]);

    $pemesanan = Pemesanan::findOrFail($id);
    $pemesanan->statuspemesanan = $request->statuspemesanan;
    $pemesanan->save();

    return back()->with('success', 'Status pemesanan berhasil diperbarui.');
}

public function kirimWaAjax(Request $request)
{
    $order = Pemesanan::findOrFail($request->id);

    $pesan = "*Konfirmasi Pemesanan*\n".
             "Halo *{$order->namapelanggan}*,\n".
             "Pemesanan Anda untuk jasa *" . ($order->jasa->namajasa ?? '-') . "* status *{$order->statuspemesanan}*.\n".
             "Jadwal: {$order->jadwalpemotretan}\n".
             "Total: Rp" . number_format($order->totalharga, 0, ',', '.') . "\n\n".
             "Terima kasih telah menggunakan layanan kami!";

    $response = Http::withOptions(['verify' => false])->withHeaders([
        'Authorization' => '9fd5BVdFtu6m4tYmHYMQ'
    ])->post('https://api.fonnte.com/send', [
        'target' => $order->nomorwa,
        'message' => $pesan,
        'countryCode' => '62'
    ]);

    return response()->json(['success' => $response->successful()]);
}



}
