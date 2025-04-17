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
    $tugas = Pemesanan::with('jasa')->get();

    return view('karyawan.tugaskaryawan', compact('tugas'));
}
}
