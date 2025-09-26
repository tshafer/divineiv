<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Select::make('type')
                            ->options([
                                'page' => 'Page',
                                'blog_post' => 'Blog Post',
                            ])
                            ->default('page'),
                        Toggle::make('active')
                            ->default(true),
                    ])->columns(2),

                Section::make('Content')
                    ->schema([
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold', 'italic', 'link', 'bulletList', 'orderedList', 'codeBlock', 'blockquote', 'undo', 'redo',
                            ]),
                        Textarea::make('excerpt')
                            ->label('Excerpt/Description')
                            ->helperText('Optional description shown on the page')
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Hero Section')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->image()
                            ->directory('pages')
                            ->help('This image will be used as a background hero image')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9', '4:3', '3:2', '1:1',
                            ]),
                        TextInput::make('hero_title')
                            ->label('Hero Title Override')
                            ->maxLength(255)
                            ->help('Optional title specifically for hero section'),
                        Textarea::make('hero_subtitle')
                            ->label('Hero Subtitle')
                            ->maxLength(300)
                            ->rows(2)
                            ->help('Optional subtitle shown in the hero section'),
                    ])->columns(2),

                Section::make('SEO & Meta')
                    ->schema([
                        TextInput::make('meta_title')
                            ->maxLength(255)
                            ->label('SEO Title'),
                        Textarea::make('meta_description')
                            ->maxLength(500)
                            ->label('SEO Description')
                            ->rows(3),
                    ]),

                Section::make('Quick Action Cards')
                    ->schema([
                        Repeater::make('action_cards')
                            ->label('Quick Action Buttons')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Button Title')
                                    ->required(),
                                TextInput::make('url')
                                    ->label('Link URL')
                                    ->required(),
                                TextInput::make('icon')
                                    ->label('FontAwesome Icon Class')
                                    ->default('fas fa-arrow-right')
                                    ->helperText('e.g., fas fa-phone, fas fa-calendar'),
                                Select::make('variant')
                                    ->label('Button Style')
                                    ->options([
                                        'primary' => 'Primary (Blue)',
                                        'secondary' => 'Secondary (Outline)',
                                    ])
                                    ->default('primary'),
                            ])
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->defaultItems(0)
                            ->maxItems(4),
                    ]),

                Section::make('Additional Settings')
                    ->schema([
                        Toggle::make('show_hero_cards')
                            ->label('Show Hero Cards')
                            ->default(true)
                            ->help('Display cards in the hero section'),
                        Toggle::make('show_contact_sidebar')
                            ->label('Show Contact Info Sidebar')
                            ->default(true)
                            ->help('Display contact information and quick actions'),
                        Select::make('content_layout')
                            ->label('Content Layout')
                            ->options([
                                'two_column' => 'Two Column (Content + Sidebar)',
                                'full_width' => 'Full Width Content',
                                'centered' => 'Centered Content',
                            ])
                            ->default('two_column'),
                    ])->columns(3),
            ]);
    }
}
