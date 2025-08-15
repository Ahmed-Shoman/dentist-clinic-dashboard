<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionClinicResource\Pages;
use App\Models\ProfessionClinic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ProfessionClinicResource extends Resource
{
    protected static ?string $model = ProfessionClinic::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.profession_clinic');
    }

     public static function getNavigationLabel(): string
    {
        return __('admin.professional_clinic');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\Section::make(__('profession_clinic.clinic_content'))
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label(__('profession_clinic.fields.title'))
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('subtitle')
                                ->label(__('profession_clinic.fields.subtitle'))
                                ->required()
                                ->maxLength(255),

                            Forms\Components\Textarea::make('description')
                                ->label(__('profession_clinic.fields.description'))
                                ->required()
                                ->rows(5),
                        ])
                        ->columnSpan(1),

                    Forms\Components\Section::make(__('profession_clinic.clinic_image'))
                        ->schema([
                            Forms\Components\FileUpload::make('image')
                                ->label(__('profession_clinic.fields.image'))
                                ->image()
                                ->directory('profession-clinic'),
                        ])
                        ->columnSpan(1),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')
                ->label(__('profession_clinic.fields.title'))
                ->searchable()
                ->sortable(),

            TextColumn::make('subtitle')
                ->label(__('profession_clinic.fields.subtitle'))
                ->limit(50),

            TextColumn::make('description')
                ->label(__('profession_clinic.fields.description'))
                ->limit(50),

            ImageColumn::make('image')
                ->label(__('profession_clinic.fields.image'))
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
