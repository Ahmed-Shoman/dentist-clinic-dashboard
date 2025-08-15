<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Components\{FileUpload, TextInput, Toggle, Select, Section, Grid};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\{ImageColumn, TextColumn, IconColumn};
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.home_page');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.doctors');
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->columns(1)
            ->schema([
                Section::make(__('admin.doctor_information'))
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('admin.name'))
                                    ->required(),
                                TextInput::make('job')
                                    ->label(__('admin.job'))
                                    ->required(),
                            ]),
                    ])
                    ->columns(1),

                Section::make(__('admin.image_and_service'))
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                FileUpload::make('image')
                                    ->image()
                                    ->label(__('admin.doctor_image'))
                                    ->required()
                                    ->columnSpan(1),

                                Grid::make()
                                    ->schema([
                                        Select::make('service_id')
                                            ->label(__('admin.associated_service'))
                                            ->relationship('service', 'title')
                                            ->searchable()
                                            ->required(),

                                        Toggle::make('is_active')
                                            ->label(__('admin.active'))
                                            ->inline(false),
                                    ])
                                    ->columnSpan(1),
                            ]),
                    ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            ImageColumn::make('image')->label(__('admin.image')),
            TextColumn::make('name')->label(__('admin.name')),
            TextColumn::make('job')->label(__('admin.job')),
            TextColumn::make('service.title')->label(__('admin.service')),
            IconColumn::make('is_active')->label(__('admin.active'))->boolean(),
        ])
        ->filters([
            SelectFilter::make('service')
                ->label(__('admin.service'))
                ->relationship('service', 'title'),

            TernaryFilter::make('is_active')
                ->label(__('admin.active')),

            Tables\Filters\Filter::make('name')
                ->form([
                    TextInput::make('name')->label(__('admin.name')),
                ])
                ->query(fn($query, $data) => $query->when($data['name'] ?? null, fn($q, $value) => $q->where('name', 'like', "%{$value}%"))),

            Tables\Filters\Filter::make('job')
                ->form([
                    TextInput::make('job')->label(__('admin.job')),
                ])
                ->query(fn($query, $data) => $query->when($data['job'] ?? null, fn($q, $value) => $q->where('job', 'like', "%{$value}%"))),
        ])
        ->actions([
            Tables\Actions\ViewAction::make()->label(__('admin.view')),
            Tables\Actions\EditAction::make()->label(__('admin.edit')),
            Tables\Actions\DeleteAction::make()->label(__('admin.delete')),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}