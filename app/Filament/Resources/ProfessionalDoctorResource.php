<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalDoctorResource\Pages;
use App\Models\ProfessionalDoctor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ProfessionalDoctorResource extends Resource
{
    protected static ?string $model = ProfessionalDoctor::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.doctor_clinic_content');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.professional_doctor');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('doctors')
                    ->label(__('admin.doctors'))
                    ->schema([
                        FileUpload::make('image')
                            ->label(__('admin.fields.image'))
                            ->image()
                            ->directory('professional_doctors')
                            ->maxSize(2048),

                        TextInput::make('doctor_name')
                            ->label(__('admin.doctor_name'))
                            ->required(),

                        TextInput::make('position')
                            ->label(__('admin.fields.position'))
                            ->required(),

                        TextInput::make('years_of_experience')
                            ->label(__('admin.fields.years_of_experience'))
                            ->numeric()
                            ->required(),
                    ])
                    ->columns(1)
                    ->createItemButtonLabel(__('admin.actions.add_doctor'))
                    // custom remove action
                    ->disableItemDeletion() // منع delete الافتراضي
                    ->afterStateUpdated(function ($state, $set) {
                        // هنا ممكن تعمل حذف عنصر معين من الـ array يدوياً
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('doctors')
                    ->label(__('admin.doctors'))
                    ->formatStateUsing(fn($state) => collect($state)->pluck('doctor_name')->join(', ')),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfessionalDoctors::route('/'),
            'create' => Pages\CreateProfessionalDoctor::route('/create'),
            'edit' => Pages\EditProfessionalDoctor::route('/{record}/edit'),
        ];
    }
}