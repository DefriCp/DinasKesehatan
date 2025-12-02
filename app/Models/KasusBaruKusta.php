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
        'tahun'             => 'integer',

        'pb_l'              => 'integer',
        'pb_p'              => 'integer',
        'pb_total'          => 'integer',

        'mb_l'              => 'integer',
        'mb_p'              => 'integer',
        'mb_total'          => 'integer',

        'total_l'           => 'integer',
        'total_p'           => 'integer',
        'total_kasus'       => 'integer',

        'ncdr_l_per100k'    => 'float',
        'ncdr_p_per100k'    => 'float',
        'ncdr_total_per100k'=> 'float',
    ];
}
