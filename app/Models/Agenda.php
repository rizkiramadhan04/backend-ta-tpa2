<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_agenda',
        'deskripsi_agenda',
        'tanggal_agenda',
        'gambar',
    ];
}
