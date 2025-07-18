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
        $query = Pemesanan::with('jasa', 'pelanggan');

        // Pencarian
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('pelanggan', function ($q) use ($request) {
                $q->where('namalengkap', 'like', '%' . $request->search . '%')
                    ->orWhere('alamat', 'like', '%' . $request->search . '%')
                    ->orWhere('nomortelepon', 'like', '%' . $request->search . '%');
            })->orWhereHas('jasa', function ($q) use ($request) {
                $q->where('namajasa', 'like', '%' . $request->search . '%');
            });
        }

        $karyawan = User::where('status', 'karyawan')->get();
        $pemesanan = $query->get();

        return view('pesanan.pemesanan', compact('pemesanan', 'karyawan'));
    }

    public function updateStatus(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'statuspemesanan' => 'required|in:Setujui,Batal,Proses',
            'statuspembayaran' => 'required|in:Lunas,Belum Lunas',
            'id_user' => 'nullable|exists:user,id_user',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->statuspemesanan = $request->statuspemesanan;
        $pemesanan->statuspembayaran = $request->statuspembayaran;
        $pemesanan->id_user = $request->id_user;
        $pemesanan->save();

        return back()->with('success', 'Status pemesanan berhasil diperbarui.');
    }

    public function kirimWaAjax(Request $request)
    {
        $order = Pemesanan::with(['jasa', 'pelanggan', 'karyawan'])->findOrFail($request->id);

        // Pastikan nomor WhatsApp pelanggan diawali 62
        $nomorPelanggan = $order->pelanggan->nomortelepon;
        if (str_starts_with($nomorPelanggan, '0')) {
            $nomorPelanggan = '62' . substr($nomorPelanggan, 1);
        }

        // Pesan untuk pelanggan
        if ($order->statuspemesanan === 'Setujui') {
            // Kirim ke pelanggan
            $pesan = "*📸 Pesanan Anda*\n" .
                "Halo *{$order->pelanggan->namalengkap}*,\n" .
                "Pemesanan Anda untuk jasa *" . ($order->jasa->namajasa ?? '-') . "* telah *{$order->statuspemesanan}*.\n" .
                "🗓 Jadwal: *{$order->jadwalpemotretan}*\n" .
                "Tipe Pembayaran: *{$order->tipepembayaran}*\n" .
                "Metode Pembayaran: *{$order->metodepembayaran}*\n";

            if ($order->tipepembayaran === 'dp') {
                $pesan .= "💰 Pembayaran DP: *Rp" . number_format($order->jumlahdp, 0, ',', '.') . "*\n" .
                    "💰 Sisa Pembayaran: *Rp" . number_format($order->sisapembayaran, 0, ',', '.') . "*\n";
            }

            $pesan .= "💰 Total: *Rp" . number_format($order->totalharga, 0, ',', '.') . "*\n" .
                "Status Pembayaran: *{$order->statuspembayaran}*\n";

            // Tambahan jika tipe DP
            if ($order->tipepembayaran === 'dp') {
                $pesan .= "⚠️ *Mohon lunasi sebelum jadwal pemotretan*\n";
            }

            $pesan .= "\nTerima kasih telah menggunakan layanan kami 🙏";

            Http::withOptions(['verify' => false])->withHeaders([
                'Authorization' => '9fd5BVdFtu6m4tYmHYMQ'
            ])->post('https://api.fonnte.com/send', [
                'target' => $nomorPelanggan,
                'message' => $pesan,
            ]);

            // Kirim ke karyawan jika ada
            if ($order->karyawan && $order->karyawan->nomortelepon) {
                $nomorKaryawan = $order->karyawan->nomortelepon;
                if (str_starts_with($nomorKaryawan, '0')) {
                    $nomorKaryawan = '62' . substr($nomorKaryawan, 1);
                }

                $pesanKaryawan = "*📥 Ada Tugas nih*\n" .
                    "Pelanggan: *{$order->pelanggan->namalengkap}*\n" .
                    "Jasa: *" . ($order->jasa->namajasa ?? '-') . "*\n" .
                    "No WhatsApp: *" . ($order->pelanggan->nomortelepon ?? '-') . "*\n" .
                    "Jadwal: {$order->jadwalpemotretan}\n";

                Http::withOptions(['verify' => false])->withHeaders([
                    'Authorization' => '9fd5BVdFtu6m4tYmHYMQ'
                ])->post('https://api.fonnte.com/send', [
                    'target' => $nomorKaryawan,
                    'message' => $pesanKaryawan,
                ]);
            }
        } elseif ($order->statuspemesanan === 'Batal') {
            // Kirim ke pelanggan untuk pembatalan
            $pesan = "*📸 Pesanan Anda Dibatalkan*\n" .
                "Halo *{$order->pelanggan->namalengkap}*,\n" .
                "Kami informasikan bahwa pemesanan Anda untuk jasa *" . ($order->jasa->namajasa ?? '-') . "* pada tanggal *{$order->jadwalpemotretan}* telah *DIBATALKAN*.\n\n" .
                "Jika pembatalan ini tidak sesuai atau Anda ingin memesan ulang, silakan hubungi kami kembali.\n\n" .
                "Terima kasih 🙏";

            Http::withOptions(['verify' => false])->withHeaders([
                'Authorization' => '9fd5BVdFtu6m4tYmHYMQ'
            ])->post('https://api.fonnte.com/send', [
                'target' => $nomorPelanggan,
                'message' => $pesan,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
