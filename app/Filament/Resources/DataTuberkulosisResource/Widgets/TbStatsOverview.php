<?php

namespace App\Filament\Resources\DataTuberkulosisResource\Widgets;

use App\Models\DataTuberkulosis;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TbStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalTerdugaDilayani = DataTuberkulosis::sum('jumlah_terduga_tb_pelayanan');
        $totalKasusTb         = DataTuberkulosis::sum('kasus_tb_total_jumlah');
        $totalKasusAnak       = DataTuberkulosis::sum('kasus_tb_anak_0_14_jumlah');

        $proporsiAnak = $totalKasusTb > 0
            ? round($totalKasusAnak / $totalKasusTb * 100, 1)
            : 0;

        return [
            Stat::make('Terduga TB dilayani', number_format($totalTerdugaDilayani))
                ->description('Mendapat pelayanan sesuai standar'),

            Stat::make('Total kasus TB', number_format($totalKasusTb))
                ->description('Semua kasus TB (L + P)'),

            Stat::make('Kasus TB anak', number_format($totalKasusAnak))
                ->description($proporsiAnak . '% dari seluruh kasus'),
        ];
    }
}
