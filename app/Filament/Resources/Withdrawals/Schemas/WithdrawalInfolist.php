<?php

namespace App\Filament\Resources\Withdrawals\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WithdrawalInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('user.name')
                    ->label('Freelancer'),
                TextEntry::make('amount')
                    ->money('USD'),
                TextEntry::make('payment_method')
                    ->label('Payment Method')
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state))),
                TextEntry::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'info',
                        'sent' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                TextEntry::make('payment_details')
                    ->label('Payment Details')
                    ->columnSpanFull(),
                TextEntry::make('admin_notes')
                    ->label('Admin Notes')
                    ->placeholder('No notes')
                    ->columnSpanFull()
                    ->visible(fn ($record) => $record?->admin_notes !== null),
                TextEntry::make('requested_at')
                    ->label('Requested At')
                    ->dateTime('M d, Y H:i'),
                TextEntry::make('processed_at')
                    ->label('Processed At')
                    ->dateTime('M d, Y H:i')
                    ->placeholder('Not processed yet'),
                TextEntry::make('created_at')
                    ->dateTime('M d, Y H:i'),
                TextEntry::make('updated_at')
                    ->dateTime('M d, Y H:i'),
            ]);
    }
}
