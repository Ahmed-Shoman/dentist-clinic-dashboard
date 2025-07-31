<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionClinicResource\Pages;
use App\Models\ProfessionClinic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ProfessionClinicResource extends Resource
{
    protected static ?string $model = ProfessionClinic::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

        protected static ?string $navigationGroup = 'Home Page';


   public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Grid::make(2)
            ->schema([
                Forms\Components\Section::make('Clinic Content')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('subtitle')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->required()
                            ->rows(5),
                    ])
                    ->columnSpan(1),

                Forms\Components\Section::make('Clinic Image')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('profession-clinic')
                            ->label('Clinic Image'),
                    ])
                    ->columnSpan(1),
            ]),
    ]);
}


    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')
                ->searchable()
                ->sortable(),

            TextColumn::make('subtitle')
                ->limit(50),

            TextColumn::make('description')
                ->limit(50),

            ImageColumn::make('image')
                ->square(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfessionClinics::route('/'),
            'create' => Pages\CreateProfessionClinic::route('/create'),
            'edit' => Pages\EditProfessionClinic::route('/{record}/edit'),
        ];
    }
}