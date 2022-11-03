<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaSurah extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_surah', 'nama_surah', 'no_ayat'
    ];
}
