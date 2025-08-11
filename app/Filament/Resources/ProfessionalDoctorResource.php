<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalDoctorResource\Pages;
use App\Models\ProfessionalDoctor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class ProfessionalDoctorResource extends Resource
{
    protected static ?string $model = ProfessionalDoctor::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Clinic Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('doctors')
                    ->label('Doctors')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('professional_doctors')
                            ->maxSize(2048),
                        TextInput::make('doctor_name')
                            ->required()
                            ->label('Doctor Name'),
                        TextInput::make('position')
                            ->required(),
                        TextInput::make('years_of_experience')
                            ->numeric()
                            ->label('Years of Experience')
                            ->required(),
                    ])
                    ->columns(1)
                    ->createItemButtonLabel('Add Doctor'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfessionalDoctors::route('/'),
            'create' => Pages\CreateProfessionalDoctor::route('/create'),
            'edit' => Pages\EditProfessionalDoctor::route('/{record}/edit'),
        ];
    }
}
