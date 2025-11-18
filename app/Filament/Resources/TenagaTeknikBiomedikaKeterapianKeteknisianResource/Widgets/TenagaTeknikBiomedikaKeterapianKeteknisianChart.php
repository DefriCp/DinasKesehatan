<?php

namespace App\Filament\Resources\TenagaTeknikBiomedikaKeterapianKeteknisianResource\Widgets;

use App\Models\TenagaTeknikBiomedikaKeterapianKeteknisian;
use Filament\Widgets\ChartWidget;

class TenagaTeknikBiomedikaKeterapianKeteknisianChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Biomedika, Keterapian & Keteknisian per Unit Kerja';

    protected function getData(): array
    {
        $data = TenagaTeknikBiomedikaKeterapianKeteknisian::orderBy('unit_kerja')->get();

        return [
            'datasets' => [
                [
                    'label' => 'ATL',
                    'data' => $data->pluck('atl_total'),
                ],
                [
                    'label' => 'Biomedika',
                    'data' => $data->pluck('biomedika_total'),
                ],
                [
                    'label' => 'Keterapian',
                    'data' => $data->pluck('keterapian_total'),
                ],
                [
                    'label' => 'Keteknisian',
                    'data' => $data->pluck('keteknisian_total'),
                ],
            ],
            'labels' => $data->pluck('unit_kerja')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
