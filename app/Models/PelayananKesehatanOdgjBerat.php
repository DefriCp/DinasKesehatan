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
        'tahun'            => 'integer',
        'pelayanan_persen' => 'float',
    ];
}
