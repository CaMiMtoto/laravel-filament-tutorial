<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Layout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('phone')
                    ->required(),
                Forms\Components\TextInput::make('address')->required(),
                Forms\Components\TextInput::make('company')->nullable(),
                Forms\Components\TextInput::make('website')->url()->nullable(),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])->default('active'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable(),
                Tables\Columns\TextColumn::make('email')->sortable(),
                Tables\Columns\TextColumn::make('phone')->sortable(),

                BadgeColumn::make('status')
                    ->enum([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->colors([
                        'danger' => 'inactive',
                        'success' => 'active',
                    ])
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('Active')
                    ->query(fn(Builder $query): Builder => $query->where('status', 'active')),
                Tables\Filters\Filter::make('InActive')
                    ->query(fn(Builder $query): Builder => $query->where('status', 'inactive')),
            ], layout: Layout::Popover,
            )
            ->actions([
                Tables\Actions\EditAction::make(),
//                Tables\Actions\ViewAction::make()
//                    ->recordTitle("Details"),
            ])
            ->bulkActions([
                    Tables\Actions\DeleteBulkAction::make(),
                ]
            )->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
