<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class UsersCount extends BaseWidget
{
    protected int|string|array $columnSpan = 1;

    protected function getCards(): array
    {
        return [
            Card::make('عدد المستخدمين', User::count()),
        ];
    }
}