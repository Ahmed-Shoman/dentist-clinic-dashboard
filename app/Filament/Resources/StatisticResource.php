<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatisticResource\Pages;
use App\Models\Statistic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StatisticResource extends Resource
{
    protected static ?string $model = Statistic::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.about_us_page');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.statistics');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->label(__('admin.fields_number'))
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->label(__('admin.fields_name'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->label(__('admin.fields_number')),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.fields_name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.fields_created_at'))
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\Filter::make('number')
                    ->label(__('admin.filters.number'))
                    ->form([
                        Forms\Components\TextInput::make('number')
                            ->label(__('admin.filters.number'))
                            ->numeric(),
                    ])
                    ->query(fn($query, $data) => $query->when($data['number'] ?? null, fn($q) => $q->where('number', $data['number']))),

                Tables\Filters\Filter::make('name')
                    ->label(__('admin.filters.name'))
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label(__('admin.filters.name')),
                    ])
                    ->query(fn($query, $data) => $query->when($data['name'] ?? null, fn($q) => $q->where('name', 'like', "%{$data['name']}%"))),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStatistics::route('/'),
            'create' => Pages\CreateStatistic::route('/create'),
            'edit' => Pages\EditStatistic::route('/{record}/edit'),
        ];
    }
}