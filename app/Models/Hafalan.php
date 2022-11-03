<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hafalan extends Model
{
    use HasFactory;

    protected $fillable = [
        'murid_id',
        'materi_hafalan',
        'tgl_hafalan',
        'nilai',
        'guru_id',
    ];
}
