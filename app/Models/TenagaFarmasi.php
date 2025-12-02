<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenagaFarmasi extends Model
{
    protected $table = 'tenaga_farmasi';

    protected $fillable = [
        'unit_kerja',
        'ttk_l', 'ttk_p', 'ttk_total',
        'apoteker_l', 'apoteker_p', 'apoteker_total',
        'total_l', 'total_p', 'total_total',
    ];

    protected $casts = [
        'ttk_l'          => 'integer',
        'ttk_p'          => 'integer',
        'ttk_total'      => 'integer',
        'apoteker_l'     => 'integer',
        'apoteker_p'     => 'integer',
        'apoteker_total' => 'integer',
        'total_l'        => 'integer',
        'total_p'        => 'integer',
        'total_total'    => 'integer',
    ];
}
