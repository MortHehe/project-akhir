<?php

namespace App\Filament\Resources\Withdrawals\Pages;

use App\Filament\Resources\Withdrawals\WithdrawalResource;
use Filament\Actions;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\ViewRecord;

class ViewWithdrawal extends ViewRecord
{
    protected static string $resource = WithdrawalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('approve')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn () => $this->record->status === 'pending')
                ->action(function () {
                    $this->record->update([
                        'status' => 'approved',
                        'processed_at' => now(),
                    ]);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),
            Actions\Action::make('mark_sent')
                ->label('Mark as Sent')
                ->icon('heroicon-o-paper-airplane')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn () => $this->record->status === 'approved')
                ->action(function () {
                    $this->record->update([
                        'status' => 'sent',
                        'processed_at' => now(),
                    ]);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),
            Actions\Action::make('reject')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn () => $this->record->status === 'pending')
                ->form([
                    Textarea::make('admin_notes')
                        ->label('Rejection Reason')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'status' => 'rejected',
                        'admin_notes' => $data['admin_notes'],
                        'processed_at' => now(),
                    ]);
                    $this->redirect(static::getResource()::getUrl('view', ['record' => $this->record]));
                }),
        ];
    }
}
