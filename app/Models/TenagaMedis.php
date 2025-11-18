<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenagaMedis extends Model
{
    protected $table = 'tenaga_medis';

    protected $fillable = [
        'unit_kerja',
        'sp_l', 'sp_p', 'sp_total',
        'dr_l', 'dr_p', 'dr_total',
        'dokter_l', 'dokter_p', 'dokter_total',
        'gigi_l', 'gigi_p', 'gigi_total',
        'gigis_l', 'gigis_p', 'gigis_total',
        'jumlah_gigi_l', 'jumlah_gigi_p', 'jumlah_gigi_total',
    ];
}

