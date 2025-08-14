<?php

namespace App\Filament\Resources\Riset4q2Resource\Pages;

use App\Filament\Resources\Riset4q2Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRiset4q2 extends EditRecord
{
    protected static string $resource = Riset4q2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
