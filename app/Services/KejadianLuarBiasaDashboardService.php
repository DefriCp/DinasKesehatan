<?php

namespace App\Services;

use App\Models\KejadianLuarBiasa;

class KejadianLuarBiasaDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview KLB.
     */
    public static function getCards(): array
    {
        $totalKLB        = KejadianLuarBiasa::count();
        $totalJenisKLB   = KejadianLuarBiasa::distinct('jenis_klb')->count('jenis_klb');

        $totalKec        = KejadianLuarBiasa::sum('jumlah_kec');
        $totalDesaKel    = KejadianLuarBiasa::sum('jumlah_desa_kel');

        $totalPenderitaL = KejadianLuarBiasa::sum('penderita_l');
        $totalPenderitaP = KejadianLuarBiasa::sum('penderita_p');
        $totalPenderita  = KejadianLuarBiasa::sum('penderita_total');

        $totalKematianL  = KejadianLuarBiasa::sum('kematian_l');
        $totalKematianP  = KejadianLuarBiasa::sum('kematian_p');
        $totalKematian   = KejadianLuarBiasa::sum('kematian_total');

        $totalTerancamL  = KejadianLuarBiasa::sum('penduduk_terancam_l');
        $totalTerancamP  = KejadianLuarBiasa::sum('penduduk_terancam_p');
        $totalTerancam   = KejadianLuarBiasa::sum('penduduk_terancam_total');

        $avgAttackRateL     = (float) KejadianLuarBiasa::avg('attack_rate_l_persen');
        $avgAttackRateP     = (float) KejadianLuarBiasa::avg('attack_rate_p_persen');
        $avgAttackRateTotal = (float) KejadianLuarBiasa::avg('attack_rate_total_persen');

        $avgCfrL            = (float) KejadianLuarBiasa::avg('cfr_l_persen');
        $avgCfrP            = (float) KejadianLuarBiasa::avg('cfr_p_persen');
        $avgCfrTotal        = (float) KejadianLuarBiasa::avg('cfr_total_persen');

        // Range waktu KLB (opsional, untuk info saja)
        $awalKLB  = KejadianLuarBiasa::min('tanggal_diketahui');
        $akhirKLB = KejadianLuarBiasa::max('tanggal_akhir');

        return [
            'total_kejadian_klb'        => $totalKLB,
            'total_jenis_klb'           => $totalJenisKLB,

            'total_kecamatan_terdampak' => $totalKec,
            'total_desa_kel_terdampak'  => $totalDesaKel,

            'total_penderita_l'         => $totalPenderitaL,
            'total_penderita_p'         => $totalPenderitaP,
            'total_penderita'           => $totalPenderita,

            'total_kematian_l'          => $totalKematianL,
            'total_kematian_p'          => $totalKematianP,
            'total_kematian'            => $totalKematian,

            'total_penduduk_terancam_l' => $totalTerancamL,
            'total_penduduk_terancam_p' => $totalTerancamP,
            'total_penduduk_terancam'   => $totalTerancam,

            'rata_attack_rate_l_persen'     => round($avgAttackRateL, 2),
            'rata_attack_rate_p_persen'     => round($avgAttackRateP, 2),
            'rata_attack_rate_total_persen' => round($avgAttackRateTotal, 2),

            'rata_cfr_l_persen'             => round($avgCfrL, 2),
            'rata_cfr_p_persen'             => round($avgCfrP, 2),
            'rata_cfr_total_persen'         => round($avgCfrTotal, 2),

            'periode_awal_klb'              => $awalKLB,
            'periode_akhir_klb'             => $akhirKLB,
        ];
    }

    /**
     * Data untuk chart: penderita & kematian per jenis KLB.
     */
    public static function getChart(): array
    {
        // Agregasi per jenis_klb
        $rows = KejadianLuarBiasa::query()
            ->selectRaw('
                jenis_klb,
                SUM(penderita_total) as total_penderita,
                SUM(kematian_total)  as total_kematian,
                AVG(attack_rate_total_persen) as avg_attack_rate_total,
                AVG(cfr_total_persen)         as avg_cfr_total
            ')
            ->groupBy('jenis_klb')
            ->orderBy('jenis_klb')
            ->get();

        return [
            'labels'               => $rows->pluck('jenis_klb')->toArray(),
            'total_penderita'      => $rows->pluck('total_penderita')->map(fn ($v) => (int) $v)->toArray(),
            'total_kematian'       => $rows->pluck('total_kematian')->map(fn ($v) => (int) $v)->toArray(),
            'attack_rate_total'    => $rows->pluck('avg_attack_rate_total')->map(fn ($v) => (float) $v)->toArray(),
            'cfr_total'            => $rows->pluck('avg_cfr_total')->map(fn ($v) => (float) $v)->toArray(),
        ];
    }

    /**
     * Gabungan untuk API.
     */
    public static function getAll(): array
    {
        return [
            'cards' => self::getCards(),
            'chart' => self::getChart(),
        ];
    }
}
