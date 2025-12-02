<?php

namespace App\Services;

use App\Models\KasusMalaria;

class KasusMalariaDashboardService
{
    /**
     * Data kartu-kartu ringkasan malaria kabupaten.
     */
    public static function getCards(): array
    {
        $totalPuskesmas = KasusMalaria::distinct('puskesmas')->count('puskesmas');

        $totalSuspek        = KasusMalaria::sum('suspek');

        $totalKonfirmasi    = KasusMalaria::sum('konfirmasi_total');
        $totalKonfMikro     = KasusMalaria::sum('konfirmasi_mikroskopis');
        $totalKonfRdt       = KasusMalaria::sum('konfirmasi_rdt');
        $avgKonfirmasiPct   = (float) KasusMalaria::avg('konfirmasi_persen');

        $totalPositifL      = KasusMalaria::sum('positif_l');
        $totalPositifP      = KasusMalaria::sum('positif_p');
        $totalPositif       = KasusMalaria::sum('positif_total');

        $totalObatL         = KasusMalaria::sum('pengobatan_l');
        $totalObatP         = KasusMalaria::sum('pengobatan_p');
        $totalObat          = KasusMalaria::sum('pengobatan_total');
        $avgPengobatanPct   = (float) KasusMalaria::avg('pengobatan_persen');

        $totalMeninggalL    = KasusMalaria::sum('meninggal_l');
        $totalMeninggalP    = KasusMalaria::sum('meninggal_p');
        $totalMeninggal     = KasusMalaria::sum('meninggal_total');

        $avgCfrL            = (float) KasusMalaria::avg('cfr_l_persen');
        $avgCfrP            = (float) KasusMalaria::avg('cfr_p_persen');
        $avgCfrTotal        = (float) KasusMalaria::avg('cfr_total_persen');

        $avgApi             = (float) KasusMalaria::avg('api_per1000');

        return [
            'total_puskesmas'           => $totalPuskesmas,

            'total_suspek'              => $totalSuspek,

            'total_konfirmasi'          => $totalKonfirmasi,
            'total_konfirmasi_mikroskopis' => $totalKonfMikro,
            'total_konfirmasi_rdt'      => $totalKonfRdt,
            'rata_konfirmasi_persen'    => round($avgKonfirmasiPct, 2),

            'total_positif_l'           => $totalPositifL,
            'total_positif_p'           => $totalPositifP,
            'total_positif'             => $totalPositif,

            'total_pengobatan_l'        => $totalObatL,
            'total_pengobatan_p'        => $totalObatP,
            'total_pengobatan'          => $totalObat,
            'rata_pengobatan_persen'    => round($avgPengobatanPct, 2),

            'total_meninggal_l'         => $totalMeninggalL,
            'total_meninggal_p'         => $totalMeninggalP,
            'total_meninggal'           => $totalMeninggal,

            'rata_cfr_l_persen'         => round($avgCfrL, 2),
            'rata_cfr_p_persen'         => round($avgCfrP, 2),
            'rata_cfr_total_persen'     => round($avgCfrTotal, 2),

            'rata_api_per1000'          => round($avgApi, 2),
        ];
    }

    /**
     * Data chart: % konfirmasi & % pengobatan standar per kecamatan.
     */
    public static function getChart(): array
    {
        $rows = KasusMalaria::query()
            ->selectRaw('
                kecamatan,
                SUM(suspek) AS total_suspek,
                SUM(konfirmasi_total) AS total_konfirmasi,
                AVG(konfirmasi_persen) AS avg_konfirmasi_persen,
                AVG(pengobatan_persen) AS avg_pengobatan_persen
            ')
            ->groupBy('kecamatan')
            ->orderBy('kecamatan')
            ->get();

        return [
            'labels'                => $rows->pluck('kecamatan')->toArray(),
            'total_suspek'          => $rows->pluck('total_suspek')->map(fn ($v) => (int) $v)->toArray(),
            'total_konfirmasi'      => $rows->pluck('total_konfirmasi')->map(fn ($v) => (int) $v)->toArray(),
            'konfirmasi_persen'     => $rows->pluck('avg_konfirmasi_persen')->map(fn ($v) => (float) $v)->toArray(),
            'pengobatan_persen'     => $rows->pluck('avg_pengobatan_persen')->map(fn ($v) => (float) $v)->toArray(),
        ];
    }

    public static function getAll(): array
    {
        return [
            'cards' => self::getCards(),
            'chart' => self::getChart(),
        ];
    }
}
