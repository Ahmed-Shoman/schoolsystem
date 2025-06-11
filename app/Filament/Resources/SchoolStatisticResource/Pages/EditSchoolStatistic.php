<?php

namespace App\Filament\Resources\SchoolStatisticResource\Pages;

use App\Filament\Resources\SchoolStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolStatistic extends EditRecord
{
    protected static string $resource = SchoolStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
