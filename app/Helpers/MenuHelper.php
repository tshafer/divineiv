<?php

namespace App\Helpers;

use App\Models\Menu;
use Illuminate\Support\Collection;

class MenuHelper
{
    /**
     * Get navigation menus formatted for display
     */
    public static function getNavigationMenus(string $name = 'main', int $maxLevel = 2): Collection
    {
        return Menu::published()
            ->parentItems()
            ->ordered()
            ->with('children.children')
            ->get()
            ->map(function ($menu) {
                return self::formatMenuForDisplay($menu);
            });
    }

    /**
     * Format a menu item for display
     */
    public static function formatMenuForDisplay(Menu $menu): array
    {
        return [
            'id' => $menu->id,
            'title' => $menu->title,
            'url' => self::getMenuUrl($menu),
            'target' => $menu->target ?? '_self',
            'icon' => $menu->icon,
            'css_classes' => $menu->css_classes,
            'is_active' => $menu->is_active,
            'is_published' => $menu->is_published,
            'children' => $menu->children->map([self::class, 'formatMenuForDisplay'])->toArray(),
        ];
    }

    /**
     * Get the full URL for a menu item
     */
    public static function getMenuUrl(Menu $menu): string
    {
        return match ($menu->type) {
            'route' => self::resolveRoute($menu->url),
            'external' => $menu->url,
            default => url('/'.$menu->url)
        };
    }

    /**
     * Resolve route URL
     */
    protected static function resolveRoute(string $routeName): string
    {
        try {
            return route($routeName);
        } catch (\Exception $e) {
            // If route doesn't exist, fallback to the route name as URL
            return $routeName;
        }
    }

    /**
     * Create default menu structure
     */
    public static function createDefaultMenus(): void
    {
        $defaultMenus = [
            [
                'title' => 'Home',
                'url' => 'home',
                'type' => 'route',
                'icon' => 'fas fa-home',
                'order' => 1,
                'level' => 0,
            ],
            [
                'title' => 'About',
                'url' => 'page',
                'type' => 'route',
                'icon' => 'fas fa-info-circle',
                'order' => 2,
                'level' => 0,
            ],
            [
                'title' => 'Services',
                'url' => 'services',
                'type' => 'route',
                'icon' => 'fas fa-heart',
                'order' => 3,
                'level' => 0,
            ],
            [
                'title' => 'Photos',
                'url' => 'page',
                'type' => 'route',
                'icon' => 'fas fa-images',
                'order' => 4,
                'level' => 0,
            ],
            [
                'title' => 'Reviews',
                'url' => 'reviews',
                'type' => 'route',
                'icon' => 'fas fa-star',
                'order' => 5,
                'level' => 0,
            ],
            [
                'title' => 'Contact',
                'url' => 'contact',
                'type' => 'route',
                'icon' => 'fas fa-phone',
                'order' => 6,
                'level' => 0,
            ],
        ];

        foreach ($defaultMenus as $menuData) {
            Menu::updateOrCreate(
                [
                    'title' => $menuData['title'],
                    'level' => $menuData['level'],
                ],
                [
                    'url' => $menuData['url'],
                    'type' => $menuData['type'],
                    'icon' => $menuData['icon'],
                    'order' => $menuData['order'],
                    'is_active' => true,
                    'is_published' => true,
                ]
            );
        }
    }

    /**
     * Reorder menu items
     */
    public static function reorderMenuItems(array $menuIds): void
    {
        foreach ($menuIds as $position => $menuId) {
            Menu::where('id', $menuId)->update(['order' => $position + 1]);
        }
    }

    /**
     * Toggle menu visibility
     */
    public static function toggleMenuVisibility(int $menuId): bool
    {
        $menu = Menu::find($menuId);

        if ($menu) {
            $menu->is_active = ! $menu->is_active;
            $menu->save();

            return $menu->is_active;
        }

        return false;
    }

    /**
     * Check if a menu item is active based on current route/page
     */
    public static function isMenuItemActive(Menu $menu): bool
    {
        $currentUrl = request()->url();
        $menuUrl = self::getMenuUrl($menu);

        // Direct URL match
        if ($currentUrl === $menuUrl) {
            return true;
        }

        // Route name comparison for route-type menus
        if ($menu->type === 'route') {
            try {
                $generatedUrl = route($menu->url);
                if ($currentUrl === $generatedUrl) {
                    return true;
                }
            } catch (\Exception $e) {
                // If route doesn't exist, check for slug match
                $urlPath = parse_url($menuUrl, PHP_URL_PATH);
                $currentPath = parse_url($currentUrl, PHP_URL_PATH);

                if ($urlPath && $currentPath && str_ends_with($currentPath, $urlPath)) {
                    return true;
                }
            }

            // Check if it's a page route
            if (str_starts_with($menu->url, 'page.')) {
                $slug = str_replace('page.', '', $menu->url);
                try {
                    $pageUrl = route('page', $slug);
                    if ($currentUrl === $pageUrl) {
                        return true;
                    }
                } catch (\Exception $e) {
                    // Fall back to slug matching
                    $urlPath = parse_url($menuUrl, PHP_URL_PATH);
                    $currentPath = parse_url($currentUrl, PHP_URL_PATH);

                    if ($slug && (str_contains($currentPath, "/{$slug}") || $currentPath === "/{$slug}")) {
                        return true;
                    }
                }
            }

            // Check for specific route names
            if ($menu->url === 'home' && request()->routeIs('home')) {
                return true;
            }

            if ($menu->url === 'services' && request()->routeIs('services')) {
                return true;
            }

            if ($menu->url === 'reviews' && request()->routeIs('reviews')) {
                return true;
            }

            if ($menu->url === 'contact' && request()->routeIs('contact')) {
                return true;
            }

            if ($menu->url === 'blog' && request()->routeIs('blog')) {
                return true;
            }
        }

        // For internal page routes
        if ($menu->type === 'internal') {
            $urlPath = parse_url($menuUrl, PHP_URL_PATH);
            $currentPath = parse_url($currentUrl, PHP_URL_PATH);

            if ($urlPath && $currentPath && str_ends_with($currentPath, $urlPath)) {
                return true;
            }
        }

        // For external links, check if it's the current URL exactly
        if ($menu->type === 'external') {
            return $currentUrl === $menu->url;
        }

        return false;
    }

    /**
     * Get main navigation HTML
     */
    public static function renderNavigation(string $classes = ''): string
    {
        $menus = self::getNavigationMenus();

        if ($menus->isEmpty()) {
            return view('components.navigation-fallback')->render();
        }

        return view('components.dynamic-navigation', [
            'menus' => $menus,
            'classes' => $classes,
        ])->render();
    }
}
