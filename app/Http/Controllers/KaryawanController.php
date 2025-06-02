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

    if ($user->status === 'karyawan') {
        // Menampilkan tugas hanya untuk karyawan login
        $tugas = Pemesanan::where('id_user', $user->id_user)
                          ->where('statuspemesanan', 'Setujui')
                          ->with('jasa')
                          ->get();
    } else {
        // Admin bisa melihat semua tugas
        $tugas = Pemesanan::where('statuspemesanan', 'Setujui')
                          ->with('jasa')
                          ->get();
    }

    return view('karyawan.tugaskaryawan', compact('tugas'));
}

}
