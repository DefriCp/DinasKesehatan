<?php

namespace App\Filament\Resources\PelayananKesehatanHipertensiResource\Widgets;

use App\Models\PelayananKesehatanHipertensi;
use Filament\Widgets\ChartWidget;

class HipertensiCoverageChart extends ChartWidget
{
    protected static ?string $heading = 'Cakupan Pelayanan Hipertensi per Puskesmas';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = PelayananKesehatanHipertensi::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get();

        return [
            'labels' => $rows
                ->map(fn ($row) => $row->kecamatan . ' - ' . $row->puskesmas)
                ->toArray(),
            'datasets' => [
                [
                    'label' => 'Estimasi penderita (L+P)',
                    'data'  => $rows->pluck('estimasi_total')->toArray(),
                    'backgroundColor' => '#9ca3af', // abu-abu
                ],
                [
                    'label' => 'Dilayani (L+P)',
                    'data'  => $rows->pluck('pelayanan_total_jumlah')->toArray(),
                    'backgroundColor' => '#22c55e', // hijau
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
