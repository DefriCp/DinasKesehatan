<?php

namespace App\Filament\Resources\TenagaTeknikBiomedikaKeterapianKeteknisianResource\Pages;

use App\Filament\Resources\TenagaTeknikBiomedikaKeterapianKeteknisianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTenagaTeknikBiomedikaKeterapianKeteknisian extends EditRecord
{
    protected static string $resource = TenagaTeknikBiomedikaKeterapianKeteknisianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
