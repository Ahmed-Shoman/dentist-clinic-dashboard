<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\{FileUpload, TextInput, Textarea, Toggle, Section, Grid};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\{ImageColumn, TextColumn, IconColumn};
use Filament\Tables\Filters\TrashedFilter;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';

        protected static ?string $navigationGroup = 'Home Page';


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->columns(1)
            ->schema([
                Section::make('Main Image')
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->image()
                            ->label('Thumbnail')
                            ->required(),
                    ]),

                Section::make('Service Details')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required(),
                        Textarea::make('description')
                            ->label('Description')
                            ->nullable(),
                    ]),

                Section::make('Options')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Active')
                                    ->inline(false)
                                    ->columnSpan(1),

                                FileUpload::make('images')
                                    ->image()
                                    ->multiple()
                                    ->directory('services/images')
                                    ->nullable()
                                    ->columnSpan(3),
                            ]),
                    ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            ImageColumn::make('thumbnail'),
            TextColumn::make('title'),
            IconColumn::make('is_active')->boolean(),
        ])
        ->filters([
            TrashedFilter::make(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
