<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TtdIbuHamil extends Model
{
    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'jumlah_ibu_hamil',
        'dapat_ttd',
        'dapat_ttd_persen',
        'konsumsi_ttd',
        'konsumsi_ttd_persen',
    ];
}
