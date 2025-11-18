<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenagaTeknikBiomedikaKeterapianKeteknisian extends Model
{
    protected $table = 'tenaga_teknik_biomedika_keterapian_keteknisian';

    protected $fillable = [
        'unit_kerja',

        'atl_l', 'atl_p', 'atl_total',
        'biomedika_l', 'biomedika_p', 'biomedika_total',
        'keterapian_l', 'keterapian_p', 'keterapian_total',
        'keteknisian_l', 'keteknisian_p', 'keteknisian_total',
    ];
}
