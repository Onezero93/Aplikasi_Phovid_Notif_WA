<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';

    protected $primaryKey = 'id_pemesanan';

    protected $fillable = [
        'id_jasa', // Tambahkan id_jasa di sini
        'namapelanggan',
        'alamat',
        'nomorwa',
        'jadwalpemotretan',
        'tipepembayaran',
        'metodepembayaran',
        'jumlahdp',
        'sisapembayaran',
        'totalharga',
        'statuspemesanan',
        'gambarbuktipembayaran',
    ];

    public $timestamps = false;

    // Definisi relasi ke model Jasa
    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'id_jasa', 'id_jasa');
    }
}
