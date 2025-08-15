<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left';

    public static function getNavigationLabel(): string
    {
        return __('admin.comments');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.home_page');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('admin.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label(__('admin.email'))
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('message')
                    ->label(__('admin.message'))
                    ->required()
                    ->rows(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('admin.name'))->searchable(),
                Tables\Columns\TextColumn::make('email')->label(__('admin.email'))->searchable(),
                Tables\Columns\TextColumn::make('message')->label(__('admin.message'))->limit(50),
                Tables\Columns\TextColumn::make('created_at')->label(__('admin.created_at'))->dateTime(),
            ])
            ->filters([
                Filter::make('name')
                    ->form([
                        Forms\Components\TextInput::make('name')->label(__('admin.name')),
                    ])
                    ->query(fn($query, array $data) => $query->when($data['name'] ?? null, fn($q, $value) => $q->where('name', 'like', "%{$value}%"))),

                Filter::make('email')
                    ->form([
                        Forms\Components\TextInput::make('email')->label(__('admin.email')),
                    ])
                    ->query(fn($query, array $data) => $query->when($data['email'] ?? null, fn($q, $value) => $q->where('email', 'like', "%{$value}%"))),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(__('admin.edit')),
                Tables\Actions\DeleteAction::make()->label(__('admin.delete')),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label(__('admin.delete')),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}