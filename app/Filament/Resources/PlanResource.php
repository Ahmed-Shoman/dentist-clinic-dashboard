<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function getNavigationLabel(): string
    {
        return __('admin.plans');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.home_page');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('plan_name')
                    ->label(__('admin.plan_name'))
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->label(__('admin.price'))
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('description')
                    ->label(__('admin.description')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('plan_name')
                    ->label(__('admin.plan_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('admin.price'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('admin.description'))
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.created'))
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(__('admin.edit')),
                Tables\Actions\DeleteAction::make()
                    ->label(__('admin.delete')),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->label(__('admin.delete')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
