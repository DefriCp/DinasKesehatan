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
}
