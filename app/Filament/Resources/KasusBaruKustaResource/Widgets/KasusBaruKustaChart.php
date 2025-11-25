<?php

namespace App\Filament\Resources\KasusBaruKustaResource\Widgets;

use App\Models\KasusBaruKusta;
use Filament\Widgets\ChartWidget;

class KasusBaruKustaChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Kasus Baru Kusta PB vs MB per Puskesmas';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = KasusBaruKusta::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get();

        return [
            'labels' => $rows->map(fn ($row) => $row->kecamatan . ' - ' . $row->puskesmas)->toArray(),

            'datasets' => [
                [
                    'label' => 'Kasus PB (L+P)',
                    'data'  => $rows->pluck('pb_total')->toArray(),
                    'backgroundColor' => '#4f46e5',
                ],
                [
                    'label' => 'Kasus MB (L+P)',
                    'data'  => $rows->pluck('mb_total')->toArray(),
                    'backgroundColor' => '#10b981',
                ],
                [
                    'label' => 'Total PB+MB',
                    'data'  => $rows->pluck('total_kasus')->toArray(),
                    'backgroundColor' => '#f97316',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
