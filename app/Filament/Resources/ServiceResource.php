<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\{TextInput, Textarea, FileUpload, Toggle, Section, Repeater};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function getNavigationLabel(): string
    {
        return __('admin.services');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.home_page');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('admin.service_info'))
                    ->schema([
                        TextInput::make('title')
                            ->label(__('admin.title'))
                            ->required(),
                        Textarea::make('description')
                            ->label(__('admin.description'))
                            ->required(),
                        FileUpload::make('thumbnail')
                            ->label(__('admin.thumbnail'))
                            ->image()
                            ->directory('services'),
                        Toggle::make('is_active')
                            ->label(__('admin.active')),
                        Repeater::make('images')
                            ->label(__('admin.images'))
                            ->schema([
                                FileUpload::make('image')
                                    ->label(__('admin.image'))
                                    ->image()
                                    ->directory('services/images'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('admin.description'))
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label(__('admin.thumbnail'))
                    ->size(50),
                Tables\Columns\TextColumn::make('is_active')
                    ->label(__('admin.active'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.created'))
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\Filter::make('title')
                    ->label(__('admin.filters.title'))
                    ->form([
                        TextInput::make('title')
                            ->label(__('admin.filters.title')),
                    ])
                    ->query(fn ($query, $data) => $query->when($data['title'] ?? null, fn($q) => $q->where('title', 'like', "%{$data['title']}%"))),

                Tables\Filters\Filter::make('description')
                    ->label(__('admin.filters.description'))
                    ->form([
                        TextInput::make('description')
                            ->label(__('admin.filters.description')),
                    ])
                    ->query(fn ($query, $data) => $query->when($data['description'] ?? null, fn($q) => $q->where('description', 'like', "%{$data['description']}%"))),

                Tables\Filters\SelectFilter::make('is_active')
                    ->label(__('admin.filters.active'))
                    ->options([
                        1 => __('admin.active'),
                        0 => __('admin.inactive'),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(__('admin.edit')),
                Tables\Actions\DeleteAction::make()->label(__('admin.delete')),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label(__('admin.delete')),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}