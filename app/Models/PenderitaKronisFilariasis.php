<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenderitaKronisFilariasis extends Model
{
    use HasFactory;

    protected $table = 'penderita_kronis_filariasis';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',

        'sebelumnya_l',
        'sebelumnya_p',
        'sebelumnya_total',

        'baru_l',
        'baru_p',
        'baru_total',

        'pindah_l',
        'pindah_p',
        'pindah_total',

        'meninggal_l',
        'meninggal_p',
        'meninggal_total',

        'jumlah_l',
        'jumlah_p',
        'jumlah_total',
    ];

    protected $casts = [
    'tahun' => 'integer',

    'sebelumnya_l' => 'integer',
    'sebelumnya_p' => 'integer',
    'sebelumnya_total' => 'integer',

    'baru_l' => 'integer',
    'baru_p' => 'integer',
    'baru_total' => 'integer',

    'pindah_l' => 'integer',
    'pindah_p' => 'integer',
    'pindah_total' => 'integer',

    'meninggal_l' => 'integer',
    'meninggal_p' => 'integer',
    'meninggal_total' => 'integer',

    'jumlah_l' => 'integer',
    'jumlah_p' => 'integer',
    'jumlah_total' => 'integer',
];

}
