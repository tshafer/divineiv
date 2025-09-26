<?php

namespace App\Filament\Resources\Menus\Schemas;

use App\Models\Menu;
use Filament\Schemas\Components\Boolean;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Select;
use Filament\Schemas\Components\Textarea;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Schema;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([
                    TextInput::make('title')
                        ->required()
                        ->label('Menu Title')
                        ->placeholder('e.g., About Us')
                        ->helperText('This will be displayed in the navigation menu.'),

                    TextInput::make('url')
                        ->required()
                        ->label('URL/Route')
                        ->placeholder('about-us or contact')
                        ->helperText('Internal page slug for "local" type, route name for "route" type, or full URL for "external" type'),

                    Select::make('type')
                        ->options([
                            'internal' => 'Internal Page',
                            'route' => 'Laravel Route',
                            'external' => 'External Link',
                        ])
                        ->default('internal')
                        ->label('Menu Type')
                        ->helperText('Internal: page slug, Route: Laravel route name, External: full URL'),

                    Select::make('target')
                        ->options([
                            '_self' => 'Same window',
                            '_blank' => 'New window/tab',
                        ])
                        ->default('_self')
                        ->label('Link Target')
                        ->helperText('How the link should open'),

                    Select::make('parent_id')
                        ->options(function () {
                            return Menu::whereNull('parent_id')
                                ->orWhere('level', 0)
                                ->orderBy('title')
                                ->pluck('title', 'id');
                        })
                        ->label('Parent Menu')
                        ->placeholder('Select parent menu (optional)')
                        ->helperText('Choose a parent menu item for submenus')
                        ->nullable(),

                ])->columnSpan(2),

                Group::make([
                    Grid::make(1)->schema([
                        TextInput::make('icon')
                            ->label('Icon Class')
                            ->placeholder('fas fa-home')
                            ->helperText('FontAwesome icon class (e.g., fas fa-home'),

                        TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->label('Display Order')
                            ->helperText('Lower numbers appear first'),

                        TextInput::make('css_classes')
                            ->label('CSS Classes')
                            ->placeholder('custom-menu-item')
                            ->helperText('Additional CSS classes for styling'),

                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Optional description for this menu item')
                            ->helperText('Admin notes only - not displayed on frontend')
                            ->rows(3)
                            ->columnSpan(1),
                    ]),

                    Grid::make(2)->schema([
                        Boolean::make('is_active')
                            ->default(true)
                            ->label('Active')
                            ->helperText('Show/hide this menu item'),

                        Boolean::make('is_published')
                            ->default(true)
                            ->label('Published')
                            ->helperText('Include in navigation rendering'),
                    ]),
                ])->columnSpan(1),
            ]);
    }
}
