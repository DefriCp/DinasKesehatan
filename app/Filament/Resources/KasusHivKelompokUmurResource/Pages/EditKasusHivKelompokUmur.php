<?php

namespace App\Filament\Resources\KasusHivKelompokUmurResource\Pages;

use App\Filament\Resources\KasusHivKelompokUmurResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKasusHivKelompokUmur extends EditRecord
{
    protected static string $resource = KasusHivKelompokUmurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
