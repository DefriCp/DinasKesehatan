<?php

namespace App\Filament\Resources\AngkaKematianRSResource\Widgets;

use App\Services\AngkaKematianRsDashboardService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class AngkaKematianRSStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $cards = AngkaKematianRsDashboardService::getCards();

        return [
            Card::make('Total Rumah Sakit', $cards['total_rumah_sakit'])
                ->description('RS yang melaporkan data'),

            Card::make('Total Pasien Keluar', $cards['total_pasien_keluar'])
                ->description('Hidup + Mati'),

            Card::make('Total Pasien Meninggal', $cards['total_pasien_meninggal'])
                ->description('Seluruh kematian di RS'),

            Card::make('Total Meninggal ≥ 48 Jam', $cards['total_meninggal_48_jam'])
                ->description('Setelah ≥ 48 jam dirawat'),

            Card::make('Rata-rata GDR (%)', $cards['rata_rata_gdr'])
                ->description('Gross Death Rate'),

            Card::make('Rata-rata NDR (%)', $cards['rata_rata_ndr'])
                ->description('Net Death Rate'),
        ];
    }
}
