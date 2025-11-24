<?php

namespace App\Filament\Resources\PneumoniaBalitaResource\Widgets;

use App\Models\PneumoniaBalita;
use Filament\Widgets\ChartWidget;

class PneumoniaBalitaChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Perkiraan vs Kasus Pneumonia Balita per Puskesmas';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = PneumoniaBalita::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get();

        return [
            'labels' => $rows->map(function ($row) {
                return $row->kecamatan . ' - ' . $row->puskesmas;
            })->toArray(),

            'datasets' => [
                [
                    'label' => 'Perkiraan pneumonia',
                    'data'  => $rows->pluck('perkiraan_pneumonia_balita')->toArray(),
                    'backgroundColor' => '#4f46e5',
                ],
                [
                    'label' => 'Kasus pneumonia ditemukan',
                    'data'  => $rows->pluck('jumlah_pneumonia_total')->toArray(),
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
