<?php

namespace App\Filament\Resources\KasusFluBurungResource\Widgets;

use App\Models\KasusFluBurung;
use Filament\Widgets\ChartWidget;

class KasusFluBurungChart extends ChartWidget
{
    protected static ?string $heading = 'Chart Kasus Flu Burung per Puskesmas';
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = KasusFluBurung::orderBy('puskesmas')
            ->get()
            ->groupBy('puskesmas');

        $labels = [];
        $kasusTotal = [];

        foreach ($data as $puskesmas => $rows) {
            $labels[] = $puskesmas;
            $kasusTotal[] = $rows->sum('kasus_total');
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Total Kasus',
                    'data' => $kasusTotal,
                    'backgroundColor' => '#60a5fa',
                    'borderColor' => '#2563eb',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
