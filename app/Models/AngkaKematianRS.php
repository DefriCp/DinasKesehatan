<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AngkaKematianRS extends Model
{
    protected $table = 'angka_kematian_rs';

    protected $fillable = [
        'nama_rs', 'tempat_tidur',
        'pk_l', 'pk_p', 'pk_total',
        'm_l', 'm_p', 'm_total',
        'm48_l', 'm48_p', 'm48_total',
        'gdr_l', 'gdr_p', 'gdr_total',
        'ndr_l', 'ndr_p', 'ndr_total',
    ];

    protected $casts = [
        'tempat_tidur' => 'integer',

        'pk_l' => 'integer',
        'pk_p' => 'integer',
        'pk_total' => 'integer',

        'm_l' => 'integer',
        'm_p' => 'integer',
        'm_total' => 'integer',

        'm48_l' => 'integer',
        'm48_p' => 'integer',
        'm48_total' => 'integer',

        'gdr_l' => 'float',
        'gdr_p' => 'float',
        'gdr_total' => 'float',

        'ndr_l' => 'float',
        'ndr_p' => 'float',
        'ndr_total' => 'float',
    ];
}
