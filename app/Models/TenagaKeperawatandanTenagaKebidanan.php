<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenagaKeperawatandanTenagaKebidanan extends Model
{
    protected $table = 'tenaga_keperawatandan_tenaga_kebidanan';

    protected $fillable = [
        'unit_kerja',
        'perawat_l',
        'perawat_p',
        'perawat_total',
        'bidan_total',
    ];
}
