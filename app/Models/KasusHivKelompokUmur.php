<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasusHivKelompokUmur extends Model
{
    use HasFactory;

    protected $table = 'kasus_hiv_kelompok_umur';

    protected $fillable = [
        'tahun',
        'kelompok_umur',

        'kasus_l',
        'kasus_p',
        'kasus_total',
        'proporsi_kelompok_umur_persen',

        'estimasi_orang_berisiko',
        'berisiko_dapat_pelayanan',
        'persen_berisiko_dapat_pelayanan',
    ];

    protected $casts = [
        'tahun'                         => 'integer',
        'kasus_l'                       => 'integer',
        'kasus_p'                       => 'integer',
        'kasus_total'                   => 'integer',
        'proporsi_kelompok_umur_persen' => 'float',

        'estimasi_orang_berisiko'       => 'integer',
        'berisiko_dapat_pelayanan'      => 'integer',
        'persen_berisiko_dapat_pelayanan' => 'float',
    ];
}
