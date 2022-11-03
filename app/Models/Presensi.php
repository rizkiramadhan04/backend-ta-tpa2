<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_id',
        'status_presensi',
        'tanggal_masuk',
        'tanggal_izin',
        'jadwal_presensi_id',
        'kode_jadwal_presensi',
    ];
}
