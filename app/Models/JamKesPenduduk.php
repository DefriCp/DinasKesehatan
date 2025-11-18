<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JamKesPenduduk extends Model
{
    protected $table = 'jam_kes_penduduks';

    protected $fillable = [
        'jenis_kepesertaan',
        'jumlah',
        'persentase',
    ];
}
