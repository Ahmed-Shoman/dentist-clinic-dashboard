<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutUsResource\Pages;
use App\Models\AboutUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutUsResource extends Resource
{
    protected static ?string $model = AboutUs::class;
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationGroup = 'About Us Page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // First box: Title & Description
                Forms\Components\Section::make('Main Info')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->rows(4),
                    ])
                    ->columns(1), // Stacks vertically inside the section

                // Second box: Sub Title & Sub Description
                Forms\Components\Section::make('Additional Info')
                    ->schema([
                        Forms\Components\TextInput::make('sub_title'),
                        Forms\Components\Textarea::make('sub_description')
                            ->rows(3),
                    ])
                    ->columns(1),

                // Third box: Phone number
                Forms\Components\Section::make('Contact Info')
                    ->schema([
                        Forms\Components\TextInput::make('phone_number')
                            ->tel(),
                    ])
                    ->columns(1),

                // Fourth box: Doctor image
                Forms\Components\Section::make('Doctor Image')
                    ->schema([
                        Forms\Components\FileUpload::make('doctor_image')
                            ->image()
                            ->directory('about_us')
                            ->imagePreviewHeight('150')
                            ->maxSize(2048),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('phone_number'),
                Tables\Columns\ImageColumn::make('doctor_image')->size(50),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAboutUs::route('/'),
            'create' => Pages\CreateAboutUs::route('/create'),
            'edit' => Pages\EditAboutUs::route('/{record}/edit'),
        ];
    }
}