<?php

namespace App\Filament\Resources\TenagaFarmasiResource\Widgets;

use App\Models\TenagaFarmasi;
use Filament\Widgets\ChartWidget;

class TenagaFarmasiChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Tenaga Farmasi per Unit Kerja';

    protected function getData(): array
    {
        $rows = TenagaFarmasi::orderBy('unit_kerja')->get();

        return [
            'datasets' => [
                [
                    'label' => 'TTK',
                    'data'  => $rows->pluck('ttk_total'),
                ],
                [
                    'label' => 'Apoteker',
                    'data'  => $rows->pluck('apoteker_total'),
                ],
                [
                    'label' => 'Total Farmasi',
                    'data'  => $rows->pluck('total_total'),
                ],
            ],
            'labels' => $rows->pluck('unit_kerja')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
