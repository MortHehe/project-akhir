<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Section::make('User Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->maxLength(255),
                        Forms\Components\Select::make('role')
                            ->options([
                                'admin' => 'Admin',
                                'freelancer' => 'Freelancer',
                                'user' => 'User/Client',
                            ])
                            ->required()
                            ->default('user'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('location')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Freelancer Details')
                    ->schema([
                        Forms\Components\Textarea::make('bio')
                            ->rows(3)
                            ->maxLength(2000),
                        Forms\Components\TextInput::make('hourly_rate')
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0),
                        Forms\Components\TagsInput::make('skills')
                            ->placeholder('Add skills')
                            ->separator(','),
                        Forms\Components\Select::make('availability')
                            ->options([
                                'full_time' => 'Full Time',
                                'part_time' => 'Part Time',
                                'contract' => 'Contract',
                            ]),
                    ])
                    ->columns(2)
                    ->visible(fn (Forms\Get $get) => $get('role') === 'freelancer'),
                Forms\Components\Section::make('Company Details')
                    ->schema([
                        Forms\Components\TextInput::make('company')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('industry')
                            ->maxLength(255),
                        Forms\Components\Select::make('company_size')
                            ->options([
                                '1-10' => '1-10 employees',
                                '11-50' => '11-50 employees',
                                '51-200' => '51-200 employees',
                                '201-500' => '201-500 employees',
                                '500+' => '500+ employees',
                            ]),
                        Forms\Components\TextInput::make('website')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('company_description')
                            ->rows(3)
                            ->maxLength(1000),
                    ])
                    ->columns(2)
                    ->visible(fn (Forms\Get $get) => $get('role') === 'user'),
            ]);
    }
}
