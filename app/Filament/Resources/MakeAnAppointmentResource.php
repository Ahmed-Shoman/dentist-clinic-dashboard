<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MakeAnAppointmentResource\Pages;
use App\Models\MakeAnAppointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MakeAnAppointmentResource extends Resource
{
    protected static ?string $model = MakeAnAppointment::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    public static function getNavigationGroup(): ?string
    {
        return __('admin.home_page');
    }
     public static function getNavigationLabel(): string
    {
        return __('admin.make_an_appointment');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Section::make(__('admin.appointment_details'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('admin.title'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label(__('admin.description'))
                            ->required()
                            ->rows(4),
                    ])->columnSpan(1),

                Forms\Components\Section::make(__('admin.images'))
                    ->schema([
                        Forms\Components\FileUpload::make('main_image')
                            ->label(__('admin.main_image'))
                            ->image()
                            ->directory('make-appointment'),
                        Forms\Components\FileUpload::make('sub_image')
                            ->label(__('admin.sub_image'))
                            ->image()
                            ->directory('make-appointment'),
                    ])->columnSpan(1),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')
                ->label(__('admin.title'))
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('description')
                ->label(__('admin.description'))
                ->limit(50),
            Tables\Columns\ImageColumn::make('main_image')
                ->label(__('admin.main_image')),
            Tables\Columns\ImageColumn::make('sub_image')
                ->label(__('admin.sub_image')),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMakeAnAppointments::route('/'),
            'create' => Pages\CreateMakeAnAppointment::route('/create'),
            'edit' => Pages\EditMakeAnAppointment::route('/{record}/edit'),
        ];
    }
}