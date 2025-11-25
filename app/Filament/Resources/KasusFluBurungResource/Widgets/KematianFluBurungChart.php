<?php

namespace App\Filament\Resources\KasusFluBurungResource\Widgets;

use App\Models\KasusFluBurung;
use Filament\Widgets\ChartWidget;

class KematianFluBurungChart extends ChartWidget
{
    protected static ?string $heading = 'Chart Kematian Flu Burung per Puskesmas';
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = KasusFluBurung::orderBy('puskesmas')
            ->get()
            ->groupBy('puskesmas');

        $labels = [];
        $kematianTotal = [];

        foreach ($data as $puskesmas => $rows) {
            $labels[] = $puskesmas;
            $kematianTotal[] = $rows->sum('kematian_total');
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Kematian',
                    'data' => $kematianTotal,
                    'backgroundColor' => '#f87171',
                    'borderColor' => '#dc2626',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
