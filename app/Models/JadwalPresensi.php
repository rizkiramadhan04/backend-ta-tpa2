<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPresensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kegiatan',
        'tanggal_awal',
        'tanggal_akhir',
        'kode_presensi',
    ];
}
