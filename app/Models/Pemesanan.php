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
        'id_user',
        'id_pelanggan',
        'id_jasa',
        'jadwalpemotretan',
        'tipepembayaran',
        'metodepembayaran',
        'jumlahdp',
        'sisapembayaran',
        'totalharga',
        'statuspemesanan',
        'gambarbuktipembayaran',
        'gambarbuktipelunasan',
    ];

    public $timestamps = false;
    public function karyawan()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'id_pelanggan', 'id_user');
    }

    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'id_jasa', 'id_jasa');
    }
}
