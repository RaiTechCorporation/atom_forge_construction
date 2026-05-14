<?php

namespace App\Http\Controllers;

use App\Models\ConstructionPlan;
use App\Models\Service;
use App\Models\WebsiteContent;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Faq;
use App\Models\HomeSection;
use App\Models\BlogPost;

class PublicController extends Controller
{
    private function getContent()
    {
        return WebsiteContent::all()->pluck('value', 'key');
    }

    public function home()
    {
        $content = $this->getContent();
        $plans = ConstructionPlan::where('is_active', true)->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        $homeSections = HomeSection::where('is_active', true)->orderBy('order')->get();
        $teamMembers = TeamMember::where('is_active', true)->orderBy('order')->get();
        $blogs = BlogPost::where('is_published', true)->orderBy('created_at', 'desc')->take(3)->get();

        return view('public.home', compact('content', 'plans', 'testimonials', 'homeSections', 'teamMembers', 'blogs'));
    }

    public function about()
    {
        $content = $this->getContent();

        return view('public.about', compact('content'));
    }

    public function services()
    {
        $content = $this->getContent();
        $services = Service::where('is_active', true)->orderBy('order')->get();

        return view('public.services', compact('content', 'services'));
    }

    public function projects()
    {
        $content = $this->getContent();

        return view('public.projects', compact('content'));
    }

    public function contact()
    {
        $content = $this->getContent();

        return view('public.contact', compact('content'));
    }

    public function team()
    {
        $content = $this->getContent();
        $teamMembers = TeamMember::where('is_active', true)->orderBy('order')->get();

        return view('public.team', compact('content', 'teamMembers'));
    }

    public function testimonials()
    {
        $content = $this->getContent();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();

        return view('public.testimonials', compact('content', 'testimonials'));
    }

    public function privacy()
    {
        $content = $this->getContent();

        return view('public.privacy', compact('content'));
    }

    public function terms()
    {
        $content = $this->getContent();

        return view('public.terms', compact('content'));
    }

    public function faq()
    {
        $content = $this->getContent();
        $faqs = Faq::where('is_active', true)->orderBy('order')->get();

        return view('public.faq', compact('content', 'faqs'));
    }

    public function invest()
    {
        $content = $this->getContent();

        return view('public.invest', compact('content'));
    }

    public function residentialConstruction()
    {
        $content = $this->getContent();
        return view('public.services.residential', compact('content'));
    }

    public function commercialDevelopment()
    {
        $content = $this->getContent();
        return view('public.services.commercial', compact('content'));
    }

    public function industrialInfrastructure()
    {
        $content = $this->getContent();
        return view('public.services.industrial', compact('content'));
    }

    public function interiorDesign()
    {
        $content = $this->getContent();
        return view('public.services.interior', compact('content'));
    }

    public function sustainableBuilding()
    {
        $content = $this->getContent();
        return view('public.services.sustainable', compact('content'));
    }

    public function projectManagement()
    {
        $content = $this->getContent();
        return view('public.services.management', compact('content'));
    }
}
