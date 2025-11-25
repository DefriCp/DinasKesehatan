<?php

namespace App\Filament\Resources\PelayananKesehatanOdgjBeratResource\Pages;

use App\Filament\Resources\PelayananKesehatanOdgjBeratResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPelayananKesehatanOdgjBerat extends EditRecord
{
    protected static string $resource = PelayananKesehatanOdgjBeratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
