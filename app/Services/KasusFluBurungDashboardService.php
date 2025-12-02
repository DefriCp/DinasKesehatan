<?php

namespace App\Services;

use App\Models\KasusFluBurung;

class KasusFluBurungDashboardService
{
    /**
     * Data ringkasan untuk kartu-kartu indikator flu burung.
     */
    public static function getCards(): array
    {
        $totalKasusL     = KasusFluBurung::sum('kasus_l');
        $totalKasusP     = KasusFluBurung::sum('kasus_p');
        $totalKasus      = KasusFluBurung::sum('kasus_total');

        $totalKematianL  = KasusFluBurung::sum('kematian_l');
        $totalKematianP  = KasusFluBurung::sum('kematian_p');
        $totalKematian   = KasusFluBurung::sum('kematian_total');

        // CFR kabupaten: (total kematian / total kasus) * 100
        $cfrKab = null;
        if ($totalKasus > 0) {
            $cfrKab = round(($totalKematian / $totalKasus) * 100, 2);
        }

        $totalKecamatan = KasusFluBurung::distinct('kecamatan')->count('kecamatan');
        $totalPuskesmas = KasusFluBurung::distinct('puskesmas')->count('puskesmas');

        return [
            'total_kecamatan'     => $totalKecamatan,
            'total_puskesmas'     => $totalPuskesmas,

            'total_kasus_l'       => $totalKasusL,
            'total_kasus_p'       => $totalKasusP,
            'total_kasus'         => $totalKasus,

            'total_kematian_l'    => $totalKematianL,
            'total_kematian_p'    => $totalKematianP,
            'total_kematian'      => $totalKematian,

            'cfr_kabupaten_persen'=> $cfrKab,
        ];
    }

    /**
     * Data untuk chart: kasus, kematian, CFR per kecamatan.
     */
    public static function getChart(): array
    {
        $rows = KasusFluBurung::query()
            ->selectRaw('
                kecamatan,
                SUM(kasus_total) as total_kasus,
                SUM(kematian_total) as total_kematian
            ')
            ->groupBy('kecamatan')
            ->orderBy('kecamatan')
            ->get();

        $labels          = [];
        $kasusPerKec     = [];
        $kematianPerKec  = [];
        $cfrPerKec       = [];

        foreach ($rows as $row) {
            $labels[]         = $row->kecamatan;
            $kasusPerKec[]    = (int) $row->total_kasus;
            $kematianPerKec[] = (int) $row->total_kematian;

            if ($row->total_kasus > 0) {
                $cfrPerKec[] = round(($row->total_kematian / $row->total_kasus) * 100, 2);
            } else {
                $cfrPerKec[] = null;
            }
        }

        return [
            'labels'          => $labels,
            'kasus_total'     => $kasusPerKec,
            'kematian_total'  => $kematianPerKec,
            'cfr_persen'      => $cfrPerKec,
        ];
    }

    /**
     * Gabungan data untuk API.
     */
    public static function getAll(): array
    {
        return [
            'cards' => self::getCards(),
            'chart' => self::getChart(),
        ];
    }
}
