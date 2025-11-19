<?php

namespace App\Filament\Resources\ImunisasiTdIbuHamilResource\Pages;

use App\Filament\Resources\ImunisasiTdIbuHamilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImunisasiTdIbuHamil extends EditRecord
{
    protected static string $resource = ImunisasiTdIbuHamilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
