<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class DashboardController extends Controller
{
    public function grafikPendapatan()
{
    // Ambil data yang statusnya "Setujui"
    $data = Pemesanan::where('statuspemesanan', 'Setujui')->get();

    // Jumlah pelanggan sesuai status
    $jumlahPelangganDisetujui = $data->count();
    $jumlahPelangganDibatalkan = Pemesanan::where('statuspemesanan', 'Batal')->count();
    $jumlahPelangganDiproses = Pemesanan::where('statuspemesanan', 'Proses')->count();

    // Total pendapatan (semua totalharga yang disetujui)
    $totalPendapatan = $data->sum('totalharga');

    // Kelompokkan berdasarkan bulan dari jadwalpemotretan
    $grouped = $data->groupBy(function ($item) {
        return date('F', strtotime($item->jadwalpemotretan)); // contoh: "January"
    });

    // Siapkan data untuk grafik
    $labels = [];
    $values = [];

    foreach ($grouped as $bulan => $items) {
        $labels[] = $bulan;
        $values[] = $items->sum('totalharga'); // jumlahkan per bulan
    }

    return view('dashboard.halamanutama', compact(
        'labels',
        'values',
        'jumlahPelangganDisetujui',
        'jumlahPelangganDibatalkan',
        'jumlahPelangganDiproses',
        'totalPendapatan'
    ));
}

}
