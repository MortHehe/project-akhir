<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Withdrawals\WithdrawalResource;
use App\Models\Order;
use App\Models\User;
use App\Models\Withdrawal;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        // Calculate total revenue (15% platform fee from completed orders)
        $totalOrderValue = Order::where('status', 'completed')->sum('price');
        $platformRevenue = $totalOrderValue * 0.15;

        // Total users by role
        $totalUsers = User::where('role', 'user')->count();
        $totalFreelancers = User::where('role', 'freelancer')->count();

        // Total orders
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'completed')->count();
        $pendingOrders = Order::whereIn('status', ['pending', 'paid', 'accepted', 'in_progress'])->count();

        // Pending withdrawals
        $pendingWithdrawals = Withdrawal::where('status', 'pending')->count();
        $pendingWithdrawalAmount = Withdrawal::where('status', 'pending')->sum('amount');

        return [
            Stat::make('Total Revenue (Platform Fee)', '$' . number_format($platformRevenue, 2))
                ->description('15% from completed orders')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success')
                ->chart([7, 15, 4, 10, 20, 15, 25]),

            Stat::make('Total Orders', number_format($totalOrders))
                ->description($completedOrders . ' completed, ' . $pendingOrders . ' pending')
                ->descriptionIcon('heroicon-o-shopping-cart')
                ->color('info')
                ->chart([3, 5, 7, 9, 12, 15, 18]),

            Stat::make('Total Users', number_format($totalUsers + $totalFreelancers))
                ->description($totalFreelancers . ' freelancers, ' . $totalUsers . ' clients')
                ->descriptionIcon('heroicon-o-users')
                ->color('warning')
                ->chart([10, 20, 30, 40, 50, 60, 70]),

            Stat::make('Pending Withdrawals', number_format($pendingWithdrawals))
                ->description('$' . number_format($pendingWithdrawalAmount, 2) . ' total')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color($pendingWithdrawals > 0 ? 'danger' : 'success'),
        ];
    }
}
