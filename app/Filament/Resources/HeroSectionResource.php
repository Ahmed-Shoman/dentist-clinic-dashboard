<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSectionResource\Pages;
use App\Models\HeroSection;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;

class HeroSectionResource extends Resource
{
    protected static ?string $model = HeroSection::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.home_page');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.hero_section');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\Section::make(__('admin.hero_content'))
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label(__('admin.title'))
                                ->required()
                                ->maxLength(255),
                            Forms\Components\Textarea::make('description')
                                ->label(__('admin.description'))
                                ->required(),
                        ])
                        ->columnSpan(1),

                    Forms\Components\Section::make(__('admin.hero_image'))
                        ->schema([
                            Forms\Components\FileUpload::make('image')
                                ->label(__('admin.hero_image'))
                                ->image()
                                ->directory('hero-section'),
                        ])
                        ->columnSpan(1),
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
                    ->limit(50),
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('admin.image')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.created'))
                    ->dateTime(),
            ])
            ->filters([
                Filter::make('title')
                    ->form([
                        TextInput::make('title')->label(__('admin.title')),
                    ])
                    ->query(fn($query, $data) => $query->when($data['title'] ?? null, fn($q, $value) => $q->where('title', 'like', "%{$value}%"))),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(__('admin.edit')),
                Tables\Actions\DeleteAction::make()->label(__('admin.delete')),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label(__('admin.delete')),
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
