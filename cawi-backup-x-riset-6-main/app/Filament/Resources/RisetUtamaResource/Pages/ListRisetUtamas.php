<?php

namespace App\Filament\Resources\RisetUtamaResource\Pages;

use App\Filament\Resources\RisetUtamaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRisetUtamas extends ListRecords
{
    protected static string $resource = RisetUtamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
