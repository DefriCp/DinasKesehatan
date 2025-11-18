<?php

namespace App\Filament\Resources\TenagaFarmasiResource\Pages;

use App\Filament\Resources\TenagaFarmasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTenagaFarmasi extends EditRecord
{
    protected static string $resource = TenagaFarmasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
