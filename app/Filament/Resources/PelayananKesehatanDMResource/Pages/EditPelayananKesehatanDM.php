<?php

namespace App\Filament\Resources\PelayananKesehatanDMResource\Pages;

use App\Filament\Resources\PelayananKesehatanDMResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPelayananKesehatanDM extends EditRecord
{
    protected static string $resource = PelayananKesehatanDMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
