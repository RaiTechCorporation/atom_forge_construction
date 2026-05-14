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
                'title' => 'Residential & Commercial Construction',
                'description' => 'We specialize in building houses, villas, and commercial complexes that stand the test of time. Our construction process is characterized by meticulous planning and high-quality craftsmanship.',
                'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>',
                'image' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=1200',
                'features' => ['Foundation and Structure', 'Masonry and Brickwork', 'Electrical and Plumbing', 'Roofing and Finishing'],
                'button1_text' => 'Residential Construction',
                'button1_link' => 'services.residential',
                'button2_text' => 'Commercial Development',
                'button2_link' => 'services.commercial',
                'order' => 1,
            ],
            [
                'title' => 'Interior Design & Decoration',
                'description' => 'Transform your living or working space with our custom interior solutions. We combine functionality with aesthetics to create beautiful and productive environments.',
                'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>',
                'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&q=80&w=1200',
                'features' => ['Modular Kitchens', 'False Ceiling and Lighting', 'Custom Furniture', 'Wall Decor and Painting'],
                'button1_text' => 'Explore Interior Design',
                'button1_link' => 'services.interior',
                'order' => 2,
            ],
            [
                'title' => 'End-to-End Turnkey Projects',
                'description' => 'Leveraging cutting-edge technology and smart planning, we deliver construction solutions that are scalable, sustainable, and built to last. Our team ensures precision and perfection in every turnkey project.',
                'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>',
                'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=1200',
                'features' => ['Design and Planning', 'Project Management', 'Material Procurement', 'Final Handover'],
                'button1_text' => 'Project Management',
                'button1_link' => 'services.management',
                'button2_text' => 'Sustainable Building',
                'button2_link' => 'services.sustainable',
                'order' => 3,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
