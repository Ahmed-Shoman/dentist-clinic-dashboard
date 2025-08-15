<?php

namespace App\Filament\Pages;
use App\Filament\Widgets\BlogPostsCount;

use App\Filament\Widgets\CertifiedDentistsCount;
use App\Filament\Widgets\CommentsCount;
use App\Filament\Widgets\DashboardStats;
use App\Filament\Widgets\OrdersCount;
use App\Filament\Widgets\ServicesCount;
use App\Filament\Widgets\UsersCount;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Page;


class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';
    protected static ?string $title = 'الصفحة الرئيسية';

    protected function getWidgets(): array
    {
        return [
            DashboardStats::class,
        ];
    }

    // protected function getColumns(): int
    // {
    //     return 5;
    // }

    protected function getColumns(): array
    {
        return [
            'default' => 5,
            'sm' => 5,
            'md' => 5,
            'lg' => 5,
            'xl' => 5,
        ];
    }
}
