<?php

namespace App\Filament\Resources\PelayananKesehatanUsiaProduktifResource\Pages;

use App\Filament\Resources\PelayananKesehatanUsiaProduktifResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPelayananKesehatanUsiaProduktif extends EditRecord
{
    protected static string $resource = PelayananKesehatanUsiaProduktifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
