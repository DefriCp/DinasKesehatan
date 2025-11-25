<?php

namespace App\Filament\Resources\DeteksiHepatitisBumilResource\Widgets;

use App\Models\DeteksiHepatitisBumil;
use Filament\Widgets\ChartWidget;

class DeteksiHepatitisBumilChart extends ChartWidget
{
    protected static ?string $heading = 'Persentase Bumil Diperiksa Hepatitis B per Puskesmas';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = DeteksiHepatitisBumil::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get();

        return [
            'labels' => $rows->map(function ($row) {
                return $row->kecamatan . ' - ' . $row->puskesmas;
            })->toArray(),

            'datasets' => [
                [
                    'label' => '% bumil diperiksa',
                    'data'  => $rows->map(function ($row) {
                        if ($row->jumlah_ibu_hamil > 0) {
                            return round($row->ibu_hamil_diperiksa_total / $row->jumlah_ibu_hamil * 100, 1);
                        }
                        return 0;
                    })->toArray(),
                    'backgroundColor' => '#4f46e5',
                ],
                [
                    'label' => '% bumil reaktif (dari diperiksa)',
                    'data'  => $rows->map(function ($row) {
                        if ($row->ibu_hamil_diperiksa_total > 0) {
                            return round($row->ibu_hamil_diperiksa_reaktif / $row->ibu_hamil_diperiksa_total * 100, 1);
                        }
                        return 0;
                    })->toArray(),
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
