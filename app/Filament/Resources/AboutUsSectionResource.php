<?php

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

    public static function getNavigationGroup(): ?string
    {
        return __('admin.home_page');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.about_us_section');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin.main_image'))
                ->schema([
                    FileUpload::make('image')
                        ->image()
                        ->directory('about-us')
                        ->label(__('admin.main_image')),
                ]),
            Forms\Components\Section::make(__('admin.title_description'))
                ->schema([
                    TextInput::make('title')
                        ->label(__('admin.title'))
                        ->required()
                        ->maxLength(255),
                    Textarea::make('description')
                        ->label(__('admin.description'))
                        ->required(),
                ]),
            Forms\Components\Section::make(__('admin.team_cards'))
                ->schema([
                    Repeater::make('cards')
                        ->label(__('admin.cards'))
                        ->schema([
                            TextInput::make('title')->label(__('admin.title'))->required(),
                            TextInput::make('name')->label(__('admin.name'))->required(),
                            TextInput::make('position')->label(__('admin.position'))->required(),
                        ])
                        ->minItems(1)
                        ->maxItems(10),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('admin.title'))->searchable(),
                TextColumn::make('description')->label(__('admin.description'))->limit(50),
            ])
            ->filters([
                Tables\Filters\Filter::make('title')
                    ->label(__('admin.title'))
                    ->form([
                        TextInput::make('title')->label(__('admin.title')),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['title'] ?? null, fn($q, $value) => $q->where('title', 'like', "%{$value}%"));
                    }),

                Tables\Filters\Filter::make('description')
                    ->label(__('admin.description'))
                    ->form([
                        TextInput::make('description')->label(__('admin.description')),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['description'] ?? null, fn($q, $value) => $q->where('description', 'like', "%{$value}%"));
                    }),
            ])
            ->defaultSort('id', 'desc');
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