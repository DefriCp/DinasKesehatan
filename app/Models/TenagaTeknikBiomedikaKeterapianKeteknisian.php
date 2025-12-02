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

    protected $casts = [
        'atl_l'            => 'integer',
        'atl_p'            => 'integer',
        'atl_total'        => 'integer',

        'biomedika_l'      => 'integer',
        'biomedika_p'      => 'integer',
        'biomedika_total'  => 'integer',

        'keterapian_l'     => 'integer',
        'keterapian_p'     => 'integer',
        'keterapian_total' => 'integer',

        'keteknisian_l'    => 'integer',
        'keteknisian_p'    => 'integer',
        'keteknisian_total'=> 'integer',
    ];
}
