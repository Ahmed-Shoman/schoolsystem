<?php

namespace App\Filament\Resources\SchoolPreparationResource\Pages;

use App\Filament\Resources\SchoolPreparationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolPreparation extends EditRecord
{
    protected static string $resource = SchoolPreparationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
