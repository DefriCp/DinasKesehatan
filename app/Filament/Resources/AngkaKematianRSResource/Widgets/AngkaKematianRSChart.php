<?php

namespace App\Filament\Resources\AngkaKematianRSResource\Widgets;

use App\Models\AngkaKematianRS;
use Filament\Widgets\ChartWidget;

class AngkaKematianRSChart extends ChartWidget
{
    protected static ?string $heading = 'GDR & NDR per Rumah Sakit';

    protected function getData(): array
    {
        $data = AngkaKematianRS::query()
            ->orderBy('nama_rs')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'GDR (%)',
                    'data' => $data->pluck('gdr_total')->map(fn ($v) => (float) $v),
                ],
                [
                    'label' => 'NDR (%)',
                    'data' => $data->pluck('ndr_total')->map(fn ($v) => (float) $v),
                ],
            ],
            'labels' => $data->pluck('nama_rs')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // bar chart
    }
}
