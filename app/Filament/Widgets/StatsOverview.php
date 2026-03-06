<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
                Stat::make('Total Orders', Order::count())
                    ->label('Total Orders')
                    ->description('No. of total orders placed'),
                Stat::make('Pending Orders', Order::where('status', 'Pending')->count())
                ->label('Pending Orders')
                ->description('No. of pending orders'),
                Stat::make('Total Revenue', Order::sum('grand_total'))
                ->label('Total Revenue')
                ->description('Total revenue generated from orders'),
        ];
    }
}
