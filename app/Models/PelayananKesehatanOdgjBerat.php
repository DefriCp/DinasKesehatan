<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelayananKesehatanOdgjBerat extends Model
{
    use HasFactory;

    protected $table = 'pelayanan_kesehatan_odgj_berat';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',
        'sasaran_odgj_berat',
        'skizo_0_14',
        'skizo_15_59',
        'skizo_60_plus',
        'psikotik_0_14',
        'psikotik_15_59',
        'psikotik_60_plus',
        'total_0_14',
        'total_15_59',
        'total_60_plus',
        'pelayanan_jumlah',
        'pelayanan_persen',
        'catatan',
    ];

    protected $casts = [
        'tahun'              => 'integer',

        'sasaran_odgj_berat' => 'integer',

        'skizo_0_14'         => 'integer',
        'skizo_15_59'        => 'integer',
        'skizo_60_plus'      => 'integer',

        'psikotik_0_14'      => 'integer',
        'psikotik_15_59'     => 'integer',
        'psikotik_60_plus'   => 'integer',

        'total_0_14'         => 'integer',
        'total_15_59'        => 'integer',
        'total_60_plus'      => 'integer',

        'pelayanan_jumlah'   => 'integer',
        'pelayanan_persen'   => 'float',
    ];
}
