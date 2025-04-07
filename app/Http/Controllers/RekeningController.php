<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekening;

class RekeningController extends Controller
{
    //
    public function tampilRekening(Request $request){
        $rekening = Rekening::all();
        return view('rekening.rekening', compact('rekening'));
    }

    public function tambahRekening(Request $request){
        $request->validate([
            'namapemilik' => 'required|string|max:255',
            'namabang' => 'required|string|max:255',
            'nomorrek' => 'required|string|max:255',


        ]);

        Rekening::create([
            'namapemilik' => $request->namapemilik,
            'namabang' => $request->namabang,
            'nomorrek' => $request->nomorrek,

        ]);

        return redirect()->route('rekening.datarekening')->with('success', 'Rekening berhasil ditambahkan!');
    }

    public function perbaruiDataRekening(Request $request, string $id_rekening)
{
    $rekening = Rekening::findOrFail($id_rekening);

    $request->validate([
        'namapemilik' => 'required|string|max:255',
        'namabang' => 'required|string|max:255',
        'nomorrek' => 'required|string|max:255',
    ]);

    $rekening->update($request->only(['namabang', 'nomorrek','namapemilik']));

    return redirect()->route('rekening.datarekening')->with('success', 'Pengguna berhasil diperbarui!');
}


    //hapus Pengguna
    public function hapusDataRekening(string $id)
    {
        $rekening = Rekening::find($id);

        $rekening->delete();

        return redirect()->route('rekening.datarekening')->with('success', 'Pengguna berhasil dihapus!');
    }

}
