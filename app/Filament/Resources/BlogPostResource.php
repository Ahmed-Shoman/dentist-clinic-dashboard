<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use App\Models\Category;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Card;


class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationLabel(): string
    {
        return __('admin.blog_posts');
    }


    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Card::make() // everything inside one box
                ->schema([
                    TextInput::make('title')
                        ->label('admin.Title')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('author')
                        ->label('admin.Author')
                        ->required()
                        ->maxLength(255),

                    Textarea::make('description')
                        ->label('admin.Description')
                        ->required()
                        ->rows(5),

                    FileUpload::make('image')
                        ->label('admin.Image')
                        ->image()
                        ->required(),

                    BelongsToSelect::make('category_id')
                        ->label('admin.Category')
                        ->relationship('category', 'name')
                        ->required(),

                    DatePicker::make('published_at')
                        ->label('admin.Published At')
                        ->default(now()),
                ])
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('admin.Title')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('author')
                    ->label('admin.Author')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('admin.Category')
                    ->sortable(),

                TextColumn::make('published_at')
                    ->label('admin.Published At')
                    ->date(),

                TextColumn::make('created_at')
                    ->label('admin.Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}