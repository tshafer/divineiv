<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => 'Welcome to Divine IV and Wellness based in Chandler, AZ. We are excited to provide Chandler, Gilbert, Mesa and Queen Creek, AZ patients with spectacular patient service and ideal aesthetic outcomes by utilizing high-quality products and advanced techniques. Working alongside family nurse practitioner Amy Berkhout, our team is dedicated to creating a gender-inclusive environment and will prioritize your comfort and goals ahead of everything else. Specializing in hormone replacement therapy, and IV therapy, microneedling, pulsed electromagnetic field therapy (PEMF), hair restoration and weight loss, our team will partner with you to build a detailed treatment plan that works for you. Connect with our office today to embark on your wellness journey.',
                'excerpt' => 'Welcome to Divine IV and Wellness based in Chandler, AZ. We are excited to provide patients with spectacular service and ideal aesthetic outcomes by utilizing high-quality products and advanced techniques.',
                'meta_title' => 'About Divine IV and Wellness - Chandler, AZ Med Spa',
                'meta_description' => 'Learn about Divine IV and Wellness, a Chandler, AZ med spa led by Family Nurse Practitioner Amy Berkhout specializing in IV therapy, hormone replacement therapy, and aesthetic treatments.',
                'featured_image' => '/images/about-masthead.png',
                'active' => true,
            ],
            [
                'title' => 'Amy Berkhout',
                'slug' => 'amy-berkhout',
                'content' => 'Amy Berkhout, FNP-BC is a family nurse practitioner with expertise in hormone replacement therapy, aesthetics, and IV infusion therapy to allow Chandler, AZ area patients to reach their personal aesthetic and wellness goals. With a background in nursing and health promotion, Amy is ready to provide you with the distinguished level of care that you want and deserve.',
                'excerpt' => 'Amy Berkhout, FNP-BC is a family nurse practitioner with expertise in hormone replacement therapy, aesthetics, and IV infusion therapy.',
                'meta_title' => 'Amy Berkhout, FNP-BC - Family Nurse Practitioner',
                'meta_description' => 'Meet Amy Berkhout, FNP-BC, a family nurse practitioner specializing in hormone replacement therapy, aesthetics, and IV infusion therapy in Chandler, AZ.',
                'active' => true,
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'content' => 'Contact Divine IV and Wellness for your consultation today. We are located at 3930 S Alma School Rd Suite 10, Chandler, AZ 85248. You can reach us by phone at 480-488-9858 or schedule your appointment online.',
                'excerpt' => 'Contact Divine IV and Wellness for your consultation today. Located in Chandler, AZ.',
                'meta_title' => 'Contact Divine IV and Wellness - Chandler, AZ',
                'meta_description' => 'Contact Divine IV and Wellness at 3930 S Alma School Rd Suite 10, Chandler, AZ 85248. Call 480-488-9858 to schedule your consultation.',
                'active' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
