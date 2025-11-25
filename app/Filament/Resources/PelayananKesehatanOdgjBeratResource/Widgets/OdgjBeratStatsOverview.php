<?php

namespace App\Filament\Resources\PelayananKesehatanOdgjBeratResource\Widgets;

use App\Models\PelayananKesehatanOdgjBerat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OdgjBeratStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalSasaran   = PelayananKesehatanOdgjBerat::sum('sasaran_odgj_berat');
        $totalDilayani  = PelayananKesehatanOdgjBerat::sum('pelayanan_jumlah');

        $cakupan = $totalSasaran > 0
            ? round($totalDilayani / $totalSasaran * 100, 1)
            : 0;

        $puskesmasBelow95 = PelayananKesehatanOdgjBerat::query()
            ->where('pelayanan_persen', '>', 0)
            ->where('pelayanan_persen', '<', 95)
            ->count();

        return [
            Stat::make('Sasaran ODGJ Berat', number_format($totalSasaran))
                ->description('Total sasaran di semua puskesmas')
                ->icon('heroicon-o-users'),

            Stat::make('ODGJ Berat mendapat pelayanan', number_format($totalDilayani))
                ->description('Cakupan rata-rata: ' . $cakupan . ' %')
                ->icon('heroicon-o-heart'),

            Stat::make('Puskesmas < 95% cakupan', $puskesmasBelow95)
                ->description('Perlu pemantauan lebih lanjut')
                ->color($puskesmasBelow95 > 0 ? 'danger' : 'success')
                ->icon('heroicon-o-exclamation-circle'),
        ];
    }
}
