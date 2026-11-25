<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioProfile extends Model
{
    protected $fillable = [
        'nama',
        'nrp',
        'prodi',
        'email',
        'posisi',
        'deskripsi',
        'status',
        'foto',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
