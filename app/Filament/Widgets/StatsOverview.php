<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Unique views', '192.1k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->color('success'),
            Card::make('Bounce rate', '21%')
                ->description('7% increase')
                ->descriptionIcon('heroicon-s-trending-down')
                ->color('danger'),
            Card::make('Average time on page', '3:12')
                ->description('3% increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->color('success'),

            Card::make('Customers', Customer::query()->count())
                ->color('success')
                ->icon('heroicon-o-user-group')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),


            Card::make('Assets', Asset::query()->count())

                ->color('primary')
                ->icon('heroicon-o-collection')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Card::make('Unique views', '192.1k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([700, 200, 100, 30, 150, 40, 170])
                ->color('success'),
        ];
    }
}
