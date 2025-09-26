<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Health and Wellness',
                'slug' => 'health-and-wellness',
                'description' => 'Health and wellness services combine state-of-the-art techniques and technology to improve overall wellness in patients.',
                'content' => 'Health and wellness services combine state-of-the-art techniques and technology to improve overall wellness in patients. Our comprehensive approach focuses on optimizing your body\'s natural healing processes and enhancing your overall quality of life.',
                'featured' => true,
                'sort_order' => 1,
                'active' => true,
            ],
            [
                'title' => 'IV Therapy',
                'slug' => 'iv-therapy',
                'description' => 'IV therapy offers a wide range of customized IV mixes to provide the body with a boost of vitamins, minerals, and antioxidants.',
                'content' => 'IV therapy offers a wide range of customized IV mixes to provide the body with a boost of vitamins, minerals, and antioxidants. Our IV treatments are designed to deliver nutrients directly into your bloodstream for maximum absorption and effectiveness.',
                'featured' => true,
                'sort_order' => 2,
                'active' => true,
            ],
            [
                'title' => 'Skin',
                'slug' => 'skin',
                'description' => 'Skin treatments, like RF skin tightening and microneedling, utilize advanced technologies that can effectively rejuvenate the face and neck.',
                'content' => 'Skin treatments, like RF skin tightening and microneedling, utilize advanced technologies that can effectively rejuvenate the face and neck. Our advanced skin care treatments help restore your skin\'s natural radiance and youthfulness.',
                'featured' => true,
                'sort_order' => 3,
                'active' => true,
            ],
            [
                'title' => 'Cosmetic Injections',
                'slug' => 'cosmetic-injections',
                'description' => 'Cosmetic injections are used to smooth wrinkles, fine lines, and other signs of aging for a fresh and youthful complexion.',
                'content' => 'Cosmetic injections are used to smooth wrinkles, fine lines, and other signs of aging for a fresh and youthful complexion. Our expert team provides safe and effective cosmetic injection treatments to help you achieve your aesthetic goals.',
                'featured' => true,
                'sort_order' => 4,
                'active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
