<?php

namespace App\Filament\Resources\Withdrawals\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class WithdrawalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Freelancer')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state)))
                    ->color(fn (string $state): string => match ($state) {
                        'bank_transfer' => 'info',
                        'paypal' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'info',
                        'sent' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable(),
                TextColumn::make('requested_at')
                    ->label('Requested')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
                TextColumn::make('processed_at')
                    ->label('Processed')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->placeholder('-'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'sent' => 'Sent',
                        'rejected' => 'Rejected',
                    ]),
                SelectFilter::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'bank_transfer' => 'Bank Transfer',
                        'paypal' => 'PayPal',
                    ]),
            ])
            ->actions([
                Action::make('approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'approved',
                            'processed_at' => now(),
                        ]);
                    }),
                Action::make('mark_sent')
                    ->label('Mark as Sent')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'approved')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'sent',
                            'processed_at' => now(),
                        ]);
                    }),
                Action::make('reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->form([
                        Textarea::make('admin_notes')
                            ->label('Rejection Reason')
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'admin_notes' => $data['admin_notes'],
                            'processed_at' => now(),
                        ]);
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('requested_at', 'desc');
    }
}
