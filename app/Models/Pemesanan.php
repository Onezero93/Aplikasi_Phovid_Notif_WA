<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';

    protected $primaryKey = 'id_pemesanan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
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
        'gambuktipembayaran',
    ];

    public $timestamps = false;

}
