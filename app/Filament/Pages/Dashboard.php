<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'الصفحة الرئيسية';

    // لو عايز Widgets:
    public function getWidgets(): array
    {
        return [
            // App\Filament\Widgets\YourWidget::class,
        ];
    }
}
