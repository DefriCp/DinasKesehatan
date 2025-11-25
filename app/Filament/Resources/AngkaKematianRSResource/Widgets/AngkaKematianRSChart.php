<?php

namespace App\Filament\Resources\AngkaKematianRSResource\Widgets;

use App\Services\AngkaKematianRsDashboardService;
use Filament\Widgets\ChartWidget;

class AngkaKematianRSChart extends ChartWidget
{
    protected static ?string $heading = 'GDR & NDR per Rumah Sakit';

    protected function getData(): array
    {
        $chart = AngkaKematianRsDashboardService::getChart();

        return [
            'datasets' => [
                [
                    'label' => 'GDR (%)',
                    'data'  => $chart['gdr'],
                ],
                [
                    'label' => 'NDR (%)',
                    'data'  => $chart['ndr'],
                ],
            ],
            'labels' => $chart['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
