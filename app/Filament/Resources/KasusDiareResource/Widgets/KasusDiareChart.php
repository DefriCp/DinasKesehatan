<?php

namespace App\Filament\Resources\KasusDiareResource\Widgets;

use App\Models\KasusDiare;
use Filament\Widgets\ChartWidget;

class KasusDiareChart extends ChartWidget
{
    protected static ?string $heading = 'Target vs Kasus Diare Dilayani (Semua Umur) per Puskesmas';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = KasusDiare::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get();

        return [
            'labels' => $rows->map(function ($row) {
                return $row->kecamatan . ' - ' . $row->puskesmas;
            })->toArray(),

            'datasets' => [
                [
                    'label' => 'Target penemuan diare (semua umur)',
                    'data'  => $rows->pluck('target_penemuan_semua_umur')->toArray(),
                    'backgroundColor' => '#4f46e5',
                ],
                [
                    'label' => 'Kasus diare dilayani (semua umur)',
                    'data'  => $rows->pluck('diare_dilayani_semua_jumlah')->toArray(),
                    'backgroundColor' => '#10b981',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
