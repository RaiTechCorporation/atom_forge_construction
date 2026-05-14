<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'What types of projects do you handle?',
                'answer' => 'We handle residential, commercial, and interior design projects of all scales.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'How long does a typical construction project take?',
                'answer' => 'Timeline depends on the project scope. Residential homes typically take 6-12 months, while smaller renovations may take 2-4 months.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Do you provide free estimates?',
                'answer' => 'Yes, we provide initial consultations and detailed project estimates free of charge to help you plan your budget.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Are you licensed and insured?',
                'answer' => 'Absolutely. We are fully licensed, bonded, and insured to ensure complete protection for our clients and workers.',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'What areas do you serve?',
                'answer' => 'We currently serve the metropolitan area and surrounding suburbs within a 100-mile radius.',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'question' => 'How do you handle project delays?',
                'answer' => 'We maintain proactive communication. If delays occur due to weather or supply issues, we adjust schedules and keep you updated immediately.',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
