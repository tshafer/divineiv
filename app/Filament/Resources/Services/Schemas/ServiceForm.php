<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Select::make('category')
                    ->options([
                        'laser' => 'Laser',
                        'health-and-wellness' => 'Health and Wellness',
                        'iv-therapy' => 'IV Therapy',
                        'skin' => 'Skin',
                        'cosmetic-injections' => 'Cosmetic Injections',
                        'medical-weight-loss' => 'Medical Weight Loss',
                    ])
                    ->searchable(),
                Textarea::make('description')
                    ->maxLength(500)
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->directory('services'),
                TextInput::make('icon')
                    ->maxLength(255),
                Toggle::make('featured')
                    ->default(false),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                Toggle::make('active')
                    ->default(true),
            ]);
    }
}
