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
        'kasus_l'     => 'integer',
        'kasus_p'     => 'integer',
        'kasus_total' => 'integer',

        'meninggal_l'     => 'integer',
        'meninggal_p'     => 'integer',
        'meninggal_total' => 'integer',

        'cfr_l_persen'        => 'float',
        'cfr_p_persen'        => 'float',
        'cfr_total_persen'    => 'float',
        'angka_kesakitan_per100k' => 'float',
    ];
}
