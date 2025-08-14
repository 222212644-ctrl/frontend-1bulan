<?php

namespace App\Filament\Resources\RisetUtamaResource\Pages;

use App\Filament\Resources\RisetUtamaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRisetUtama extends EditRecord
{
    protected static string $resource = RisetUtamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
