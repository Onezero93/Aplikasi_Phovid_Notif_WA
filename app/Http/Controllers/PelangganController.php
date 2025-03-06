<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jasa;

class PelangganController extends Controller
{
    //
    public function buatPesanan($id_jasa)
{
    $pesananjasa = Jasa::findOrFail($id_jasa);
    return view('pelanggan.pesanan', compact('pesananjasa'));
}

}
