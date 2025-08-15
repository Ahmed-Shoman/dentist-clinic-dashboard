<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutUsResource\Pages;
use App\Models\AboutUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutUsResource extends Resource
{
    protected static ?string $model = AboutUs::class;
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.about_us_page');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.AboutUsResource');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin.main_info'))
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label(__('admin.title'))
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->label(__('admin.description'))
                        ->rows(4),
                ]),
            Forms\Components\Section::make(__('admin.additional_info'))
                ->schema([
                    Forms\Components\TextInput::make('sub_title')
                        ->label(__('admin.sub_title')),
                    Forms\Components\Textarea::make('sub_description')
                        ->label(__('admin.sub_description'))
                        ->rows(3),
                ]),
            Forms\Components\Section::make(__('admin.contact_info'))
                ->schema([
                    Forms\Components\TextInput::make('phone_number')
                        ->label(__('admin.phone_number'))
                        ->tel(),
                ]),
            Forms\Components\Section::make(__('admin.doctor_image'))
                ->schema([
                    Forms\Components\FileUpload::make('doctor_image')
                        ->label(__('admin.doctor_image'))
                        ->image()
                        ->directory('about_us')
                        ->imagePreviewHeight('150')
                        ->maxSize(2048),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label(__('admin.title'))->searchable(),
                Tables\Columns\TextColumn::make('phone_number')->label(__('admin.phone_number')),
                Tables\Columns\ImageColumn::make('doctor_image')->label(__('admin.doctor_image'))->size(50),
                Tables\Columns\TextColumn::make('created_at')->label(__('admin.created_at'))->dateTime(),
            ])
            ->filters([
                // فلتر على العنوان
                Tables\Filters\Filter::make('title')
                    ->label(__('admin.title'))
                    ->form([
                        Forms\Components\TextInput::make('title')->label(__('admin.title')),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['title'] ?? null, fn($q, $value) => $q->where('title', 'like', "%{$value}%"));
                    }),

                // فلتر على تاريخ الإنشاء
                Tables\Filters\Filter::make('created_at')
                    ->label(__('admin.created_at'))
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label('From'),
                        Forms\Components\DatePicker::make('created_until')->label('Until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'] ?? null, fn($q, $value) => $q->whereDate('created_at', '>=', $value))
                            ->when($data['created_until'] ?? null, fn($q, $value) => $q->whereDate('created_at', '<=', $value));
                    }),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAboutUs::route('/'),
            'create' => Pages\CreateAboutUs::route('/create'),
            'edit' => Pages\EditAboutUs::route('/{record}/edit'),
        ];
    }
}
