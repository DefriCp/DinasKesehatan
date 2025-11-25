<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KejadianLuarBiasa extends Model
{
    use HasFactory;

    protected $table = 'kejadian_luar_biasa';

    protected $fillable = [
        'jenis_klb',
        'jumlah_kec',
        'jumlah_desa_kel',

        'tanggal_diketahui',
        'tanggal_ditanggulangi',
        'tanggal_akhir',

        'penderita_l',
        'penderita_p',
        'penderita_total',

        'umur_0_7_hari',
        'umur_8_28_hari',
        'umur_1_11_bln',
        'umur_1_4_thn',
        'umur_5_9_thn',
        'umur_10_14_thn',
        'umur_15_19_thn',
        'umur_20_44_thn',
        'umur_45_54_thn',
        'umur_55_59_thn',
        'umur_60_69_thn',
        'umur_70_plus_thn',

        'kematian_l',
        'kematian_p',
        'kematian_total',

        'penduduk_terancam_l',
        'penduduk_terancam_p',
        'penduduk_terancam_total',

        'attack_rate_l_persen',
        'attack_rate_p_persen',
        'attack_rate_total_persen',

        'cfr_l_persen',
        'cfr_p_persen',
        'cfr_total_persen',
    ];

    protected $casts = [
        'tanggal_diketahui'     => 'date',
        'tanggal_ditanggulangi' => 'date',
        'tanggal_akhir'         => 'date',

        'attack_rate_l_persen'     => 'float',
        'attack_rate_p_persen'     => 'float',
        'attack_rate_total_persen' => 'float',
        'cfr_l_persen'             => 'float',
        'cfr_p_persen'             => 'float',
        'cfr_total_persen'         => 'float',
    ];
}
