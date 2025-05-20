<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;
use App\Models\User;
class KaryawanController extends Controller
{
    //
   public function tugasKaryawan()
{
    $user = Auth::user();

    // Cek apakah user adalah karyawan
    if ($user->statuspemesanan === 'karyawan') {
        $tugas = Pemesanan::where('id_user', $user->id_user)
                          ->where('statuspemesanan', 'Setujui')
                          ->with('jasa')
                          ->get();
    } else {
        // Kalau admin, bisa lihat semua yang Setujui
        $tugas = Pemesanan::where('statuspemesanan', 'Setujui')
                          ->with('jasa')
                          ->get();
    }

    return view('karyawan.tugaskaryawan', compact('tugas'));
}

}
