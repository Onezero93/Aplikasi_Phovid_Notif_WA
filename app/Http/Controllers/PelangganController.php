<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jasa;
use App\Models\Pemesanan;
use App\Models\Rekening;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PelangganController extends Controller
{
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
        // dd($request->all());
        $jadwalSudahAda = Pemesanan::where('jadwalpemotretan', $request->jadwalpemotretan)->exists();

        if ($jadwalSudahAda) {
            return back()->with('error', 'Jadwal pemotretan sudah dipesan, silakan pilih jadwal lain.')->withInput();
        }

        $request->validate([
            'id_jasa' => 'required|exists:jasa,id_jasa',
            'jadwalpemotretan' => 'required|date',
            'tipepembayaran' => 'required|in:dp,kontan',
            'metodepembayaran' => 'required|in:Transfer,Tunai',
            'jumlahdp' => 'nullable|numeric|min:0',
            'sisapembayaran' => 'nullable|numeric|min:0',
            'totalharga' => 'required|numeric|min:0',
            'statuspemesanan' => 'nullable|in:Setujui,Batal,Proses',
            'gambarbuktipembayaran' => $request->metodepembayaran == 'Transfer'
                ? 'required|image|mimes:jpeg,png,jpg|max:2048'
                : 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'required|string|max:255',
        ]);

        $user = User::find(Auth::id());
        $user->alamat = $request->alamat;
        $user->save();

        // Simpan data pemesanan
        $pemesanan = new Pemesanan();
        $pemesanan->id_user = null; // karena ini pelanggan, bukan admin
        $pemesanan->id_pelanggan = $user->id_user;
        $pemesanan->id_jasa = $request->id_jasa;
        $pemesanan->jadwalpemotretan = $request->jadwalpemotretan;
        $pemesanan->tipepembayaran = $request->tipepembayaran;
        $pemesanan->metodepembayaran = $request->metodepembayaran;
        $pemesanan->jumlahdp = $request->jumlahdp ?? 0;
        $pemesanan->sisapembayaran = $request->sisapembayaran ?? 0;
        $pemesanan->totalharga = $request->totalharga;
        $pemesanan->statuspemesanan = $request->statuspemesanan ?? 'Proses';

        // Upload bukti pembayaran jika ada
        if ($request->hasFile('gambarbuktipembayaran')) {
            $file = $request->file('gambarbuktipembayaran');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('bukti_pembayaran', $filename, 'public');
            $pemesanan->gambarbuktipembayaran = $path;
        }
        $pemesanan->save();

        // Kirim notifikasi ke WhatsApp admin via Fonnte
        $token = '9fd5BVdFtu6m4tYmHYMQ'; // Ganti dengan token milikmu

        $jadwalFormat = str_replace('T', ' ', $pemesanan->jadwalpemotretan);

        $pesanAdmin = "*📸 Pesanan Baru Masuk!*\n";
        $pesanAdmin .= "Nama: {$user->namalengkap}\n";
        $pesanAdmin .= "Nama: {$user->nomortelepon}\n";
        $pesanAdmin .= "Jadwal: {$jadwalFormat}\n";
        $pesanAdmin .= "Tipe: {$pemesanan->tipepembayaran}\n";
        $pesanAdmin .= "Metode: {$pemesanan->metodepembayaran}\n";

        if ($pemesanan->tipepembayaran === 'DP') {
            $pesanAdmin .= "DP: Rp " . number_format($pemesanan->jumlahdp, 0, ',', '.') . "\n";
            $pesanAdmin .= "Sisa: Rp " . number_format($pemesanan->sisapembayaran, 0, ',', '.') . "\n";
        }

        $pesanAdmin .= "Total: Rp " . number_format($pemesanan->totalharga, 0, ',', '.');

        Http::withOptions(['verify' => false])
            ->withHeaders(['Authorization' => $token])
            ->post('https://api.fonnte.com/send', [
                'target' => '6281917716274', // Nomor admin
                'message' => $pesanAdmin,
            ]);

        return redirect()->route('riwayat')->with('success', 'Pesanan berhasil dibuat!');
    }
    public function riwayat()
    {
        $userId = auth()->user()->id_user;

        $riwayat = Pemesanan::with('jasa')
            ->where('id_pelanggan', $userId)
            ->orderByDesc('id_pemesanan')
            ->get();

        return view('pelanggan.riwayat', compact('riwayat'));
    }

    public function uploadPelunasan(Request $request, $id)
{
    $request->validate([
        'gambarbuktipelunasan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $pemesanan = Pemesanan::findOrFail($id);

    // Simpan file ke storage/app/public/bukti_pelunasan
    $path = $request->file('gambarbuktipelunasan')->store('bukti_pelunasan', 'public');

    // Simpan file dan atur nilai pembayaran
    $pemesanan->gambarbuktipelunasan = $path;
    $pemesanan->jumlahdp = 0;
    $pemesanan->sisapembayaran = 0;
    $pemesanan->save();

    return back()->with('success', 'Bukti pelunasan berhasil diupload.');
}

}
