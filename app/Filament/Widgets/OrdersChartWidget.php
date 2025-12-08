<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrdersChartWidget extends ChartWidget
{
    protected ?string $heading = 'Orders by Status';

    protected static ?int $sort = 2;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $statuses = [
            'pending' => Order::where('status', 'pending')->count(),
            'paid' => Order::where('status', 'paid')->count(),
            'accepted' => Order::where('status', 'accepted')->count(),
            'in_progress' => Order::where('status', 'in_progress')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'rejected' => Order::where('status', 'rejected')->count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => array_values($statuses),
                    'backgroundColor' => [
                        'rgba(255, 206, 86, 0.6)',   // pending
                        'rgba(54, 162, 235, 0.6)',   // paid
                        'rgba(153, 102, 255, 0.6)',  // accepted
                        'rgba(255, 159, 64, 0.6)',   // in_progress
                        'rgba(75, 192, 192, 0.6)',   // delivered
                        'rgba(76, 175, 80, 0.6)',    // completed
                        'rgba(201, 203, 207, 0.6)',  // cancelled
                        'rgba(244, 67, 54, 0.6)',    // rejected
                    ],
                    'borderColor' => [
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(76, 175, 80, 1)',
                        'rgba(201, 203, 207, 1)',
                        'rgba(244, 67, 54, 1)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => array_map('ucfirst', array_map(fn($s) => str_replace('_', ' ', $s), array_keys($statuses))),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
