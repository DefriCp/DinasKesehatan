<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTuberkulosis extends Model
{
    use HasFactory;

    protected $table = 'data_tuberkulosis';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',

        'jumlah_terduga_tb_pelayanan',

        'kasus_tb_laki_laki_jumlah',
        'kasus_tb_laki_laki_persen',
        'kasus_tb_perempuan_jumlah',
        'kasus_tb_perempuan_persen',
        'kasus_tb_total_jumlah',

        'kasus_tb_anak_0_14_jumlah',
    ];

    protected $casts = [
        'kasus_tb_laki_laki_persen'   => 'float',
        'kasus_tb_perempuan_persen'   => 'float',
    ];
}
