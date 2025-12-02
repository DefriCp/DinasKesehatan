<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenagaKesmasKeslingdanGizi extends Model
{
    protected $table = 'tenaga_kesmas_kesling_dan_gizi';

    protected $fillable = [
        'unit_kerja',
        'kesmas_l', 'kesmas_p', 'kesmas_total',
        'kesling_l', 'kesling_p', 'kesling_total',
        'gizi_l', 'gizi_p', 'gizi_total',
    ];

    protected $casts = [
        'kesmas_l'      => 'integer',
        'kesmas_p'      => 'integer',
        'kesmas_total'  => 'integer',

        'kesling_l'     => 'integer',
        'kesling_p'     => 'integer',
        'kesling_total' => 'integer',

        'gizi_l'        => 'integer',
        'gizi_p'        => 'integer',
        'gizi_total'    => 'integer',
    ];
}
