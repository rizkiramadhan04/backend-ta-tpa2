<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'jenis_pembayaran', 'jumlah', 'no_rek', 'gambar', 'status',
    ];
}
