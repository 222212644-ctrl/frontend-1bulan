<?php

namespace App\Filament\Resources\Riset4q1Resource\Pages;

use App\Filament\Resources\Riset4q1Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRiset4q1 extends EditRecord
{
    protected static string $resource = Riset4q1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
