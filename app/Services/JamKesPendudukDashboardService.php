<?php

namespace App\Services;

use App\Models\JamKesPenduduk;

class JamKesPendudukDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview Jaminan Kesehatan Penduduk.
     */
    public static function getCards(): array
    {
        $totalJenis     = JamKesPenduduk::count();
        $totalPeserta   = JamKesPenduduk::sum('jumlah');
        $avgPersentase  = (float) JamKesPenduduk::avg('persentase');

        $dominan        = JamKesPenduduk::query()
            ->orderByDesc('persentase')
            ->first();

        return [
            'total_jenis_kepesertaan' => $totalJenis,
            'total_peserta'           => $totalPeserta,
            'rata_rata_persentase'    => round($avgPersentase, 2),
            'jenis_dominan'           => $dominan?->jenis_kepesertaan,
            'persentase_dominan'      => $dominan ? round((float) $dominan->persentase, 2) : null,
        ];
    }

    /**
     * Data untuk chart: distribusi jumlah & persentase per jenis kepesertaan.
     */
    public static function getChart(): array
    {
        $rows = JamKesPenduduk::query()
            ->orderBy('jenis_kepesertaan')
            ->get(['jenis_kepesertaan', 'jumlah', 'persentase']);

        return [
            'labels'      => $rows->pluck('jenis_kepesertaan')->toArray(),
            'jumlah'      => $rows->pluck('jumlah')->map(fn ($v) => (int) $v)->toArray(),
            'persentase'  => $rows->pluck('persentase')->map(fn ($v) => (float) $v)->toArray(),
        ];
    }

    /**
     * Gabungan keduanya (praktis untuk API).
     */
    public static function getAll(): array
    {
        return [
            'cards' => self::getCards(),
            'chart' => self::getChart(),
        ];
    }
}
