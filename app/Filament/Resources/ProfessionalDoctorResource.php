<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalDoctorResource\Pages;
use App\Models\ProfessionalDoctor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class ProfessionalDoctorResource extends Resource
{
    protected static ?string $model = ProfessionalDoctor::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.doctor_clinic_content');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.professional_doctor');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('doctors')
                    ->label(__('admin.doctors'))
                    ->schema([
                        FileUpload::make('image')
                            ->label(__('admin.fields.image'))
                            ->image()
                            ->directory('professional_doctors')
                            ->maxSize(2048),
                        TextInput::make('doctor_name')
                            ->label(__('admin.doctor_name'))
                            ->required(),
                        TextInput::make('position')
                            ->label(__('admin.fields.position'))
                            ->required(),
                        TextInput::make('years_of_experience')
                            ->label(__('admin.fields.years_of_experience'))
                            ->numeric()
                            ->required(),
                    ])
                    ->columns(1)
                    ->createItemButtonLabel(__('admin.actions.add_doctor')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label(__('professional_doctor.fields.id'))->sortable(),
                Tables\Columns\TextColumn::make('doctors')
                    ->label(__('admin.doctors'))
                    ->formatStateUsing(fn($state) => collect($state)->pluck('doctor_name')->join(', ')),
                Tables\Columns\TextColumn::make('created_at')->label(__('professional_doctor.fields.created_at'))->dateTime(),
            ])
            ->filters([
                Filter::make('doctor_name')
                    ->form([
                        TextInput::make('doctor_name')->label(__('admin.doctor_name')),
                    ])
                    ->query(fn($query, $data) => $query->whereJsonContains('doctors->doctor_name', $data['doctor_name'] ?? '')),

                Filter::make('position')
                    ->form([
                        TextInput::make('position')->label(__('admin.fields.position')),
                    ])
                    ->query(fn($query, $data) => $query->whereJsonContains('doctors->position', $data['position'] ?? '')),
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