<?php

namespace App\Filament\Resources\PelayananKesehatanHipertensiResource\Pages;

use App\Filament\Resources\PelayananKesehatanHipertensiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPelayananKesehatanHipertensi extends EditRecord
{
    protected static string $resource = PelayananKesehatanHipertensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
