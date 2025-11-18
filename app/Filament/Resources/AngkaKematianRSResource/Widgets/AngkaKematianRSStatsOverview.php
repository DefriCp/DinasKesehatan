<?php

namespace App\Filament\Resources\AngkaKematianRSResource\Widgets;

use App\Models\AngkaKematianRS;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class AngkaKematianRSStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $totalRs = AngkaKematianRS::count();

        $totalPasienKeluar = AngkaKematianRS::sum('pk_total');
        $totalMati = AngkaKematianRS::sum('m_total');
        $totalMati48 = AngkaKematianRS::sum('m48_total');

        $avgGdr = round((float) AngkaKematianRS::avg('gdr_total'), 2);
        $avgNdr = round((float) AngkaKematianRS::avg('ndr_total'), 2);

        return [
            Card::make('Total Rumah Sakit', $totalRs)
                ->description('RS yang melaporkan data'),

            Card::make('Total Pasien Keluar', $totalPasienKeluar)
                ->description('Hidup + Mati'),

            Card::make('Total Pasien Meninggal', $totalMati)
                ->description('Seluruh kematian di RS'),

            Card::make('Total Meninggal ≥ 48 Jam', $totalMati48)
                ->description('Setelah ≥ 48 jam dirawat'),

            Card::make('Rata-rata GDR (%)', $avgGdr)
                ->description('Gross Death Rate'),

            Card::make('Rata-rata NDR (%)', $avgNdr)
                ->description('Net Death Rate'),
        ];
    }
}
