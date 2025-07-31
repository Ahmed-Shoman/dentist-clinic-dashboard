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


class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Categories';
    protected static ?string $pluralLabel = 'Categories';
    protected static ?string $modelLabel = 'Category';
    protected static ?string $slug = 'categories'; // URL: /admin/categories

  public static function form(Form $form): Form
{
    return $form->schema([
        Section::make('Image & Details')
            ->schema([
                FileUpload::make('image')
                    ->label('Category Image')
                    ->image()
                    ->directory('categories')
                    ->imagePreviewHeight('150')
                    ->maxSize(1024),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->maxLength(1000),
            ])
            ->columns(1),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')
                ->label('Image')
                ->circular()
                ->height(50),

            TextColumn::make('name')
                ->sortable()
                ->searchable(),

            TextColumn::make('description')
                ->limit(50),
        ])
        ->actions([
            EditAction::make(),
        ])
        ->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
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
