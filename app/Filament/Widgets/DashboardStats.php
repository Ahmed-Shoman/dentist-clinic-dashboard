<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\User;
use App\Models\Comment;
use App\Models\BlogPost;
use App\Models\Service;
use App\Models\CertifiedDentist;

class DashboardStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('المستخدمين', User::count()),
            Card::make('التعليقات', Comment::count()),
            Card::make('المدونات', BlogPost::count()),
            Card::make('الخدمات', Service::count()),
            Card::make('أطباء الأسنان المعتمدين', CertifiedDentist::count()),
            Card::make('الأطباء', \App\Models\Doctor::count()),
        ];
    }
}