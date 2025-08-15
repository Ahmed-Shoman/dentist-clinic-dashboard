<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DentistFactResource\Pages;
use App\Models\DentistFact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class DentistFactResource extends Resource
{
    protected static ?string $model = DentistFact::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    public static function getNavigationGroup(): ?string
    {
        return __('admin.about_us_page');
    }

     public static function getNavigationLabel(): string
    {
        return __('admin.dentist_facts_resource');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('admin.general_info'))->schema([
                    Forms\Components\TextInput::make('title')
                        ->label(__('admin.title'))
                        ->required(),

                    Forms\Components\Repeater::make('facts')
                        ->label(__('admin.facts'))
                        ->schema([
                            Forms\Components\TextInput::make('subtitle')
                                ->label(__('admin.subtitle'))
                                ->required(),
                            Forms\Components\Textarea::make('description')
                                ->label(__('admin.description'))
                                ->rows(2)
                                ->required(),
                        ])
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('time_table_title')
                        ->label(__('admin.time_table_title')),
                    Forms\Components\Textarea::make('time_table_description')
                        ->label(__('admin.time_table_description'))
                        ->rows(3),

                    Forms\Components\Repeater::make('schedule')
                        ->label(__('admin.schedule'))
                        ->schema([
                            Forms\Components\TextInput::make('day')
                                ->label(__('admin.day'))
                                ->required(),
                            Forms\Components\TextInput::make('time')
                                ->label(__('admin.time'))
                                ->required(),
                        ])
                        ->columnSpanFull(),
                ]),

                Forms\Components\Section::make(__('admin.images'))->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label(__('admin.image'))
                        ->image()
                        ->directory('dentist_facts')
                        ->imagePreviewHeight(150),
                    Forms\Components\FileUpload::make('background_image')
                        ->label(__('admin.background_image'))
                        ->image()
                        ->directory('dentist_facts/backgrounds')
                        ->imagePreviewHeight(150),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.title'))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('admin.image'))
                    ->size(50),
                Tables\Columns\ImageColumn::make('background_image')
                    ->label(__('admin.background_image'))
                    ->size(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.created_at'))
                    ->dateTime(),
            ])
            ->actions([
                EditAction::make()->label(__('admin.edit')),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('admin.delete')),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDentistFacts::route('/'),
            'create' => Pages\CreateDentistFact::route('/create'),
            'edit' => Pages\EditDentistFact::route('/{record}/edit'),
        ];
    }
}
