<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_user',
        'status_presensi',
        'tanggal_masuk',
        'tanggal_izin',
        'alasan_izin',
        'jenis_presensi',
        'kode_jadwal_presensi',
    ];
}
