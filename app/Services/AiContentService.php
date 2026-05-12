<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class AiContentService
{
    protected $apiKey;
    protected $model;

    public function __construct()
    {
        $this->apiKey = config('services.ai.api_key');
        $this->model = config('services.ai.model', 'gpt-4o');
    }

    public function generateBlogPost(string $topic, string $features = '', string $specific_topics = ''): array
    {
        // Generate features and topics if not provided
        if (empty($features)) {
            $features = "Advanced Construction Technology\nSustainability & Eco-Friendly Materials\nSmart Infrastructure Integration\nCost-Efficient Project Management";
        }

        if (empty($specific_topics)) {
            $specific_topics = "Future of Infrastructure, Innovative Building Materials, Digital Transformation in Construction";
        }

        $featuresList = $features ? explode("\n", $features) : [];
        $topicsList = $specific_topics ? explode(",", $specific_topics) : [];

        $content = "
            <div align='justify' style='margin-bottom: 20px;'>
                India is undergoing a massive transformation in " . strtolower($topic) . ", shaping the foundation of a stronger and more connected nation. From strategic planning to modern execution, the country is investing heavily in projects that drive economic growth and improve everyday life. Infrastructure is no longer just about construction—it is about creating systems that empower industries, support communities, and enable long-term sustainability.
            </div>

            <h3 align='justify' style='font-family: \"Helvetica Neue\", Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); font-weight: bold; margin-bottom: 15px;'>How it Works ?</h3>
            <p align='justify' style='margin-bottom: 20px;'>
                Modern " . strtolower($topic) . " works by integrating advanced engineering with sustainable practices. For decades, the focus was on traditional methods, but now we are moving towards a vivid expression of modern scientific inquiry and exposition. By using Building Information Modeling (BIM) and real-time monitoring, projects are executed with higher precision and lower waste.
            </p>

            <h3 align='justify' style='font-family: \"Helvetica Neue\", Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); font-weight: bold; margin-bottom: 15px;'>Key Features and Highlights</h3>
            <p align='justify' style='margin-bottom: 20px;'>
                The major highlights of our modern projects include digital integration, green construction practices, and improved supply chain systems. These elements ensure that every project contributes optimally to the overall goals of efficiency and scalability.
            </p>

            <h3 align='justify' style='font-family: \"Helvetica Neue\", Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); font-weight: bold; margin-bottom: 15px;'>Top Reasons to Choose Us</h3>
            <div align='justify' style='margin-bottom: 20px;'>
                Building the future requires a spiritual connection between our planet and the infrastructure we create. Our approach ensures durability, worker safety, and compliance with international regulations. We tackle challenges such as land acquisition and regulatory hurdles through innovation and strategic planning.
            </div>

            <p align='justify' style='margin-bottom: 10px;'>
                By embracing innovation and focusing on sustainability, we are not just building infrastructure—we are building a future that is strong, resilient, and globally competitive.
            </p>
        ";

        return [
            'title' => ucfirst($topic),
            'slug' => str()->slug($topic),
            'content' => $content,
            'features' => $features,
            'specific_topics' => $specific_topics,
            'meta_title' => ucfirst($topic) . " | Atom Forge Construction",
            'meta_description' => "Insights and updates on " . $topic . ". Discover key features and professional expertise in modern infrastructure.",
            'keywords' => str_replace(' ', ', ', $topic) . ", construction, infrastructure",
            'tags' => ['Construction', 'Infrastructure'],
            'faq' => [],
        ];
    }
}
