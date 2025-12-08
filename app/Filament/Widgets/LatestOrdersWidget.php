<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Latest Orders';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()->latest()->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order #')
                    ->sortable(),
                Tables\Columns\TextColumn::make('job_title')
                    ->label('Job')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Client')
                    ->searchable(),
                Tables\Columns\TextColumn::make('freelancer.name')
                    ->label('Freelancer')
                    ->searchable()
                    ->placeholder('-'),
                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'info',
                        'accepted' => 'primary',
                        'in_progress' => 'warning',
                        'delivered' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'gray',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state))),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ]);
    }
}
