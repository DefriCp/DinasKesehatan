<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelayananKesehatanUsiaProduktif extends Model
{
    protected $table = 'pelayanan_kesehatan_usia_produktifs';

    protected $fillable = [
        'kecamatan',
        'puskesmas',

        'penduduk_l',
        'penduduk_p',
        'penduduk_total',

        'skrining_l',
        'skrining_l_persen',
        'skrining_p',
        'skrining_p_persen',
        'skrining_total',
        'skrining_total_persen',

        'berisiko_l',
        'berisiko_l_persen',
        'berisiko_p',
        'berisiko_p_persen',
        'berisiko_total',
        'berisiko_total_persen',
    ];

    protected $casts = [
        'penduduk_l' => 'integer',
        'penduduk_p' => 'integer',
        'penduduk_total' => 'integer',

        'skrining_l' => 'integer',
        'skrining_l_persen' => 'float',
        'skrining_p' => 'integer',
        'skrining_p_persen' => 'float',
        'skrining_total' => 'integer',
        'skrining_total_persen' => 'float',

        'berisiko_l' => 'integer',
        'berisiko_l_persen' => 'float',
        'berisiko_p' => 'integer',
        'berisiko_p_persen' => 'float',
        'berisiko_total' => 'integer',
        'berisiko_total_persen' => 'float',
    ];
}
