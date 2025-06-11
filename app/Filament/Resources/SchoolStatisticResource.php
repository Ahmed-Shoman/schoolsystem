<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolStatisticResource\Pages;
use App\Filament\Resources\SchoolStatisticResource\Pages\CreateSchoolStatistic;
use App\Filament\Resources\SchoolStatisticResource\Pages\EditSchoolStatistic;
use App\Filament\Resources\SchoolStatisticResource\Pages\ListSchoolStatistics;
use App\Filament\Resources\SchoolStatisticResource\RelationManagers;
use App\Models\SchoolStatistic;
use App\Services\StatisticsService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Notifications\Action;
use Filament\Notifications\Notification;


class SchoolStatisticResource extends Resource
{
    protected static ?string $model = SchoolStatistic::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('stage_name')->label('المرحلة'),
            Tables\Columns\TextColumn::make('stage_year')->label('السنة الدراسية'),
            Tables\Columns\TextColumn::make('schools_count')->label('عدد المدارس'),
            Tables\Columns\TextColumn::make('total_students')->label('عدد الطلاب'),
            Tables\Columns\TextColumn::make('total_boys')->label('عدد البنين'),
            Tables\Columns\TextColumn::make('total_girls')->label('عدد البنات'),
            Tables\Columns\TextColumn::make('total_classrooms')->label('عدد الفصول'),
        ])
        ->headerActions([
            Tables\Actions\Action::make('refresh')
                ->label('تحديث الإحصائيات')
                ->action(function () {
                    \App\Services\StatisticsService::generate(); // هنكتبه بعدين
                      Notification::make()
                        ->title('تم تحديث الإحصائيات بنجاح')
                        ->success()
                        ->send();
                })
        ])
        ->actions([])
        ->bulkActions([]);
}


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchoolStatistics::route('/'),
            'create' => Pages\CreateSchoolStatistic::route('/create'),
            'edit' => Pages\EditSchoolStatistic::route('/{record}/edit'),
        ];
    }
}
