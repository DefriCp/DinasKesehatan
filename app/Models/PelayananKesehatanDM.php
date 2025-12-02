<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelayananKesehatanDM extends Model
{
    use HasFactory;

    protected $table = 'pelayanan_kesehatan_dm';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',
        'jumlah_penderita_dm',
        'pelayanan_jumlah',
        'pelayanan_persen',
        'catatan',
    ];

    protected $casts = [
        'tahun'               => 'integer',
        'jumlah_penderita_dm' => 'integer',
        'pelayanan_jumlah'    => 'integer',
        'pelayanan_persen'    => 'float',
    ];
}
