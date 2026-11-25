<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'urutan',
    ];
}
