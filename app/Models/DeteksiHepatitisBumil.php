<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeteksiHepatitisBumil extends Model
{
    use HasFactory;

    protected $table = 'deteksi_hepatitis_bumil';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',

        'jumlah_ibu_hamil',
        'ibu_hamil_diperiksa_reaktif',
        'ibu_hamil_diperiksa_nonreaktif',
        'ibu_hamil_diperiksa_total',
        'persen_bumil_diperiksa',
        'persen_bumil_reaktif',
    ];

    protected $casts = [
        'persen_bumil_diperiksa' => 'float',
        'persen_bumil_reaktif'   => 'float',
    ];
}
