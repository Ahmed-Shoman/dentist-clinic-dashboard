<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DentalNewsResource\Pages;
use App\Models\DentalNews;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;


class DentalNewsResource extends Resource
{
    protected static ?string $model = DentalNews::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
        protected static ?string $navigationGroup = 'About Us Page';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Card::make()
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->directory('dental_news')
                        ->imagePreviewHeight(150)
                        ->maxSize(2048),
                ])
                ->columns(1),

            Card::make()
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->rows(4),
                ])
                ->columns(1),

            Card::make()
                ->schema([
                    Forms\Components\TextInput::make('author'),
                    Forms\Components\DatePicker::make('date')
                        ->required(),
                ])
                ->columns(2),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->size(50),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('author')->searchable(),
                Tables\Columns\TextColumn::make('date')->date(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDentalNews::route('/'),
            'create' => Pages\CreateDentalNews::route('/create'),
            'edit' => Pages\EditDentalNews::route('/{record}/edit'),
        ];
    }
}
