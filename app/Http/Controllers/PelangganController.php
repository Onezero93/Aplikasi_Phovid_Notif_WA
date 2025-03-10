<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jasa;

class PelangganController extends Controller
{
    //
    public function tampilJasaHome(Request $request){
        $jasahome = Jasa::all();
        return view('pelanggan.home', compact('jasahome'));
    }
    
    public function buatPesanan($id_jasa)
{
    $pesananjasa = Jasa::findOrFail($id_jasa);
    return view('pelanggan.pesanan', compact('pesananjasa'));
}


}
