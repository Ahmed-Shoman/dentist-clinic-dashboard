<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Components\{FileUpload, TextInput, Toggle, Select, Section, Grid};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\{ImageColumn, TextColumn, IconColumn};

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->columns(1)
            ->schema([
                Section::make('Doctor Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Name')
                                    ->required(),
                                TextInput::make('job')
                                    ->label('Job')
                                    ->required(),
                            ]),
                    ])
                    ->columns(1),

                Section::make('Image and Service')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                FileUpload::make('image')
                                    ->image()
                                    ->label('Doctor Image')
                                    ->required()
                                    ->columnSpan(1),

                                Grid::make()
                                    ->schema([
                                        Select::make('service_id')
                                            ->label('Associated Service')
                                            ->relationship('service', 'title')
                                            ->searchable()
                                            ->required(),

                                        Toggle::make('is_active')
                                            ->label('Active')
                                            ->inline(false),
                                    ])
                                    ->columnSpan(1),
                            ]),
                    ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            ImageColumn::make('image'),
            TextColumn::make('name'),
            TextColumn::make('job'),
            TextColumn::make('service.title')->label('Service'),
            IconColumn::make('is_active')->boolean(),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}