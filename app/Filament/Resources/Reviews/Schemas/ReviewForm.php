<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('author_name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('content')
                    ->required()
                    ->maxLength(1000)
                    ->columnSpanFull(),
                Select::make('rating')
                    ->options([
                        1 => '1 Star',
                        2 => '2 Stars',
                        3 => '3 Stars',
                        4 => '4 Stars',
                        5 => '5 Stars',
                    ])
                    ->default(5)
                    ->required(),
                Select::make('source')
                    ->options([
                        'Google' => 'Google',
                        'Yelp' => 'Yelp',
                        'Facebook' => 'Facebook',
                        'Other' => 'Other',
                    ])
                    ->default('Google'),
                TextInput::make('source_url')
                    ->url()
                    ->maxLength(255),
                Toggle::make('featured')
                    ->default(false),
                Toggle::make('active')
                    ->default(true),
            ]);
    }
}
