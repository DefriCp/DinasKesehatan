<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelayananKesehatanIbu extends Model
{
    protected $table = 'pelayanan_kesehatan_ibu';

    protected $fillable = [
        'kecamatan',
        'puskesmas',

        'ibu_hamil_jumlah',
        'k1_jumlah', 'k1_persen',
        'k4_jumlah', 'k4_persen',
        'k6_jumlah', 'k6_persen',

        'ibu_bersalin_jumlah',
        'persalinan_fasyankes_jumlah', 'persalinan_fasyankes_persen',
        'kf1_jumlah', 'kf1_persen',
        'kf_lengkap_jumlah', 'kf_lengkap_persen',
        'nifas_vita_jumlah', 'nifas_vita_persen',
    ];

    protected $casts = [
        'ibu_hamil_jumlah' => 'integer',
        'k1_jumlah'        => 'integer',
        'k1_persen'        => 'float',
        'k4_jumlah'        => 'integer',
        'k4_persen'        => 'float',
        'k6_jumlah'        => 'integer',
        'k6_persen'        => 'float',

        'ibu_bersalin_jumlah'          => 'integer',
        'persalinan_fasyankes_jumlah'  => 'integer',
        'persalinan_fasyankes_persen'  => 'float',
        'kf1_jumlah'                   => 'integer',
        'kf1_persen'                   => 'float',
        'kf_lengkap_jumlah'            => 'integer',
        'kf_lengkap_persen'            => 'float',
        'nifas_vita_jumlah'            => 'integer',
        'nifas_vita_persen'            => 'float',
    ];
}
