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

        protected static ?string $navigationGroup = 'Home Page';


    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Section::make('Appointment Details')->schema([
                    Forms\Components\TextInput::make('title')->required()->maxLength(255),
                    Forms\Components\Textarea::make('description')->required()->rows(4),
                ])->columnSpan(1),

                Forms\Components\Section::make('Images')->schema([
                    Forms\Components\FileUpload::make('main_image')->image()->directory('make-appointment'),
                    Forms\Components\FileUpload::make('sub_image')->image()->directory('make-appointment'),
                ])->columnSpan(1),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('description')->limit(50),
            Tables\Columns\ImageColumn::make('main_image'),
            Tables\Columns\ImageColumn::make('sub_image'),
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
