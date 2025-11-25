<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasusDbd extends Model
{
    use HasFactory;

    protected $table = 'kasus_dbd';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',

        'kasus_l',
        'kasus_p',
        'kasus_total',

        'meninggal_l',
        'meninggal_p',
        'meninggal_total',

        'cfr_l_persen',
        'cfr_p_persen',
        'cfr_total_persen',

        'angka_kesakitan_per100k',
    ];

    protected $casts = [
        'cfr_l_persen'          => 'float',
        'cfr_p_persen'          => 'float',
        'cfr_total_persen'      => 'float',
        'angka_kesakitan_per100k' => 'float',
    ];
}
