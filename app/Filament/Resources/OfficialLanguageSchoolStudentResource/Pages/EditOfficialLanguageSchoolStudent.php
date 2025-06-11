<?php

namespace App\Filament\Resources\OfficialLanguageSchoolStudentResource\Pages;

use App\Filament\Resources\OfficialLanguageSchoolStudentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOfficialLanguageSchoolStudent extends EditRecord
{
    protected static string $resource = OfficialLanguageSchoolStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
