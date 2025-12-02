<?php

namespace App\Services;

use App\Models\PelayananKesehatanDM;

class PelayananKesehatanDMDashboardService
{
    /**
     * Data untuk kartu-kartu ringkasan DM kabupaten.
     */
    public static function getCards(): array
    {
        $totalPuskesmas      = PelayananKesehatanDM::distinct('puskesmas')->count('puskesmas');
        $totalPenderita      = PelayananKesehatanDM::sum('jumlah_penderita_dm');
        $totalPelayanan      = PelayananKesehatanDM::sum('pelayanan_jumlah');
        $avgPelayananPersen  = (float) PelayananKesehatanDM::avg('pelayanan_persen');

        return [
            'total_puskesmas'          => $totalPuskesmas,
            'total_penderita_dm'       => $totalPenderita,
            'total_pelayanan_dm'       => $totalPelayanan,
            'rata_pelayanan_dm_persen' => round($avgPelayananPersen, 2),
        ];
    }

    /**
     * Data untuk chart: DM per kecamatan.
     */
    public static function getChart(): array
    {
        $rows = PelayananKesehatanDM::query()
            ->selectRaw('
                kecamatan,
                SUM(jumlah_penderita_dm) AS total_penderita,
                SUM(pelayanan_jumlah) AS total_pelayanan,
                AVG(pelayanan_persen) AS avg_pelayanan_persen
            ')
            ->groupBy('kecamatan')
            ->orderBy('kecamatan')
            ->get();

        return [
            'labels'              => $rows->pluck('kecamatan')->toArray(),
            'total_penderita'     => $rows->pluck('total_penderita')->map(fn ($v) => (int) $v)->toArray(),
            'total_pelayanan'     => $rows->pluck('total_pelayanan')->map(fn ($v) => (int) $v)->toArray(),
            'pelayanan_persen'    => $rows->pluck('avg_pelayanan_persen')->map(fn ($v) => (float) $v)->toArray(),
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
