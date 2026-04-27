<?php

namespace Database\Seeders;

use App\Models\WebsiteContent;
use Illuminate\Database\Seeder;

class WebsiteContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            // Header
            [
                'group' => 'header',
                'key' => 'site_name',
                'value' => 'Atom Forge',
                'type' => 'text',
                'label' => 'Site Name',
            ],
            [
                'group' => 'header',
                'key' => 'header_logo_url',
                'value' => '',
                'type' => 'text',
                'label' => 'Logo URL (Optional)',
            ],
            [
                'group' => 'header',
                'key' => 'header_logo_height',
                'value' => '40',
                'type' => 'number',
                'label' => 'Logo Height (px)',
            ],
            [
                'group' => 'header',
                'key' => 'topbar_address',
                'value' => '3584 Hickory Heights Drive, USA',
                'type' => 'text',
                'label' => 'Top Bar Address',
            ],
            [
                'group' => 'header',
                'key' => 'topbar_phone',
                'value' => '+1 (555) 000-0000',
                'type' => 'text',
                'label' => 'Top Bar Phone',
            ],
            [
                'group' => 'header',
                'key' => 'header_facebook',
                'value' => '#',
                'type' => 'text',
                'label' => 'Header Facebook URL',
            ],
            [
                'group' => 'header',
                'key' => 'header_twitter',
                'value' => '#',
                'type' => 'text',
                'label' => 'Header Twitter URL',
            ],
            [
                'group' => 'header',
                'key' => 'header_linkedin',
                'value' => '#',
                'type' => 'text',
                'label' => 'Header LinkedIn URL',
            ],
            [
                'group' => 'header',
                'key' => 'header_cta_text',
                'value' => 'Request Quote',
                'type' => 'text',
                'label' => 'Header CTA Button Text',
            ],
            [
                'group' => 'header',
                'key' => 'header_cta_link',
                'value' => '/contact',
                'type' => 'text',
                'label' => 'Header CTA Button Link',
            ],

            // Footer
            [
                'group' => 'footer',
                'key' => 'footer_description',
                'value' => "Excellence in construction and architectural design. We build tomorrow's infrastructure with today's precision.",
                'type' => 'textarea',
                'label' => 'Footer Description',
            ],
            [
                'group' => 'footer',
                'key' => 'copyright_text',
                'value' => 'Atom Forge Construction. All rights reserved.',
                'type' => 'text',
                'label' => 'Copyright Text',
            ],
            [
                'group' => 'footer',
                'key' => 'social_facebook',
                'value' => '#',
                'type' => 'text',
                'label' => 'Facebook URL',
            ],
            [
                'group' => 'footer',
                'key' => 'social_twitter',
                'value' => '#',
                'type' => 'text',
                'label' => 'Twitter URL',
            ],
            [
                'group' => 'footer',
                'key' => 'social_linkedin',
                'value' => '#',
                'type' => 'text',
                'label' => 'LinkedIn URL',
            ],

            // Home Page - Hero Section
            [
                'group' => 'home',
                'key' => 'hero_badge',
                'value' => 'Precision in Every Pixel & Pillar',
                'type' => 'text',
                'label' => 'Hero Badge Text',
            ],
            [
                'group' => 'home',
                'key' => 'hero_title',
                'value' => 'We Build The Future With Integrity.',
                'type' => 'text',
                'label' => 'Hero Title',
            ],
            [
                'group' => 'home',
                'key' => 'hero_subtitle',
                'value' => 'Atom Forge Construction delivers world-class residential and commercial infrastructure. Excellence driven by innovation and precision.',
                'type' => 'textarea',
                'label' => 'Hero Subtitle',
            ],
            [
                'group' => 'home',
                'key' => 'hero_image_1',
                'value' => 'https://images.unsplash.com/photo-1541888946425-d81bb19480c5?auto=format&fit=crop&q=80&w=800',
                'type' => 'image',
                'label' => 'Hero Image 1',
            ],
            [
                'group' => 'home',
                'key' => 'hero_image_2',
                'value' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=800',
                'type' => 'image',
                'label' => 'Hero Image 2',
            ],

            // Home Page - Plans Section
            [
                'group' => 'home',
                'key' => 'plans_title_1',
                'value' => 'Choose the best',
                'type' => 'text',
                'label' => 'Plans Section Title 1',
            ],
            [
                'group' => 'home',
                'key' => 'plans_title_2',
                'value' => 'for yourself',
                'type' => 'text',
                'label' => 'Plans Section Title 2',
            ],
            [
                'group' => 'home',
                'key' => 'plans_subtitle',
                'value' => 'Choose Plans & Pricing',
                'type' => 'text',
                'label' => 'Plans Section Subtitle',
            ],
            [
                'group' => 'home',
                'key' => 'plans_tagline',
                'value' => 'Integrated Construction Solutions for Every Scale',
                'type' => 'text',
                'label' => 'Plans Section Tagline',
            ],

            // Home Page - Stats
            [
                'group' => 'home',
                'key' => 'stat_1_value',
                'value' => '150+',
                'type' => 'text',
                'label' => 'Stat 1 Value',
            ],
            [
                'group' => 'home',
                'key' => 'stat_1_label',
                'value' => 'Projects Delivered',
                'type' => 'text',
                'label' => 'Stat 1 Label',
            ],
            [
                'group' => 'home',
                'key' => 'stat_2_value',
                'value' => '10+',
                'type' => 'text',
                'label' => 'Stat 2 Value',
            ],
            [
                'group' => 'home',
                'key' => 'stat_2_label',
                'value' => 'Years Of Experience',
                'type' => 'text',
                'label' => 'Stat 2 Label',
            ],
            [
                'group' => 'home',
                'key' => 'stat_3_value',
                'value' => '98%',
                'type' => 'text',
                'label' => 'Stat 3 Value',
            ],
            [
                'group' => 'home',
                'key' => 'stat_3_label',
                'value' => 'Client Satisfaction',
                'type' => 'text',
                'label' => 'Stat 3 Label',
            ],

            // Services Page
            [
                'group' => 'services',
                'key' => 'services_hero_title',
                'value' => 'Our Services',
                'type' => 'text',
                'label' => 'Services Hero Title',
            ],
            [
                'group' => 'services',
                'key' => 'services_hero_subtitle',
                'value' => 'Delivering end-to-end solutions for all your construction and design needs with absolute precision.',
                'type' => 'textarea',
                'label' => 'Services Hero Subtitle',
            ],

            // Projects Page
            [
                'group' => 'projects',
                'key' => 'projects_hero_title',
                'value' => 'Built Excellence',
                'type' => 'text',
                'label' => 'Projects Hero Title',
            ],
            [
                'group' => 'projects',
                'key' => 'projects_hero_subtitle',
                'value' => 'Showcasing our journey of building landmarks and transforming spaces with precision engineering.',
                'type' => 'textarea',
                'label' => 'Projects Hero Subtitle',
            ],

            // About Page
            [
                'group' => 'about',
                'key' => 'about_hero_title',
                'value' => 'About Atom Forge',
                'type' => 'text',
                'label' => 'About Hero Title',
            ],
            [
                'group' => 'about',
                'key' => 'about_hero_subtitle',
                'value' => 'Building the foundations of the future with passion, integrity, and absolute precision.',
                'type' => 'textarea',
                'label' => 'About Hero Subtitle',
            ],
            [
                'group' => 'about',
                'key' => 'about_who_we_are_title',
                'value' => 'Who We Are',
                'type' => 'text',
                'label' => 'Who We Are Title',
            ],
            [
                'group' => 'about',
                'key' => 'about_who_we_are_content',
                'value' => "Atom Forge Construction is a premier firm dedicated to delivering high-quality residential, commercial, and interior projects. We've built a reputation for excellence through our commitment to integrity and innovation.\n\nWe believe every project is a partnership. We work closely with our clients to understand their vision and translate it into reality, ensuring every detail is handled with care and precision.",
                'type' => 'textarea',
                'label' => 'Who We Are Content',
            ],

            // Contact Info
            [
                'group' => 'contact',
                'key' => 'contact_hero_title',
                'value' => "Let's Build Together",
                'type' => 'text',
                'label' => 'Contact Hero Title',
            ],
            [
                'group' => 'contact',
                'key' => 'contact_hero_subtitle',
                'value' => 'Have a project in mind? Reach out to us and let our experts help you bring your vision to life.',
                'type' => 'textarea',
                'label' => 'Contact Hero Subtitle',
            ],
            [
                'group' => 'contact',
                'key' => 'contact_phone',
                'value' => '+1 (555) 000-0000',
                'type' => 'text',
                'label' => 'Contact Phone',
            ],
            [
                'group' => 'contact',
                'key' => 'contact_email',
                'value' => 'info@atomforge.com',
                'type' => 'text',
                'label' => 'Contact Email',
            ],
            [
                'group' => 'contact',
                'key' => 'contact_address',
                'value' => '3584 Hickory Heights Drive, USA',
                'type' => 'textarea',
                'label' => 'Contact Address',
            ],

            // Privacy Policy
            [
                'group' => 'legal',
                'key' => 'privacy_title',
                'value' => 'Privacy Policy',
                'type' => 'text',
                'label' => 'Privacy Policy Title',
            ],
            [
                'group' => 'legal',
                'key' => 'privacy_content',
                'value' => 'Your privacy is important to us. It is Atom Forge Construction\'s policy to respect your privacy regarding any information we may collect from you across our website.',
                'type' => 'textarea',
                'label' => 'Privacy Policy Content',
            ],

            // Terms & Conditions
            [
                'group' => 'legal',
                'key' => 'terms_title',
                'value' => 'Terms and Conditions',
                'type' => 'text',
                'label' => 'Terms and Conditions Title',
            ],
            [
                'group' => 'legal',
                'key' => 'terms_content',
                'value' => 'By accessing this website, you are agreeing to be bound by these website Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws.',
                'type' => 'textarea',
                'label' => 'Terms and Conditions Content',
            ],

            // FAQ
            [
                'group' => 'faq',
                'key' => 'faq_title',
                'value' => 'Frequently Asked Questions',
                'type' => 'text',
                'label' => 'FAQ Page Title',
            ],
            [
                'group' => 'faq',
                'key' => 'faq_subtitle',
                'value' => 'Find answers to common questions about our services and processes.',
                'type' => 'textarea',
                'label' => 'FAQ Page Subtitle',
            ],
            [
                'group' => 'faq',
                'key' => 'faq_1_question',
                'value' => 'What types of projects do you handle?',
                'type' => 'text',
                'label' => 'FAQ 1 Question',
            ],
            [
                'group' => 'faq',
                'key' => 'faq_1_answer',
                'value' => 'We handle residential, commercial, and interior design projects of all scales.',
                'type' => 'textarea',
                'label' => 'FAQ 1 Answer',
            ],
        ];

        foreach ($contents as $content) {
            WebsiteContent::updateOrCreate(['key' => $content['key']], $content);
        }
    }
}
