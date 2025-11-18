<?php

namespace App\Filament\Resources\TenagaKesmasKeslingdanGiziResource\Widgets;

use App\Models\TenagaKesmasKeslingdanGizi;
use Filament\Widgets\ChartWidget;

class TenagaKesmasKeslingdanGiziChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Kesmas, Kesling & Gizi per Unit Kerja';

    protected function getData(): array
    {
        $data = TenagaKesmasKeslingdanGizi::orderBy('unit_kerja')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Kesmas',
                    'data'  => $data->pluck('kesmas_total'),
                ],
                [
                    'label' => 'Kesling',
                    'data'  => $data->pluck('kesling_total'),
                ],
                [
                    'label' => 'Gizi',
                    'data'  => $data->pluck('gizi_total'),
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
