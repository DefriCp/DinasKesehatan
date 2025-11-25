<?php

namespace App\Filament\Resources\KasusHivKelompokUmurResource\Widgets;

use App\Models\KasusHivKelompokUmur;
use Filament\Widgets\ChartWidget;

class HivUmurChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Kasus HIV per Kelompok Umur';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = KasusHivKelompokUmur::query()
            ->orderBy('tahun', 'desc')
            ->orderBy('kelompok_umur')
            ->get();

        return [
            'labels' => $rows->pluck('kelompok_umur')->toArray(),

            'datasets' => [
                [
                    'label' => 'Kasus HIV (L+P)',
                    'data'  => $rows->pluck('kasus_total')->toArray(),
                    'backgroundColor' => '#4f46e5',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
