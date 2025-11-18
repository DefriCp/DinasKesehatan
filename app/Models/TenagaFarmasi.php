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
}
