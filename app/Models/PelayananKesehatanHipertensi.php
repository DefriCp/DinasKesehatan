<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelayananKesehatanHipertensi extends Model
{
    use HasFactory;

    protected $table = 'pelayanan_kesehatan_hipertensi';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',

        'estimasi_l',
        'estimasi_p',
        'estimasi_total',

        'pelayanan_l_jumlah',
        'pelayanan_l_persen',

        'pelayanan_p_jumlah',
        'pelayanan_p_persen',

        'pelayanan_total_jumlah',
        'pelayanan_total_persen',

        'catatan',
    ];

    protected $casts = [
    'tahun' => 'integer',

    'estimasi_l'     => 'integer',
    'estimasi_p'     => 'integer',
    'estimasi_total' => 'integer',

    'pelayanan_l_jumlah'     => 'integer',
    'pelayanan_p_jumlah'     => 'integer',
    'pelayanan_total_jumlah' => 'integer',

    'pelayanan_l_persen'     => 'float',
    'pelayanan_p_persen'     => 'float',
    'pelayanan_total_persen' => 'float',
];

}
