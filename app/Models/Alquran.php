<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alquran extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_surah', 'nama_surah', 'jumlah_ayat'
    ];
}
