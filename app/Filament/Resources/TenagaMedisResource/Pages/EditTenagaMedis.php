<?php

namespace App\Filament\Resources\TenagaMedisResource\Pages;

use App\Filament\Resources\TenagaMedisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTenagaMedis extends EditRecord
{
    protected static string $resource = TenagaMedisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
