<?php

namespace App\Filament\Resources\Riset5Resource\Pages;

use App\Filament\Resources\Riset5Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRiset5s extends ListRecords
{
    protected static string $resource = Riset5Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
