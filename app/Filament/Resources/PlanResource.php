<?php

// app/Filament/Resources/PlanResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Home Page';

   public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Section::make('Plan Details')
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        TextInput::make('plan_name')
                            ->label('Plan Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('price')
                            ->label('Price or Cost')
                            ->numeric()
                            ->required(),
                    ]),

                Textarea::make('description')
                    ->label('Description')
                    ->required()
                    ->rows(4),
            ])
            ->columns(1)
            ->collapsible()
            ->collapsed(false),
    ]);
}


    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('plan_name')
                ->searchable()
                ->sortable(),

            TextColumn::make('price')
                ->label('Price')
                ->sortable(),

            TextColumn::make('description')
                ->limit(50),
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
