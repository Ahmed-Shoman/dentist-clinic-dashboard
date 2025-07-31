<?php
namespace App\Filament\Resources;

use App\Filament\Resources\CertifiedDentistResource\Pages;
use App\Models\CertifiedDentist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class CertifiedDentistResource extends Resource
{
    protected static ?string $model = CertifiedDentist::class;

        protected static ?string $navigationGroup = 'Home Page';


    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

   public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Section::make('Dentist Info')
            ->description('Basic information about the certified dentist')
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),

                TextInput::make('position')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),

                TextInput::make('years_of_experience')
                    ->label('Years of Experience')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->columnSpan(1),
            ])
            ->columns(3),

        Forms\Components\Section::make('Profile Image')
            ->schema([
                FileUpload::make('image')
                    ->image()
                    ->directory('certified-dentists')
                    ->required(),
            ]),
    ]);
}


    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')
                ->label('Image')
                ->square()
                ->size(50),

            TextColumn::make('name')
                ->searchable()
                ->sortable(),

            TextColumn::make('position')
                ->searchable(),

            TextColumn::make('years_of_experience')
                ->label('Years of Experience')
                ->sortable(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCertifiedDentists::route('/'),
            'create' => Pages\CreateCertifiedDentist::route('/create'),
            'edit' => Pages\EditCertifiedDentist::route('/{record}/edit'),
        ];
    }
}
