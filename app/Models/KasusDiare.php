<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasusDiare extends Model
{
    use HasFactory;

    protected $table = 'kasus_diare';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',

        'jumlah_penduduk',

        'target_penemuan_semua_umur',
        'target_penemuan_balita',

        'diare_dilayani_semua_jumlah',
        'diare_dilayani_semua_persen',
        'diare_dilayani_balita_jumlah',
        'diare_dilayani_balita_persen',

        'oralit_semua_jumlah',
        'oralit_semua_persen',
        'oralit_balita_jumlah',
        'oralit_balita_persen',

        'zinc_balita_jumlah',
        'zinc_balita_persen',

        'oralit_zinc_balita_jumlah',
        'oralit_zinc_balita_persen',

        'angka_kesakitan_semua_per1000',
        'angka_kesakitan_balita_per1000',
    ];

    protected $casts = [
        'diare_dilayani_semua_persen'     => 'float',
        'diare_dilayani_balita_persen'    => 'float',
        'oralit_semua_persen'             => 'float',
        'oralit_balita_persen'            => 'float',
        'zinc_balita_persen'              => 'float',
        'oralit_zinc_balita_persen'       => 'float',
        'angka_kesakitan_semua_per1000'   => 'float',
        'angka_kesakitan_balita_per1000'  => 'float',
    ];
}
