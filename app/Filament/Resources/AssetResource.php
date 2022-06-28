<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Filament\Resources\AssetResource\RelationManagers;
use App\Models\Asset;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Settings';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\MarkdownEditor::make('description')
                    ->required()
                    ->columnSpan(2),
                Forms\Components\FileUpload::make("image")
                    ->image()->maxSize(1024),

                Forms\Components\TextInput::make('min_reservation')
                    ->numeric()
                    ->required()
                    ->label('Minimum reservation length'),
                Forms\Components\Select::make('min_reservation_unit')
                    ->options([
                        'Hour' => 'Hours',
                        'Day' => 'Days',
                        'Week' => 'Weeks',
                        'Month' => 'Months',
                    ])->default('Hour'),

                Forms\Components\TextInput::make('max_reservation')
                    ->numeric()
                    ->required()
                    ->label('Maximum reservation length'),
                Forms\Components\Select::make('max_reservation_unit')
                    ->options([
                        'Hour' => 'Hours',
                        'Day' => 'Days',
                        'Week' => 'Weeks',
                        'Month' => 'Months',
                    ])->default('Hour'),

                Forms\Components\TextInput::make('cancellation_time')
                    ->numeric()
                    ->required()
                    ->label('Users can cancel in '),
                Forms\Components\Select::make('cancellation_time_unit')
                    ->options([
                        'Hour' => 'Hours',
                        'Day' => 'Days',
                        'Week' => 'Weeks',
                        'Month' => 'Months',
                    ])->default('Hour'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->rounded(),
                Tables\Columns\TextColumn::make('name')->sortable(),
                Tables\Columns\TextColumn::make('min_reservation')->sortable(),
                Tables\Columns\TextColumn::make('max_reservation')->sortable(),
                Tables\Columns\TextColumn::make('cancellation_time')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
}
