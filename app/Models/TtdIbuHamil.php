<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TtdIbuHamil extends Model
{
    protected $table = 'ttd_ibu_hamils';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'jumlah_ibu_hamil',
        'dapat_ttd',
        'dapat_ttd_persen',
        'konsumsi_ttd',
        'konsumsi_ttd_persen',
    ];

    protected $casts = [
        'jumlah_ibu_hamil'     => 'integer',
        'dapat_ttd'            => 'integer',
        'dapat_ttd_persen'     => 'float',
        'konsumsi_ttd'         => 'integer',
        'konsumsi_ttd_persen'  => 'float',
    ];
}
