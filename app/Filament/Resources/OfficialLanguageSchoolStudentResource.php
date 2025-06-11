<?php
namespace App\Filament\Resources;

use App\Filament\Resources\OfficialLanguageSchoolStudentResource\Pages;
use App\Models\OfficialLanguageSchoolStudent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OfficialLanguageSchoolStudentResource extends Resource
{
    protected static ?string $model = OfficialLanguageSchoolStudent::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'بيانات الطلّاب الرسمية';
    protected static ?string $pluralModelLabel = 'بيانات الطلّاب بالمدارس الرسمية للغات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('school_name')
                    ->label('اسم المدرسة')
                    ->required(),
                Forms\Components\Repeater::make('stage_data')
                    ->label('بيانات المراحل')
                    ->schema([
                        Forms\Components\TextInput::make('stage_name')->label('اسم المرحلة')->required(),
                        Forms\Components\TextInput::make('stage_year')->label('سنة المرحلة')->required(),
                        Forms\Components\TextInput::make('students_count')->label('عدد طلاب المرحلة')->numeric()->required(),
                        Forms\Components\TextInput::make('classrooms_count')->label('عدد الفصول')->numeric()->required(),
                    ])
                    ->columns(2)
                    ->reorderable()
                    ->collapsible()
                    ->grid(2)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('school_name')->label('اسم المدرسة')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('تاريخ الإضافة')->date(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOfficialLanguageSchoolStudents::route('/'),
            'create' => Pages\CreateOfficialLanguageSchoolStudent::route('/create'),
            'edit' => Pages\EditOfficialLanguageSchoolStudent::route('/{record}/edit'),
        ];
    }
}
