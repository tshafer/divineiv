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
                'content' => 'Welcome to Divine IV and Wellness located in Chandler, AZ. Led by Family Nurse Practitioner Amy Berkhout, our practice specializes in IV therapy, hormone replacement therapy, weight loss, thyroid disorder, RF skin tightening and dermabrasion. We are dedicated to offering patient-focused care while using advanced techniques and technologies to achieve that objective. Our team looks forward to getting to know patients from the Chandler, Gilbert, Mesa and Queen Creek, AZ area. Book your consultation at our office today.',
                'excerpt' => 'Welcome to Divine IV and Wellness located in Chandler, AZ. Led by Family Nurse Practitioner Amy Berkhout, our practice specializes in IV therapy, hormone replacement therapy, weight loss, thyroid disorder, RF skin tightening and dermabrasion.',
                'meta_title' => 'About Divine IV and Wellness - Chandler, AZ Med Spa',
                'meta_description' => 'Learn about Divine IV and Wellness, a Chandler, AZ med spa led by Family Nurse Practitioner Amy Berkhout specializing in IV therapy, hormone replacement therapy, and aesthetic treatments.',
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
            Page::create($page);
        }
    }
}
