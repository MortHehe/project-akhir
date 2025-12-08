<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueChartWidget extends ChartWidget
{
    protected ?string $heading = 'Monthly Revenue (Platform Fee)';

    protected static ?int $sort = 1;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = $this->getRevenuePerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Platform Revenue (15%)',
                    'data' => $data['revenue'],
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
                [
                    'label' => 'Total Order Value',
                    'data' => $data['total'],
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getRevenuePerMonth(): array
    {
        $now = Carbon::now();
        $months = [];
        $revenue = [];
        $total = [];

        // Get last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $months[] = $date->format('M Y');

            $monthTotal = Order::where('status', 'completed')
                ->whereYear('completed_at', $date->year)
                ->whereMonth('completed_at', $date->month)
                ->sum('price') ?? 0;

            $total[] = $monthTotal;
            $revenue[] = $monthTotal * 0.15; // 15% platform fee
        }

        return [
            'months' => $months,
            'revenue' => $revenue,
            'total' => $total,
        ];
    }
}
