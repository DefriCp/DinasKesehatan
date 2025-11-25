<?php

namespace App\Filament\Resources\TenagaMedisResource\Widgets;

use App\Services\TenagaMedisDashboardService;
use Filament\Widgets\ChartWidget;

class TenagaMedisChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Tenaga Medis per Unit Kerja';

    protected function getData(): array
    {
        $chart = TenagaMedisDashboardService::getChart();

        return [
            'datasets' => [
                [
                    'label' => 'Total Dokter',
                    'data'  => $chart['total_dokter'],
                ],
                [
                    'label' => 'Total Dokter Gigi',
                    'data'  => $chart['total_dokter_gigi'],
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
