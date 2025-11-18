<?php

namespace App\Filament\Resources\TenagaKeperawatandanTenagaKebidananResource\Pages;

use App\Filament\Resources\TenagaKeperawatandanTenagaKebidananResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTenagaKeperawatandanTenagaKebidanan extends EditRecord
{
    protected static string $resource = TenagaKeperawatandanTenagaKebidananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
