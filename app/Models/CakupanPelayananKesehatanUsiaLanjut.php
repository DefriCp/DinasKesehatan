<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CakupanPelayananKesehatanUsiaLanjut extends Model
{
    use HasFactory;

    protected $table = 'cakupan_pelayanan_kesehatan_usia_lanjut';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',

        'lansia_laki_laki',
        'lansia_perempuan',
        'lansia_total',

        'skrining_laki_laki_jumlah',
        'skrining_laki_laki_persen',
        'skrining_perempuan_jumlah',
        'skrining_perempuan_persen',
        'skrining_total_jumlah',
        'skrining_total_persen',
    ];

    protected $casts = [
        'skrining_laki_laki_persen'   => 'float',
        'skrining_perempuan_persen'   => 'float',
        'skrining_total_persen'       => 'float',
    ];
}
