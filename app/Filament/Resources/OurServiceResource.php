<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurServiceResource\Pages;
use App\Models\OurService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;

class OurServiceResource extends Resource
{
    protected static ?string $model = OurService::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.services_page');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.service_page');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('our_service.main_info'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('admin.our_service.fields.title'))
                            ->required(),
                        Forms\Components\TextInput::make('sub_title')
                            ->label(__('our_service.fields.sub_title')),
                    ]),

                Section::make(__('our_service.services_list'))
                    ->schema([
                        Forms\Components\Repeater::make('services')
                            ->label(__('admin.our_service.fields.services'))
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label(__('our_service.fields.image'))
                                    ->image()
                                    ->directory('admin.our_services')
                                    ->imagePreviewHeight(100)
                                    ->maxSize(2048),

                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label(__('admin.our_service.fields.service_name')),

                                Forms\Components\Textarea::make('description')
                                    ->label(__('admin.our_service.fields.description'))
                                    ->rows(3),
                            ])
                            ->columns(1)
                            ->createItemButtonLabel(__('our_service.actions.add_service')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.our_service.fields.title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('sub_title')
                    ->label(__('admin.our_service.fields.sub_title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.our_service.fields.created_at'))
                    ->dateTime(),
            ])
            ->filters([
                Filter::make('title')
                    ->form([
                        TextInput::make('title')->label(__('admin.our_service.fields.title')),
                    ])
                    ->query(fn($query, $data) => $query->when($data['title'] ?? null, fn($q, $value) => $q->where('title', 'like', "%{$value}%"))),

                Filter::make('sub_title')
                    ->form([
                        TextInput::make('sub_title')->label(__('admin.our_service.fields.sub_title')),
                    ])
                    ->query(fn($query, $data) => $query->when($data['sub_title'] ?? null, fn($q, $value) => $q->where('sub_title', 'like', "%{$value}%"))),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOurServices::route('/'),
            'create' => Pages\CreateOurService::route('/create'),
            'edit' => Pages\EditOurService::route('/{record}/edit'),
        ];
    }
}