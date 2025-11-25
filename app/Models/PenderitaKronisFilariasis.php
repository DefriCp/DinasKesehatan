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
}
