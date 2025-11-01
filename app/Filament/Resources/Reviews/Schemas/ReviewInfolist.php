<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReviewInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('order_id')
                    ->numeric(),
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('freelancer_id')
                    ->numeric(),
                TextEntry::make('rating')
                    ->numeric(),
                TextEntry::make('comment')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('title')
                    ->placeholder('-'),
                TextEntry::make('quality_rating')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('communication_rating')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('deadline_rating')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('professionalism_rating')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('helpful_count')
                    ->numeric(),
                IconEntry::make('is_verified')
                    ->boolean(),
                IconEntry::make('is_published')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
