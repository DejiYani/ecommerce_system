<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All')
            ->badge(fn()=> $this->getTableQuery()->count()),
             'Pending' => Tab::make()
             ->label('Pending')
             ->badge(fn()=>$this->getTableQuery()->where('status', 'Pending')->count())
             ->query(fn($query)=> $query->where('status', 'Pending')),
             'Processing' => Tab::make()
             ->label('Processing')
             ->badge(fn()=>$this->getTableQuery()->where('status', 'Processing')->count())
             ->query(fn($query)=> $query->where('status', 'Processing')),
             'Completed' => Tab::make()
             ->label('Completed')
             ->badge(fn()=>$this->getTableQuery()->where('status', 'Completed')->count())
             ->query(fn($query)=> $query->where('status', 'Completed')),
             'Cancelled' => Tab::make()
             ->label('Cancelled')
             ->badge(fn()=>$this->getTableQuery()->where('status', 'Cancelled')->count())
             ->query(fn($query)=> $query->where('status', 'Cancelled')),
        ];
    }
}
