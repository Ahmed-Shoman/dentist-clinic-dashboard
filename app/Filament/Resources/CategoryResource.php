<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\Filter;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $slug = 'categories';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.categories');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.categories');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.image_details'))
                ->schema([
                    FileUpload::make('image')
                        ->label(__('admin.category_image'))
                        ->image()
                        ->directory('categories')
                        ->imagePreviewHeight('150')
                        ->maxSize(1024),

                    TextInput::make('name')
                        ->label(__('admin.name'))
                        ->required()
                        ->maxLength(255),

                    Textarea::make('description')
                        ->label(__('admin.description'))
                        ->maxLength(1000),
                ])
                ->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label(__('admin.image'))
                    ->circular()
                    ->height(50),

                TextColumn::make('name')
                    ->label(__('admin.name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('description')
                    ->label(__('admin.description'))
                    ->limit(50),
            ])
            ->filters([
                // فلتر على الاسم
                Filter::make('name')
                    ->label(__('admin.name'))
                    ->form([
                        TextInput::make('name')->label(__('admin.name')),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['name'] ?? null, fn($q, $value) => $q->where('name', 'like', "%{$value}%"));
                    }),

                // فلتر على الوصف
                Filter::make('description')
                    ->label(__('admin.description'))
                    ->form([
                        TextInput::make('description')->label(__('admin.description')),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['description'] ?? null, fn($q, $value) => $q->where('description', 'like', "%{$value}%"));
                    }),
            ])
            ->actions([
                EditAction::make()->label(__('admin.edit')),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('admin.delete')),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
