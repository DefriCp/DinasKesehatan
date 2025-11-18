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
}
