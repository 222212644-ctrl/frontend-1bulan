<?php

namespace App\Filament\Resources\Riset4q2Resource\Pages;

use App\Filament\Resources\Riset4q2Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRiset4q2s extends ListRecords
{
    protected static string $resource = Riset4q2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
