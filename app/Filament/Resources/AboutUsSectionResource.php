<?php

// app/Filament/Resources/AboutUsSectionResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutUsSectionResource\Pages;
use App\Models\AboutUsSection;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;

class AboutUsSectionResource extends Resource
{
    protected static ?string $model = AboutUsSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationGroup = 'Home Page';

  public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Section::make('Main Image')
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('about-us')
                    ->label('Main Image'),
            ]),

        Forms\Components\Section::make('Title & Description')
            ->schema([
                Forms\Components\TextInput::make('title')->required()->maxLength(255),
                Forms\Components\Textarea::make('description')->required(),
            ]),

        Forms\Components\Section::make('Team Cards')
            ->schema([
                Forms\Components\Repeater::make('cards')
                    ->label('Cards')
                    ->schema([
                        Forms\Components\TextInput::make('title')->label('Title')->required(),
                        Forms\Components\TextInput::make('name')->label('Name')->required(),
                        Forms\Components\TextInput::make('position')->label('Position')->required(),
                    ])
                    ->minItems(1)
                    ->maxItems(10),
            ]),
    ]);
}



    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable(),
            TextColumn::make('description')->limit(50),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAboutUsSections::route('/'),
            'create' => Pages\CreateAboutUsSection::route('/create'),
            'edit' => Pages\EditAboutUsSection::route('/{record}/edit'),
        ];
    }
}
