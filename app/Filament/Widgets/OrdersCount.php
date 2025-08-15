<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class OrdersCount extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('عدد الطلبات', Order::count())
                ->description('إجمالي الطلبات المسجلة')
                ->descriptionIcon('heroicon-o-shopping-cart')
                ->color('success'),
        ];
    }
}
