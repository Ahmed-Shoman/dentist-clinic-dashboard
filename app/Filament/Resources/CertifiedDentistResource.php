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
use Filament\Tables\Filters\Filter;

class CertifiedDentistResource extends Resource
{
    protected static ?string $model = CertifiedDentist::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.home_page');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.certified_dentist');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin.dentist_info'))
                ->description(__('admin.dentist_info_description'))
                ->schema([
                    TextInput::make('name')
                        ->label(__('admin.name'))
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(2),

                    TextInput::make('position')
                        ->label(__('admin.position'))
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(2),

                    TextInput::make('years_of_experience')
                        ->label(__('admin.years_of_experience'))
                        ->numeric()
                        ->required()
                        ->minValue(0)
                        ->columnSpan(1),
                ])
                ->columns(3),

            Forms\Components\Section::make(__('admin.profile_image'))
                ->schema([
                    FileUpload::make('image')
                        ->label(__('admin.image'))
                        ->image()
                        ->directory('certified-dentists')
                        ->required(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label(__('admin.image'))
                    ->square()
                    ->size(50),

                TextColumn::make('name')
                    ->label(__('admin.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('position')
                    ->label(__('admin.position'))
                    ->searchable(),

                TextColumn::make('years_of_experience')
                    ->label(__('admin.years_of_experience'))
                    ->sortable(),
            ])
            ->filters([
                // فلتر الاسم
                Filter::make('name')
                    ->form([
                        TextInput::make('name')->label(__('admin.name')),
                    ])
                    ->query(fn($query, array $data) => $query->when($data['name'] ?? null, fn($q, $value) => $q->where('name', 'like', "%{$value}%"))),

                Filter::make('position')
                    ->form([
                        TextInput::make('position')->label(__('admin.position')),
                    ])
                    ->query(fn($query, array $data) => $query->when($data['position'] ?? null, fn($q, $value) => $q->where('position', 'like', "%{$value}%"))),

                Filter::make('years_of_experience')
                    ->form([
                        TextInput::make('years_of_experience')->label(__('admin.years_of_experience')),
                    ])
                    ->query(fn($query, array $data) => $query->when($data['years_of_experience'] ?? null, fn($q, $value) => $q->where('years_of_experience', $value))),
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
