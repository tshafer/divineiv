<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

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
                'content' => 'Health and wellness services combine state-of-the-art techniques and technology to improve overall wellness in patients. Our comprehensive approach focuses on optimizing your body\'s natural healing processes and enhancing your overall quality of life.

Our wellness program includes:
• Comprehensive health assessments
• Personalized nutrition counseling
• Hormone replacement therapy
• Weight loss management programs
• Stress management techniques
• Health monitoring and follow-up care

We work closely with you to develop a comprehensive wellness plan that addresses your unique health needs and helps you achieve optimal vitality.',
                'icon' => 'fas fa-heartbeat',
                'category' => 'health-and-wellness',
                'featured' => true,
                'sort_order' => 1,
                'active' => true,
            ],
            [
                'title' => 'IV Therapy',
                'slug' => 'iv-therapy',
                'description' => 'IV therapy offers a wide range of customized IV mixes to provide the body with a boost of vitamins, minerals, and antioxidants.',
                'content' => 'IV therapy offers a wide range of customized IV mixes to provide the body with a boost of vitamins, minerals, and antioxidants. Our IV treatments are designed to deliver nutrients directly into your bloodstream for maximum absorption and effectiveness.

Available IV Treatments:
• Hydration Therapy - Replenish essential fluids
• Vitamin C Infusion - Boost immune system
• B-Complex Therapy - Enhance energy levels
• Magnesium Infusion - Combat muscle cramps and stress
• Myers Cocktail - Complete vitamin and mineral boost
• Glutathione Therapy - Powerful antioxidant therapy

Each IV treatment is customized to your specific needs and administered in a comfortable, relaxing environment.',
                'icon' => 'fas fa-tint',
                'category' => 'iv-therapy',
                'featured' => true,
                'sort_order' => 2,
                'active' => true,
            ],
            [
                'title' => 'Laser Treatments',
                'slug' => 'laser',
                'description' => 'Advanced laser treatments for skin rejuvenation, hair removal, scar reduction, and age spot removal.',
                'content' => 'Advanced laser treatments for skin rejuvenation, hair removal, scar reduction, and age spot removal. Our cutting-edge laser technology can address a wide variety of skin concerns with minimal downtime and exceptional results.

Laser Services Include:
• Laser Hair Removal - Permanent hair reduction
• Fraxel Laser - Skin resurfacing and texture improvement
• IPL Photofacial - Sun damage and age spot treatment
• Laser Skin Tightening - Reduce fine lines and skin laxity
• Tattoo Removal - Safe and effective tattoo removal
• Vascular Laser - Treatment of spider veins and redness

All treatments are performed by our experienced professionals in a medical-grade setting.',
                'icon' => 'fas fa-magic',
                'category' => 'laser',
                'featured' => true,
                'sort_order' => 3,
                'active' => true,
            ],
            [
                'title' => 'Cosmetic Injections',
                'slug' => 'cosmetic-injections',
                'description' => 'Cosmetic injections are used to smooth wrinkles, fine lines, and other signs of aging for a fresh and youthful complexion.',
                'content' => 'Cosmetic injections are used to smooth wrinkles, fine lines, and other signs of aging for a fresh and youthful complexion. Our expert team provides safe and effective cosmetic injection treatments to help you achieve your aesthetic goals.

Injectable Treatment Options:
• Botox Injectable Treatments - Smooth forehead lines and crow\'s-feet
• Dermal Fillers - Restore volume and lift facial contours
• Juvederm Injections - Soften marionette lines and lip enhancement
• Restylane Treatments - Natural-looking lip and cheek enhancement
• Kybella - Double chin reduction
• Hydrafacial Treatments - Deep pore cleaning and skin revitalization

Each treatment is customized to your facial anatomy and aesthetic goals for natural, beautiful results.',
                'icon' => 'fas fa-user-md',
                'category' => 'cosmetic-injections',
                'featured' => true,
                'sort_order' => 4,
                'active' => true,
            ],
            [
                'title' => 'Medical Weight Loss',
                'slug' => 'medical-weight-loss',
                'description' => 'Comprehensive medical weight loss programs designed to help you achieve and maintain healthy weight goals.',
                'content' => 'Comprehensive medical weight loss programs designed to help you achieve and maintain healthy weight goals. Our physician-supervised programs provide the medical support and guidance you need for sustainable weight loss results.

Weight Loss Services:
• B12 Injections for Weight Loss - Boost metabolism and energy
• Lipotropic Injections - Accelerate fat metabolism
• Diet and Nutrition Counseling - Personalized meal planning
• Hormone Balancing - Address weight-related hormone issues
• Lifestyle Coaching - Develop healthy long-term habits
• Ongoing Weight Management - Maintain your results

Our medical weight loss programs are designed for sustainable results with the support of our medical team.',
                'icon' => 'fas fa-weight-hanging',
                'category' => 'medical-weight-loss',
                'featured' => true,
                'sort_order' => 5,
                'active' => true,
            ],
            [
                'title' => 'Skin Care',
                'slug' => 'skin',
                'description' => 'Advanced skin treatments including RF skin tightening, microneedling, and comprehensive skin rejuvenation therapy.',
                'content' => 'Advanced skin treatments including RF skin tightening, microneedling, and comprehensive skin rejuvenation therapy. Our advanced skin care treatments help restore your skin\'s natural radiance and youthfulness.

Skin Treatment Services:
• RF Skin Tightening - Firm and tighten facial and body skin
• Microneedling - Stimulate collagen production with minimal downtime
• Chemical Peels - Rejuvenate and brighten skin texture
• HydraFacials - Deep pore cleaning and hydration
• LED Light Therapy - Anti-aging and acne treatment
• Pulsed Electromagnetic Field Therapy (PEMF) - Cell regeneration
• Dermaplaning - Exfoliation and hair removal

Each treatment is tailored to your skin type and concerns for optimal results.',
                'icon' => 'fas fa-spa',
                'category' => 'skin',
                'featured' => true,
                'sort_order' => 6,
                'active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
