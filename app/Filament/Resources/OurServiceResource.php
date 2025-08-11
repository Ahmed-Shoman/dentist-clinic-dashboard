<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurServiceResource\Pages;
use App\Models\OurService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OurServiceResource extends Resource
{
    protected static ?string $model = OurService::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Services Page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Main Info')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required(),
                        Forms\Components\TextInput::make('sub_title'),
                    ]),

                Section::make('Services List')
                    ->schema([
                        Forms\Components\Repeater::make('services')
                            ->label('Services')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->directory('our_services')
                                    ->imagePreviewHeight(100)
                                    ->maxSize(2048),

                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('Service Name'),

                                Forms\Components\Textarea::make('description')
                                    ->rows(3),
                            ])
                            ->columns(1)
                            ->createItemButtonLabel('Add Service'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('sub_title')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOurServices::route('/'),
            'create' => Pages\CreateOurService::route('/create'),
            'edit' => Pages\EditOurService::route('/{record}/edit'),
        ];
    }
}
