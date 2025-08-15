<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DentalNewsResource\Pages;
use App\Models\DentalNews;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;

class DentalNewsResource extends Resource
{
    protected static ?string $model = DentalNews::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.about_us_page');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.dental_news');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Forms\Components\FileUpload::make('image')
                    ->label(__('admin.image'))
                    ->image()
                    ->directory('dental_news')
                    ->imagePreviewHeight(150)
                    ->maxSize(2048),
            ])->columns(1),

            Card::make()->schema([
                TextInput::make('title')
                    ->label(__('admin.title'))
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label(__('admin.description'))
                    ->rows(4),
            ])->columns(1),

            Card::make()->schema([
                TextInput::make('author')
                    ->label(__('admin.author')),
                DatePicker::make('date')
                    ->label(__('admin.date'))
                    ->required(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('admin.image'))
                    ->size(50),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.title'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('author')
                    ->label(__('admin.author'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->label(__('admin.date'))
                    ->date(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.created_at'))
                    ->dateTime(),
            ])
            ->filters([
                Filter::make('title')
                    ->form([
                        TextInput::make('title')->label(__('admin.title')),
                    ])
                    ->query(fn($query, array $data) => $query->when($data['title'] ?? null, fn($q, $value) => $q->where('title', 'like', "%{$value}%"))),

                Filter::make('author')
                    ->form([
                        TextInput::make('author')->label(__('admin.author')),
                    ])
                    ->query(fn($query, array $data) => $query->when($data['author'] ?? null, fn($q, $value) => $q->where('author', 'like', "%{$value}%"))),

                Filter::make('date')
                    ->form([
                        DatePicker::make('date')->label(__('admin.date')),
                    ])
                    ->query(fn($query, array $data) => $query->when($data['date'] ?? null, fn($q, $value) => $q->whereDate('date', $value))),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDentalNews::route('/'),
            'create' => Pages\CreateDentalNews::route('/create'),
            'edit' => Pages\EditDentalNews::route('/{record}/edit'),
        ];
    }
}