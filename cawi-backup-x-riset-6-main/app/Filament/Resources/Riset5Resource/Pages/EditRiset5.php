<?php

namespace App\Filament\Resources\Riset5Resource\Pages;

use App\Filament\Resources\Riset5Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRiset5 extends EditRecord
{
    protected static string $resource = Riset5Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
