<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSectionResource\Pages;
use App\Models\HeroSection;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class HeroSectionResource extends Resource
{
    protected static ?string $model = HeroSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Home Page';
    protected static ?string $navigationLabel = 'Hero Section';
    protected static ?string $pluralModelLabel = 'Hero Sections';

  public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Grid::make(2)
            ->schema([
                Forms\Components\Section::make('Hero Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->required(),
                    ])
                    ->columnSpan(1),

                Forms\Components\Section::make('Hero Image')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('hero-section')
                            ->label('Hero Image'),
                    ])
                    ->columnSpan(1),
            ]),
    ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\ImageColumn::make('image')->label('Image'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Created'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroSections::route('/'),
            'create' => Pages\CreateHeroSection::route('/create'),
            'edit' => Pages\EditHeroSection::route('/{record}/edit'),
        ];
    }
}