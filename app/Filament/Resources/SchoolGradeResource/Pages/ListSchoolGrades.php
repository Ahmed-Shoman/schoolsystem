<?php

namespace App\Filament\Resources\SchoolGradeResource\Pages;

use App\Filament\Resources\SchoolGradeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolGrades extends ListRecords
{
    protected static string $resource = SchoolGradeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
