<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasusBaruKusta extends Model
{
    use HasFactory;

    protected $table = 'kasus_baru_kusta';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',

        'pb_l',
        'pb_p',
        'pb_total',

        'mb_l',
        'mb_p',
        'mb_total',

        'total_l',
        'total_p',
        'total_kasus',

        'ncdr_l_per100k',
        'ncdr_p_per100k',
        'ncdr_total_per100k',
    ];

    protected $casts = [
        'ncdr_l_per100k'     => 'float',
        'ncdr_p_per100k'     => 'float',
        'ncdr_total_per100k' => 'float',
    ];
}
