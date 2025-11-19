<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImunisasiTdIbuHamil extends Model
{
    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'jumlah_ibu_hamil',
        'td1', 'td1_persen',
        'td2', 'td2_persen',
        'td3', 'td3_persen',
        'td4', 'td4_persen',
        'td5', 'td5_persen',
        'td2_plus', 'td2_plus_persen',
    ];
}
