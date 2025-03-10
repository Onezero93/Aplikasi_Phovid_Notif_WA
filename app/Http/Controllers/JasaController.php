<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jasa;

class JasaController extends Controller
{
    //
    public function tampilJasa(Request $request){
        $jasa = Jasa::all();
        return view('jasa.jasaphovid', compact('jasa'));
    }

    public function tambahJasa(Request $request){
        $request->validate([
            'namajasa' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',


        ]);
        $gambarJasa = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambarJasa = 'fotosjasa/' . $gambarName;
            $gambar->move(public_path('fotosjasa'), $gambarName);
        }

        Jasa::create([
            'namajasa' => $request->namajasa,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $gambarJasa,

        ]);

        return redirect()->route('jasa.datajasa')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function detailJasa($id_jasa)
{
    $jasa = Jasa::findOrFail($id_jasa);
    return view('jasa.detailjasa', compact('jasa'));
}


public function editJasa($id_jasa)
{
    $jasa = Jasa::findOrFail($id_jasa);
    return view('jasa.perbaruijasa', compact('jasa'));
}

public function perbaruiJasa(Request $request, $id_jasa)
{
    $request->validate([
        'namajasa' => 'required|string|max:255',
        'deskripsi' => 'required|string|max:255',
        'harga' => 'required|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $jasa = Jasa::findOrFail($id_jasa);

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($jasa->gambar && file_exists(public_path($jasa->gambar))) {
            unlink(public_path($jasa->gambar));
        }

        // Simpan gambar baru
        $gambar = $request->file('gambar');
        $gambarName = time() . '_' . $gambar->getClientOriginalName();
        $gambarJasa = 'fotosjasa/' . $gambarName;
        $gambar->move(public_path('fotosjasa'), $gambarName);
        $jasa->gambar = $gambarJasa;
    }

    // Perbarui data jasa
    $jasa->update([
        'namajasa' => $request->namajasa,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
    ]);

    return redirect()->route('jasa.datajasa')->with('success', 'Jasa berhasil diperbarui!');
}

}
