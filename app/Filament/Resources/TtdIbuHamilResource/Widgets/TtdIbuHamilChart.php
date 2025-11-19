<?php

namespace App\Filament\Resources\TtdIbuHamilResource\Widgets;

use App\Models\TtdIbuHamil;
use Filament\Widgets\ChartWidget;

class TtdIbuHamilChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Konsumsi TTD per Kecamatan';

    protected function getData(): array
    {
        $rows = TtdIbuHamil::orderBy('kecamatan')->get();

        return [
            'labels' => $rows->pluck('kecamatan'),
            'datasets' => [
                [
                    'label' => 'Konsumsi TTD (%)',
                    'data'  => $rows->pluck('konsumsi_ttd_persen'),
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
