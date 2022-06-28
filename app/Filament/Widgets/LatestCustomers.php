<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestCustomers extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Customer::query()->latest()->limit(4);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->label('Name'),
            Tables\Columns\TextColumn::make('email')->label('Email'),
            Tables\Columns\TextColumn::make('phone')->label('Phone'),
        ];
    }
}
