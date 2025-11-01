<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('freelancer_id')
                    ->required()
                    ->numeric(),
                TextInput::make('rating')
                    ->required()
                    ->numeric(),
                Textarea::make('comment')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('title')
                    ->default(null),
                TextInput::make('quality_rating')
                    ->numeric()
                    ->default(null),
                TextInput::make('communication_rating')
                    ->numeric()
                    ->default(null),
                TextInput::make('deadline_rating')
                    ->numeric()
                    ->default(null),
                TextInput::make('professionalism_rating')
                    ->numeric()
                    ->default(null),
                TextInput::make('helpful_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_verified')
                    ->required(),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
