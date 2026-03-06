<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Order;

class LatestOrders extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
            TextColumn::make('customer.name')
                ->label('Customer'),
            TextColumn::make('grand_total')
                ->numeric()
                ->money('PHP'),
            TextColumn::make('payment_method'),
            TextColumn::make('payment_status'),
            TextColumn::make('status')
                
                ->badge()
                ->color(fn(string $state): string => match ($state) {
                    'Pending' => 'info',
                    'Processing' => 'warning',
                    'Completed' => 'success',
                    'Cancelled' => 'danger',
                })
                ->icon(fn(string $state): string => match ($state) {
                    'Pending' => 'heroicon-m-clock',
                    'Processing' => 'heroicon-m-arrow-path',
                    'Completed' => 'heroicon-m-check-circle',
                    'Cancelled' => 'heroicon-m-x-circle',
                    default => null,
                }),
            TextColumn::make('shipping_amount')
                ->numeric()
                
                ,
            TextColumn::make('shipping_method')
                ,
            TextColumn::make('shipping_address')
                
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('created_at')
                ->label('Order date')
                ->since()
                ,
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ])
            ->description('List of the most recent orders.');
    }
}
