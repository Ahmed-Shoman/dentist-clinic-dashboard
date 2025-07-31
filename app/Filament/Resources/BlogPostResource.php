<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;



class BlogPostResource extends Resource
{
    use Translatable;

    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';


  public static function form(Form $form): Form
    {

        return $form->schema([
            Forms\Components\Section::make('Basic Info')
                ->schema([
                    TextInput::make('author')
                        ->label('Author Name')
                        // ->translatable()
                        ->required()
                        ->maxLength(255),

                    TextInput::make('title')
                        ->label('Title')
                        // ->translatable()
                        ->required()
                        ->maxLength(255),

                    Textarea::make('description')
                        ->label('Description')
                        // ->translatable()
                        ->required(),
                    // باقي الحقول...
                ]),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')
                ->label('Image')
                ->height(50)
                ->width(50),

            TextColumn::make('title')
                ->label('Title')
                ->sortable()
                ->searchable(),

            TextColumn::make('author')
                ->label('Author'),

            TextColumn::make('category.name')
                ->label('Category'),

            TextColumn::make('published_at')
                ->label('Published')
                ->dateTime()
                ->sortable(),
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
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
