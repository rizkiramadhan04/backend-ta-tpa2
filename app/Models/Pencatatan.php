<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pencatatan extends Model
{
    use HasFactory;

    protected $fillable = [

        'murid_id',
        'no_surat',
        'no_ayat',
        'no_iqro',
        'jilid',
        'halaman',
        'guru_id',
        'hasil',
        'tanggal',
    ];
}
