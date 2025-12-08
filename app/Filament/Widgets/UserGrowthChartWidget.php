<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class UserGrowthChartWidget extends ChartWidget
{
    protected ?string $heading = 'User Growth (Last 12 Months)';

    protected static ?int $sort = 4;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = $this->getUsersPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Freelancers',
                    'data' => $data['freelancers'],
                    'backgroundColor' => 'rgba(76, 175, 80, 0.2)',
                    'borderColor' => 'rgba(76, 175, 80, 1)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
                [
                    'label' => 'Clients',
                    'data' => $data['clients'],
                    'backgroundColor' => 'rgba(33, 150, 243, 0.2)',
                    'borderColor' => 'rgba(33, 150, 243, 1)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function getUsersPerMonth(): array
    {
        $now = Carbon::now();
        $months = [];
        $freelancers = [];
        $clients = [];

        // Get last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $months[] = $date->format('M Y');

            $freelancers[] = User::where('role', 'freelancer')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $clients[] = User::where('role', 'user')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return [
            'months' => $months,
            'freelancers' => $freelancers,
            'clients' => $clients,
        ];
    }
}
