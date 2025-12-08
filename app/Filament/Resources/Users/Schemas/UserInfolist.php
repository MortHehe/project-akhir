<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Infolists\Components\Section::make('User Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('id')
                            ->label('ID'),
                        Infolists\Components\TextEntry::make('name'),
                        Infolists\Components\TextEntry::make('email')
                            ->copyable(),
                        Infolists\Components\TextEntry::make('role')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'admin' => 'danger',
                                'freelancer' => 'success',
                                'user' => 'info',
                                default => 'gray',
                            }),
                        Infolists\Components\TextEntry::make('phone')
                            ->placeholder('-'),
                        Infolists\Components\TextEntry::make('location')
                            ->placeholder('-'),
                    ])
                    ->columns(3),
                Infolists\Components\Section::make('Freelancer Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('bio')
                            ->placeholder('No bio')
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('hourly_rate')
                            ->money('USD')
                            ->placeholder('-'),
                        Infolists\Components\TextEntry::make('skills')
                            ->badge()
                            ->separator(',')
                            ->placeholder('No skills'),
                        Infolists\Components\TextEntry::make('availability')
                            ->placeholder('-'),
                    ])
                    ->columns(3)
                    ->visible(fn ($record) => $record->role === 'freelancer'),
                Infolists\Components\Section::make('Company Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('company')
                            ->placeholder('-'),
                        Infolists\Components\TextEntry::make('industry')
                            ->placeholder('-'),
                        Infolists\Components\TextEntry::make('company_size')
                            ->placeholder('-'),
                        Infolists\Components\TextEntry::make('website')
                            ->url()
                            ->placeholder('-'),
                        Infolists\Components\TextEntry::make('company_description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->visible(fn ($record) => $record->role === 'user'),
                Infolists\Components\Section::make('Statistics')
                    ->schema([
                        Infolists\Components\TextEntry::make('total_orders')
                            ->label('Total Orders')
                            ->state(fn ($record) => $record->role === 'freelancer'
                                ? $record->freelancerOrders()->count()
                                : $record->clientOrders()->count()),
                        Infolists\Components\TextEntry::make('total_earnings')
                            ->label('Total Earnings')
                            ->money('USD')
                            ->state(fn ($record) => $record->role === 'freelancer'
                                ? $record->getTotalEarningsAttribute()
                                : 0)
                            ->visible(fn ($record) => $record->role === 'freelancer'),
                        Infolists\Components\TextEntry::make('average_rating')
                            ->label('Average Rating')
                            ->state(fn ($record) => $record->role === 'freelancer'
                                ? number_format($record->getAverageRatingAttribute(), 2) . ' / 5'
                                : '-')
                            ->visible(fn ($record) => $record->role === 'freelancer'),
                    ])
                    ->columns(3),
                Infolists\Components\Section::make('Timestamps')
                    ->schema([
                        Infolists\Components\TextEntry::make('created_at')
                            ->dateTime('M d, Y H:i'),
                        Infolists\Components\TextEntry::make('updated_at')
                            ->dateTime('M d, Y H:i'),
                    ])
                    ->columns(2),
            ]);
    }
}
