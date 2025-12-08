<?php

namespace App\Filament\Resources\Withdrawals\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class WithdrawalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Section::make('Withdrawal Information')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Freelancer')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->label('Amount')
                            ->numeric()
                            ->prefix('$')
                            ->required()
                            ->minValue(50),
                        Forms\Components\Select::make('payment_method')
                            ->label('Payment Method')
                            ->options([
                                'bank_transfer' => 'Bank Transfer',
                                'paypal' => 'PayPal',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('payment_details')
                            ->label('Payment Details')
                            ->rows(3)
                            ->required(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'sent' => 'Sent',
                                'rejected' => 'Rejected',
                            ])
                            ->default('pending')
                            ->required(),
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Admin Notes')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\DateTimePicker::make('requested_at')
                            ->label('Requested At')
                            ->default(now())
                            ->required(),
                        Forms\Components\DateTimePicker::make('processed_at')
                            ->label('Processed At'),
                    ])
                    ->columns(2),
            ]);
    }
}
