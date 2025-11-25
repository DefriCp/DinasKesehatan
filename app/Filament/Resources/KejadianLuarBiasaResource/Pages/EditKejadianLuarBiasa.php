<?php

namespace App\Filament\Resources\KejadianLuarBiasaResource\Pages;

use App\Filament\Resources\KejadianLuarBiasaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKejadianLuarBiasa extends EditRecord
{
    protected static string $resource = KejadianLuarBiasaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
