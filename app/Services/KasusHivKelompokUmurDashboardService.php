<?php

namespace App\Services;

use App\Models\KasusHivKelompokUmur;

class KasusHivKelompokUmurDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview Kasus HIV per Kelompok Umur.
     */
    public static function getCards(): array
    {
        $totalKelompok   = KasusHivKelompokUmur::count();

        $totalKasusL     = KasusHivKelompokUmur::sum('kasus_l');
        $totalKasusP     = KasusHivKelompokUmur::sum('kasus_p');
        $totalKasus      = KasusHivKelompokUmur::sum('kasus_total');

        // Indikator kabupaten (biasanya di 1 baris TOTAL, tapi kita sum saja)
        $totalEstimasi   = KasusHivKelompokUmur::sum('estimasi_orang_berisiko');
        $totalDapatPel   = KasusHivKelompokUmur::sum('berisiko_dapat_pelayanan');
        $avgBerisikoPct  = (float) KasusHivKelompokUmur::avg('persen_berisiko_dapat_pelayanan');

        $avgProporsiUmur = (float) KasusHivKelompokUmur::avg('proporsi_kelompok_umur_persen');

        return [
            'total_kelompok_umur'            => $totalKelompok,

            'total_kasus_laki_laki'          => $totalKasusL,
            'total_kasus_perempuan'          => $totalKasusP,
            'total_kasus'                    => $totalKasus,

            'total_estimasi_orang_berisiko'  => $totalEstimasi,
            'total_berisiko_dapat_pelayanan' => $totalDapatPel,
            'rata_persen_berisiko_dapat_pelayanan' => round($avgBerisikoPct, 1),

            'rata_proporsi_kelompok_umur_persen'   => round($avgProporsiUmur, 1),
        ];
    }

    /**
     * Data untuk chart: distribusi kasus & proporsi per kelompok umur.
     */
    public static function getChart(): array
    {
        $rows = KasusHivKelompokUmur::query()
            ->orderBy('tahun')
            ->orderBy('kelompok_umur')
            ->get([
                'kelompok_umur',
                'kasus_total',
                'proporsi_kelompok_umur_persen',
            ]);

        return [
            'labels'     => $rows->pluck('kelompok_umur')->toArray(),
            'kasus_total'=> $rows->pluck('kasus_total')->map(fn ($v) => (int) $v)->toArray(),
            'proporsi_persen' => $rows->pluck('proporsi_kelompok_umur_persen')->map(fn ($v) => (float) $v)->toArray(),
        ];
    }

    /**
     * Gabungan keduanya.
     */
    public static function getAll(): array
    {
        return [
            'cards' => self::getCards(),
            'chart' => self::getChart(),
        ];
    }
}
