<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'title' => 'A Global Network',
                'subtitle' => 'International Presence',
                'description' => 'We maintain a robust presence across multiple regions, ensuring global standards are met in local projects.',
                'icon' => 'globe',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'A Global Network',
                'subtitle' => 'Certified Excellence',
                'description' => 'Our commitment to quality is backed by international certifications and industry-leading standards.',
                'icon' => 'award',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'A Global Network',
                'subtitle' => 'Modern Infrastructure',
                'description' => 'Leveraging the latest architectural trends to build infrastructure that stands the test of time.',
                'icon' => 'building',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'About Us',
                'subtitle' => 'A Little Bit More',
                'description' => "We are a leading construction firm dedicated to delivering excellence in every project we undertake. With decades of experience, our team of experts ensures that your vision is brought to life with precision and care.\n\nOur commitment to quality, innovation, and sustainability sets us apart in the industry. We work closely with our clients to provide tailored solutions that meet their unique needs and exceed their expectations.",
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=800',
                'button_text' => 'Read More',
                'button_url' => '/about',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            \App\Models\HomeSection::create($section);
        }
    }
}
