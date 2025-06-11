<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolPreparationResource\Pages;
use App\Models\SchoolPreparation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SchoolPreparationResource extends Resource
{
    protected static ?string $model = SchoolPreparation::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'إعداد المدارس والفصول';
    protected static ?string $pluralModelLabel = 'إعداد المدارس والفصول والتلاميذ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Repeater::make('data')
                    ->label('بيانات المراحل')
                    ->schema([
                        Forms\Components\TextInput::make('stage_name')
                            ->label('المرحلة')
                            ->required(),

                        Forms\Components\Select::make('dependency')
                            ->label('التبعية')
                            ->options([
                                'رسمي لغات' => 'رسمي لغات',
                                'متميزة لغات' => 'متميزة لغات',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('schools_count')
                            ->label('عدد المدارس')
                            ->numeric()
                            ->required(),

                        Forms\Components\TextInput::make('classrooms_count')
                            ->label('عدد الفصول')
                            ->numeric()
                            ->required(),

                        Forms\Components\TextInput::make('boys_count')
                            ->label('عدد التلاميذ بنين')
                            ->numeric()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set, callable $get) =>
                                $set('total_students', ($state ?? 0) + ($get('girls_count') ?? 0))
                            ),

                        Forms\Components\TextInput::make('girls_count')
                            ->label('عدد التلاميذ بنات')
                            ->numeric()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set, callable $get) =>
                                $set('total_students', ($get('boys_count') ?? 0) + ($state ?? 0))
                            ),

                        Forms\Components\TextInput::make('total_students')
                            ->label('جملة التلاميذ')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),
                    ])
                    ->columns(2)
                    ->reorderable()
                    ->collapsible()
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('created_at')->label('تاريخ الإضافة')->dateTime(),
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
            'index' => Pages\ListSchoolPreparations::route('/'),
            'create' => Pages\CreateSchoolPreparation::route('/create'),
            'edit' => Pages\EditSchoolPreparation::route('/{record}/edit'),
        ];
    }
}
