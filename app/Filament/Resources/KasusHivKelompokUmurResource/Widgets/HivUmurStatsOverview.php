<?php

namespace App\Filament\Resources\KasusHivKelompokUmurResource\Widgets;

use App\Models\KasusHivKelompokUmur;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HivUmurStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalL = KasusHivKelompokUmur::sum('kasus_l');
        $totalP = KasusHivKelompokUmur::sum('kasus_p');
        $total  = KasusHivKelompokUmur::sum('kasus_total');

        $estimasiRisiko = KasusHivKelompokUmur::whereNotNull('estimasi_orang_berisiko')->max('estimasi_orang_berisiko');
        $dapatPelayanan = KasusHivKelompokUmur::whereNotNull('berisiko_dapat_pelayanan')->max('berisiko_dapat_pelayanan');
        $persenPelayanan = KasusHivKelompokUmur::whereNotNull('persen_berisiko_dapat_pelayanan')->max('persen_berisiko_dapat_pelayanan');

        $proporsiL = $total > 0 ? round($totalL / $total * 100, 1) : 0;
        $proporsiP = $total > 0 ? round($totalP / $total * 100, 1) : 0;

        return [
            Stat::make('Total kasus HIV (L+P)', number_format($total))
                ->description('L: ' . number_format($totalL) . ' | P: ' . number_format($totalP))
                ->icon('heroicon-o-beaker'),

            Stat::make('Proporsi jenis kelamin', 'L ' . $proporsiL . '%  |  P ' . $proporsiP . '%')
                ->description('Dihitung dari total kasus')
                ->icon('heroicon-o-chart-pie'),

            Stat::make('Estimasi orang berisiko', $estimasiRisiko ? number_format($estimasiRisiko) : '-')
                ->description('Kab/Kota')
                ->icon('heroicon-o-user-group'),

            Stat::make('Berisiko dapat pelayanan', $dapatPelayanan ? number_format($dapatPelayanan) : '-')
                ->description(
                    $persenPelayanan ? number_format($persenPelayanan, 1) . '% dengan pelayanan deteksi dini' : 'Belum diisi'
                )
                ->icon('heroicon-o-check-badge'),
        ];
    }
}
