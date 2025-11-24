<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelayananKesehatanUsiaProduktif extends Model
{
    use HasFactory;

    protected $table = 'pelayanan_kesehatan_usia_produktif';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',

        'penduduk_laki_laki',
        'penduduk_perempuan',
        'penduduk_total',

        'skrining_laki_laki_jumlah',
        'skrining_laki_laki_persen',
        'skrining_perempuan_jumlah',
        'skrining_perempuan_persen',
        'skrining_total_jumlah',
        'skrining_total_persen',

        'berisiko_laki_laki_jumlah',
        'berisiko_laki_laki_persen',
        'berisiko_perempuan_jumlah',
        'berisiko_perempuan_persen',
        'berisiko_total_jumlah',
        'berisiko_total_persen',
    ];

    protected $casts = [
        'skrining_laki_laki_persen'      => 'float',
        'skrining_perempuan_persen'      => 'float',
        'skrining_total_persen'          => 'float',
        'berisiko_laki_laki_persen'      => 'float',
        'berisiko_perempuan_persen'      => 'float',
        'berisiko_total_persen'          => 'float',
    ];
}
