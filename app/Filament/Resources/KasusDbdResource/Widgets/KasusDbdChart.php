<?php

namespace App\Filament\Resources\KasusDbdResource\Widgets;

use App\Models\KasusDbd;
use Filament\Widgets\ChartWidget;

class KasusDbdChart extends ChartWidget
{
    protected static ?string $heading = 'Kasus DBD & Kematian per Puskesmas';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = KasusDbd::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get();

        return [
            'labels' => $rows->map(function ($row) {
                return $row->kecamatan . ' - ' . $row->puskesmas;
            })->toArray(),

            'datasets' => [
                [
                    'label' => 'Kasus DBD (L+P)',
                    'data'  => $rows->pluck('kasus_total')->toArray(),
                    'backgroundColor' => '#4f46e5',
                ],
                [
                    'label' => 'Meninggal (L+P)',
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
