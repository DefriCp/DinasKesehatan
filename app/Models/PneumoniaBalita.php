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
        'balita_batuk_tatalaksana_persen' => 'float',
        'penemuan_pneumonia_persen'       => 'float',
    ];
}
