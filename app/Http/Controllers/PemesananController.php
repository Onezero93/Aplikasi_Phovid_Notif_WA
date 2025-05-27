<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class PemesananController extends Controller
{
    //
    public function tampilPemesanan(Request $request)
    {
        $query = Pemesanan::with('jasa');

        // Cek apakah ada parameter pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('namapelanggan', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%')
                  ->orWhere('nomorwa', 'like', '%' . $request->search . '%')
                  ->orWhereHas('jasa', function ($q) use ($request) {
                      $q->where('namajasa', 'like', '%' . $request->search . '%');
                  });
        }
        $karyawan = User::where('status', 'karyawan')->get();
        $pemesanan = $query->get();


        return view('pesanan.pemesanan', compact('pemesanan','karyawan'));
    }
    public function updateStatus(Request $request, $id)
{
    // dd($request->all());
    $request->validate([
        'statuspemesanan' => 'required|in:Setujui,Batal,Proses',
        'id_user' => 'nullable|exists:user,id_user',
    ]);

    $pemesanan = Pemesanan::findOrFail($id);
    $pemesanan->statuspemesanan = $request->statuspemesanan;
    $pemesanan->id_user = $request->id_user;
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

    // Kirim ke pelanggan
    Http::withOptions(['verify' => false])->withHeaders([
        'Authorization' => '9fd5BVdFtu6m4tYmHYMQ'
    ])->post('https://api.fonnte.com/send', [
        'target' => $order->nomorwa,
        'message' => $pesan,
        'countryCode' => '62'
    ]);

    // Kirim ke karyawan (jika user ada dan punya nomor)
    if ($order->user && $order->user->nomortelepon) {
        $pesanKaryawan = "*Notifikasi Pemesanan Masuk*\n".
                         "Pelanggan: *{$order->namapelanggan}*\n".
                         "Jasa: *" . ($order->jasa->namajasa ?? '-') . "*\n".
                         "Jadwal: {$order->jadwalpemotretan}\n".
                         "Status: *{$order->statuspemesanan}*";

        Http::withOptions(['verify' => false])->withHeaders([
            'Authorization' => '9fd5BVdFtu6m4tYmHYMQ'
        ])->post('https://api.fonnte.com/send', [
            'target' => $order->user->nomortelepon,
            'message' => $pesanKaryawan,
            'countryCode' => '62'
        ]);
    }

    return response()->json(['success' => true]);
}





}
