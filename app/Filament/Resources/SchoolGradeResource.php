<?php
namespace App\Filament\Resources;

use App\Filament\Resources\SchoolGradeResource\Pages;
use App\Models\SchoolGrade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SchoolGradeResource extends Resource
{
    protected static ?string $model = SchoolGrade::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'الصفوف الدراسية';
    protected static ?string $pluralModelLabel = 'الصفوف الدراسية';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('بيانات الصف')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('school_name')->label('اسم المدرسة')->required(),
                        Forms\Components\Select::make('education_level')
                            ->label('المرحلة التعليمية')
                            ->options([
                                'ماقبل الابتدائي' => 'ماقبل الابتدائي',
                                'الابتدائي' => 'الابتدائي',
                                'الاعدادي' => 'الاعدادي',
                                'الثانوي العام' => 'الثانوي العام',
                            ])
                            ->required(),
                        Forms\Components\Select::make('dependency')
                            ->label('التبعية')
                            ->options([
                                'رسمي لغات' => 'رسمي لغات',
                                'متميز لغات' => 'متميز لغات',
                            ])
                            ->required(),
                            Forms\Components\Repeater::make('grades')
                            ->label('اضافه الصفوف')
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('grade')->label('الصف')->required(),
                                Forms\Components\TextInput::make('classrooms_count')->label('عدد الفصول')->numeric(),
                                Forms\Components\TextInput::make('boys_count')->label('عدد البنين')->numeric(),
                                Forms\Components\TextInput::make('girls_count')->label('عدد البنات')->numeric(),
                                Forms\Components\TextInput::make('total_in_directorate')->label('إجمالي داخل المرحلة بالمديرية')->numeric(),
                            ])
                            ->reorderable()
                            ->collapsible(),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('school_name')->label('اسم المدرسة')->searchable(),
                Tables\Columns\TextColumn::make('education_level')->label('المرحلة التعليمية'),
                Tables\Columns\TextColumn::make('dependency')->label('التبعية'),
                Tables\Columns\TextColumn::make('grade')->label('الصف'),
                Tables\Columns\TextColumn::make('classrooms_count')->label('عدد الفصول'),
                Tables\Columns\TextColumn::make('boys_count')->label('عدد البنين'),
                Tables\Columns\TextColumn::make('girls_count')->label('عدد البنات'),
                Tables\Columns\TextColumn::make('total_in_directorate')->label('الإجمالي'),
            ])
            ->filters([])
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
            'index' => Pages\ListSchoolGrades::route('/'),
            'create' => Pages\CreateSchoolGrade::route('/create'),
            'edit' => Pages\EditSchoolGrade::route('/{record}/edit'),
        ];
    }
}