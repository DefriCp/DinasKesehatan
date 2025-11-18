<?php

namespace App\Filament\Resources\TenagaKesmasKeslingdanGiziResource\Pages;

use App\Filament\Resources\TenagaKesmasKeslingdanGiziResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTenagaKesmasKeslingdanGizi extends EditRecord
{
    protected static string $resource = TenagaKesmasKeslingdanGiziResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
