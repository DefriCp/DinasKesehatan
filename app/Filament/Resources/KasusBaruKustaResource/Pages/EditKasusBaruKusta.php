<?php

namespace App\Filament\Resources\KasusBaruKustaResource\Pages;

use App\Filament\Resources\KasusBaruKustaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKasusBaruKusta extends EditRecord
{
    protected static string $resource = KasusBaruKustaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
