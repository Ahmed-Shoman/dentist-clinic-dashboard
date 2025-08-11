<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DentistFactResource\Pages;
use App\Models\DentistFact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DentistFactResource extends Resource
{
    protected static ?string $model = DentistFact::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
        protected static ?string $navigationGroup = 'About Us Page';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Info')->schema([
                    Forms\Components\TextInput::make('title')->required(),

                    Forms\Components\Repeater::make('facts')
                        ->label('Facts')
                        ->schema([
                            Forms\Components\TextInput::make('subtitle')->required(),
                            Forms\Components\Textarea::make('description')->rows(2)->required(),
                        ])
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('time_table_title'),
                    Forms\Components\Textarea::make('time_table_description')->rows(3),

                    Forms\Components\Repeater::make('schedule')
                        ->label('Schedule')
                        ->schema([
                            Forms\Components\TextInput::make('day')->required(),
                            Forms\Components\TextInput::make('time')->required(),
                        ])
                        ->columnSpanFull(),
                ]),

                Forms\Components\Section::make('Images')->schema([
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->directory('dentist_facts')
                        ->imagePreviewHeight(150),
                    Forms\Components\FileUpload::make('background_image')
                        ->image()
                        ->directory('dentist_facts/backgrounds')
                        ->imagePreviewHeight(150),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\ImageColumn::make('image')->size(50),
                Tables\Columns\ImageColumn::make('background_image')->size(50),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDentistFacts::route('/'),
            'create' => Pages\CreateDentistFact::route('/create'),
            'edit' => Pages\EditDentistFact::route('/{record}/edit'),
        ];
    }
}