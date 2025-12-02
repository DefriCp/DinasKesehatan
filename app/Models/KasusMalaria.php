<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasusMalaria extends Model
{
    use HasFactory;

    protected $table = 'kasus_malaria';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',

        'suspek',

        'konfirmasi_mikroskopis',
        'konfirmasi_rdt',
        'konfirmasi_total',
        'konfirmasi_persen',

        'positif_l',
        'positif_p',
        'positif_total',

        'pengobatan_l',
        'pengobatan_p',
        'pengobatan_total',
        'pengobatan_persen',

        'meninggal_l',
        'meninggal_p',
        'meninggal_total',

        'cfr_l_persen',
        'cfr_p_persen',
        'cfr_total_persen',

        'api_per1000',
    ];

    protected $casts = [
        'tahun'             => 'integer',

        'suspek'            => 'integer',

        'konfirmasi_mikroskopis' => 'integer',
        'konfirmasi_rdt'         => 'integer',
        'konfirmasi_total'       => 'integer',
        'konfirmasi_persen'      => 'float',

        'positif_l'         => 'integer',
        'positif_p'         => 'integer',
        'positif_total'     => 'integer',

        'pengobatan_l'      => 'integer',
        'pengobatan_p'      => 'integer',
        'pengobatan_total'  => 'integer',
        'pengobatan_persen' => 'float',

        'meninggal_l'       => 'integer',
        'meninggal_p'       => 'integer',
        'meninggal_total'   => 'integer',

        'cfr_l_persen'      => 'float',
        'cfr_p_persen'      => 'float',
        'cfr_total_persen'  => 'float',

        'api_per1000'       => 'float',
    ];
}
