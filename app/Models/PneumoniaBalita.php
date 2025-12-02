<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PneumoniaBalita extends Model
{
    use HasFactory;

    protected $table = 'pneumonia_balita';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',

        'jumlah_balita',

        'balita_batuk_kunjungan',
        'balita_batuk_tatalaksana_l',
        'balita_batuk_tatalaksana_p',
        'balita_batuk_tatalaksana_persen',

        'perkiraan_pneumonia_balita',

        'pneumonia_l',
        'pneumonia_p',
        'pneumonia_berat_l',
        'pneumonia_berat_p',

        'jumlah_pneumonia_l',
        'jumlah_pneumonia_p',
        'jumlah_pneumonia_total',
        'penemuan_pneumonia_persen',

        'batuk_non_pneumonia_l',
        'batuk_non_pneumonia_p',
        'batuk_non_pneumonia_total',
    ];

    protected $casts = [
        'tahun'                         => 'integer',
        'jumlah_balita'                 => 'integer',
        'balita_batuk_kunjungan'       => 'integer',
        'balita_batuk_tatalaksana_l'   => 'integer',
        'balita_batuk_tatalaksana_p'   => 'integer',
        'balita_batuk_tatalaksana_persen' => 'float',

        'perkiraan_pneumonia_balita'   => 'integer',

        'pneumonia_l'                  => 'integer',
        'pneumonia_p'                  => 'integer',
        'pneumonia_berat_l'            => 'integer',
        'pneumonia_berat_p'            => 'integer',

        'jumlah_pneumonia_l'           => 'integer',
        'jumlah_pneumonia_p'           => 'integer',
        'jumlah_pneumonia_total'       => 'integer',
        'penemuan_pneumonia_persen'    => 'float',

        'batuk_non_pneumonia_l'        => 'integer',
        'batuk_non_pneumonia_p'        => 'integer',
        'batuk_non_pneumonia_total'    => 'integer',
    ];
}
