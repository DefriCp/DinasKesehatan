<?php

namespace App\Filament\Resources\PenderitaKronisFilariasisResource\Widgets;

use App\Models\PenderitaKronisFilariasis;
use Filament\Widgets\ChartWidget;

class KronisFilariasisChart extends ChartWidget
{
    protected static ?string $heading = 'Kasus Kronis Filariasis per Puskesmas';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = PenderitaKronisFilariasis::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get();

        return [
            'labels' => $rows->map(fn ($row) => $row->kecamatan . ' - ' . $row->puskesmas)->toArray(),
            'datasets' => [
                [
                    'label' => 'Kronis tahun sebelumnya',
                    'data'  => $rows->pluck('sebelumnya_total')->toArray(),
                    'backgroundColor' => '#9ca3af',
                ],
                [
                    'label' => 'Kronis baru',
                    'data'  => $rows->pluck('baru_total')->toArray(),
                    'backgroundColor' => '#22c55e',
                ],
                [
                    'label' => 'Total kronis',
                    'data'  => $rows->pluck('jumlah_total')->toArray(),
                    'backgroundColor' => '#6366f1',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
