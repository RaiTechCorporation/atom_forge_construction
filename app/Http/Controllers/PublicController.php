<?php

namespace App\Http\Controllers;

use App\Models\ConstructionPlan;
use App\Models\WebsiteContent;

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

        return view('public.home', compact('content', 'plans'));
    }

    public function about()
    {
        $content = $this->getContent();

        return view('public.about', compact('content'));
    }

    public function services()
    {
        $content = $this->getContent();

        return view('public.services', compact('content'));
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

        return view('public.faq', compact('content'));
    }

    public function invest()
    {
        $content = $this->getContent();

        return view('public.invest', compact('content'));
    }
}
