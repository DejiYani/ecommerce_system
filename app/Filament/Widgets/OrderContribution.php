<?php

namespace App\Filament\Widgets;

use App\Models\Order;  // Assuming Order is the model for your orders
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class OrderContribution extends ChartWidget
{
    protected ?string $heading = 'Order Contribution';

    protected static ?int $sort = 2;

    protected ?string $maxHeight = '250px';

    protected function getData(): array
    {
        // Query the database for the count of each order status
        $orderStatuses = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Prepare the data for the chart
        $data = [];
        foreach ($orderStatuses as $status) {
            $data[$status->status] = $status->count;
        }

        return [
            'labels' => array_keys($data),
            'datasets' => [
                [
                    'data' => array_values($data),
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#FF9F40'],  // Customize colors as needed
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    public function getDescription(): ?string
    {
        return 'Order status contribution chart.';
    }
}
