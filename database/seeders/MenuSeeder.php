<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'title' => 'Home',
                'url' => 'home',
                'type' => 'route',
                'icon' => 'fas fa-home',
                'order' => 1,
                'level' => 0,
                'is_active' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Amy Berkhout',
                'url' => 'page.about-us',
                'type' => 'route',
                'icon' => 'fas fa-user-md',
                'order' => 2,
                'level' => 0,
                'is_active' => true,
                'is_published' => true,
            ],
            [
                'title' => 'About',
                'url' => 'page.about-us',
                'type' => 'route',
                'icon' => 'fas fa-info-circle',
                'order' => 3,
                'level' => 0,
                'is_active' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Services',
                'url' => 'services',
                'type' => 'route',
                'icon' => 'fas fa-heart',
                'order' => 4,
                'level' => 0,
                'is_active' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Photos',
                'url' => 'page.photos',
                'type' => 'route',
                'icon' => 'fas fa-images',
                'order' => 5,
                'level' => 0,
                'is_active' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Reviews',
                'url' => 'reviews',
                'type' => 'route',
                'icon' => 'fas fa-star',
                'order' => 6,
                'level' => 0,
                'is_active' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Translate',
                'url' => '#',
                'type' => 'external',
                'icon' => 'fas fa-language',
                'order' => 7,
                'level' => 0,
                'is_active' => false,
                'is_published' => false,
            ],
            [
                'title' => 'VIP Rewards',
                'url' => '#',
                'type' => 'external',
                'icon' => 'fas fa-crown',
                'order' => 8,
                'level' => 0,
                'is_active' => false,
                'is_published' => false,
            ],
            [
                'title' => 'Resources',
                'url' => '#',
                'type' => 'external',
                'icon' => 'fas fa-book',
                'order' => 9,
                'level' => 0,
                'is_active' => false,
                'is_published' => false,
            ],
            [
                'title' => 'Contact',
                'url' => 'contact',
                'type' => 'route',
                'icon' => 'fas fa-phone',
                'order' => 10,
                'level' => 0,
                'is_active' => true,
                'is_published' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate([
                'title' => $menu['title'],
                'url' => $menu['url'],
            ], $menu);
        }
    }
}
