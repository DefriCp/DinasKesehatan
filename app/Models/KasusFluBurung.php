<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasusFluBurung extends Model
{
    use HasFactory;

    protected $table = 'kasus_flu_burung';

    protected $fillable = [
        'kecamatan',
        'puskesmas',
        'tahun',
        'kasus_l',
        'kasus_p',
        'kasus_total',
        'kematian_l',
        'kematian_p',
        'kematian_total',
        'catatan',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];

    // CFR (%) kab/kota / per baris (kalau mau ditampilkan)
    public function getCfrAttribute(): ?float
    {
        if ($this->kasus_total <= 0) {
            return null;
        }

        return round(($this->kematian_total / $this->kasus_total) * 100, 1);
    }
}
