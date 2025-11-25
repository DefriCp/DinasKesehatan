<?php

namespace App\Filament\Resources\KejadianLuarBiasaResource\Widgets;

use App\Models\KejadianLuarBiasa;
use Filament\Widgets\ChartWidget;

class KlbPerJenisChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Penderita KLB per Jenis Kejadian';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = KejadianLuarBiasa::query()
            ->selectRaw('jenis_klb, SUM(penderita_total) as total_penderita')
            ->groupBy('jenis_klb')
            ->orderBy('jenis_klb')
            ->get();

        return [
            'labels' => $rows->pluck('jenis_klb')->toArray(),
            'datasets' => [
                [
                    'label' => 'Total penderita',
                    'data'  => $rows->pluck('total_penderita')->toArray(),
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
