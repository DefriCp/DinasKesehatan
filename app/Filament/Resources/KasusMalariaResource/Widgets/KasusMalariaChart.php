<?php

namespace App\Filament\Resources\KasusMalariaResource\Widgets;

use App\Models\KasusMalaria;
use Filament\Widgets\ChartWidget;

class KasusMalariaChart extends ChartWidget
{
    protected static ?string $heading = 'Suspek, Positif, dan Kematian Malaria per Puskesmas';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = KasusMalaria::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get();

        return [
            'labels' => $rows->map(fn ($row) => $row->kecamatan . ' - ' . $row->puskesmas)->toArray(),
            'datasets' => [
                [
                    'label' => 'Suspek',
                    'data'  => $rows->pluck('suspek')->toArray(),
                    'backgroundColor' => '#93c5fd',
                ],
                [
                    'label' => 'Positif',
                    'data'  => $rows->pluck('positif_total')->toArray(),
                    'backgroundColor' => '#22c55e',
                ],
                [
                    'label' => 'Meninggal',
                    'data'  => $rows->pluck('meninggal_total')->toArray(),
                    'backgroundColor' => '#ef4444',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
