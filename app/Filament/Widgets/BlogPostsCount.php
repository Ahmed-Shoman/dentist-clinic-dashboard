<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class BlogPostsCount extends BaseWidget
{
    protected int|string|array $columnSpan = 1;

    protected function getCards(): array
    {
        return [
            Card::make('عدد المقالات', BlogPost::count()),
        ];
    }
}