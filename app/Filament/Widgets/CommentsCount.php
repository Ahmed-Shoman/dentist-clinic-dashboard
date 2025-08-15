<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CommentsCount extends BaseWidget
{
    protected int|string|array $columnSpan = 1;

    protected function getCards(): array
    {
        return [
            Card::make('عدد التعليقات', Comment::count()),
        ];
    }
}
