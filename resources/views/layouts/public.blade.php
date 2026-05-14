<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $content['site_name'] ?? config('app.name', 'Atom Forge Construction') }} | Excellence in Building</title>

        <!-- Fonts: Inter for both body and headings for clean SaaS feel -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.jsx'])
        
        @stack('styles')
        
        <style>
            [x-cloak] { display: none !important; }
            body { font-family: 'Poppins', sans-serif; letter-spacing: -0.01em; }
            .header-shadow { 
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            }
            .nav-link-active {
                color: #EE5A24 !important;
            }
            .text-orange-construction {
                color: #EE5A24;
            }
            .bg-orange-construction {
                background-color: #EE5A24;
            }
            .hover-orange-construction:hover {
                color: #EE5A24;
            }
            @keyframes progress-spin {
                0% { stroke-dashoffset: 62.8; transform: rotate(0deg); }
                50% { stroke-dashoffset: 20; transform: rotate(180deg); }
                100% { stroke-dashoffset: 62.8; transform: rotate(360deg); }
            }
            .animate-progress {
                animation: progress-spin 2s ease-in-out infinite;
                transform-origin: center;
            }
            .web3-glass {
                position: relative;
                padding: 1.5px; /* Border thickness */
                overflow: hidden;
                border-radius: 9999px;
                display: inline-flex;
                z-index: 1;
                transition: all 0.3s ease;
            }
            .web3-glass::before {
                content: '';
                position: absolute;
                width: 200%;
                height: 500%;
                top: -200%;
                left: -50%;
                background: conic-gradient(from 0deg, #EE5A24, #fbbf24, #EE5A24);
                animation: rotate-gradient 3s linear infinite;
                z-index: -1;
            }
            .web3-glass-content {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border-radius: 9999px;
                padding: 6px 18px;
                display: flex;
                align-items: center;
                gap: 8px;
                width: 100%;
                height: 100%;
                font-weight: 700;
                color: #1a1a1a;
            }
            @keyframes rotate-gradient {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }

            /* Blog Details Specific Design */
            .blog-details-box {
                background: #fff;
                border: 1px solid rgba(0,0,0,0.05);
                border-radius: 15px;
                overflow: hidden;
            }
            .blog-details-box .details {
                padding: 30px;
            }
            .blog-details-box .blog-title {
                font-size: 28px;
                font-weight: 700;
                color: #1a1a1a;
                margin-bottom: 20px;
                line-height: 1.3;
            }
            .post-meta {
                list-style: none;
                padding: 0;
                margin: 0 0 25px;
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                border-bottom: 1px solid #eee;
                padding-bottom: 15px;
            }
            .post-meta li a {
                color: #666;
                font-size: 14px;
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .post-meta li a i {
                color: #EE5A24;
            }
            .social-links {
                list-style: none;
                padding: 20px 30px;
                margin: 0;
                display: flex;
                gap: 10px;
                border-top: 1px solid #eee;
                background: #f9f9f9;
            }
            .social-links li a {
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                color: #fff;
                font-size: 14px;
                transition: all 0.3s;
            }
            .social-links li a.facebook { background: #3b5998; }
            .social-links li a.twitter { background: #1da1f2; }
            .social-links li a.linkedin { background: #0077b5; }
            .social-links li a.pinterest { background: #bd081c; }
            .social-links li a.plus { background: #EE5A24; }
            .social-links li a:hover { opacity: 0.8; transform: translateY(-2px); }
        </style>
    </head>
    <body class="antialiased text-slate-900 bg-white selection:bg-orange-600 selection:text-white" x-data="{ mobileMenuOpen: false }">
        <div class="min-h-screen flex flex-col">
            <!-- Modern Clean Navigation -->
            <nav class="bg-white sticky top-0 z-[100] border-b border-gray-100 header-shadow transition-all duration-300" x-data="{ servicesOpen: false, pagesOpen: false }">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-20">
                        <div class="flex items-center">
                            <a href="{{ route('home') }}" class="group flex items-center gap-3">
                                @if(isset($content['header_logo_url']) && $content['header_logo_url'])
                                    <img src="{{ $content['header_logo_url'] }}" alt="{{ $content['site_name'] ?? 'Atom Forge' }} Logo" style="height: {{ $content['header_logo_height'] ?? '64' }}px" class="w-auto">
                                @else
                                    <img src="{{ asset('images/cropped-Atom-Forge-Logo.png-For-White-Background.png') }}" alt="Atom Forge Logo" class="h-12 lg:h-14 xl:h-16 w-auto">
                                @endif
                                <div class="flex flex-col justify-center -space-y-0.5">
                                    <span class="font-bold text-lg lg:text-xl xl:text-2xl text-black tracking-tight whitespace-nowrap leading-tight">
                                        {{ $content['site_name'] ?? 'Atom Forge' }} 
                                    </span>
                                    <span class="font-bold text-[10px] lg:text-xs xl:text-sm text-orange-construction tracking-[0.2em] uppercase leading-tight">
                                        Construction
                                    </span>
                                </div>
                            </a>

                            <!-- Desktop Navigation Links -->
                            <div class="hidden md:flex md:ml-4 lg:ml-8 xl:ml-12 md:space-x-0.5 lg:space-x-1 xl:space-x-2">
                                <a href="{{ route('home') }}" class="px-1 lg:px-1.5 xl:px-2 py-2 text-[13px] lg:text-[14px] xl:text-[15px] font-semibold transition-all duration-200 {{ request()->routeIs('home') ? 'nav-link-active' : 'text-gray-700 hover:text-orange-construction' }}">
                                    Home
                                </a>

                                <!-- Services Dropdown -->
                                <div class="relative" @mouseenter="servicesOpen = true" @mouseleave="servicesOpen = false">
                                    <button class="flex items-center gap-0.5 lg:gap-1 px-1 lg:px-1.5 xl:px-2 py-2 text-[13px] lg:text-[14px] xl:text-[15px] font-semibold text-gray-700 hover:text-orange-construction transition-all duration-200 {{ request()->routeIs('services') ? 'nav-link-active' : '' }}">
                                        Services
                                        <svg class="w-3.5 h-3.5 lg:w-4 lg:h-4 transition-transform duration-200" :class="servicesOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    <div x-show="servicesOpen" 
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="opacity-0 scale-95"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         class="absolute left-0 mt-0 w-48 bg-white border border-gray-100 shadow-lg rounded-xl py-2 z-[110]"
                                         x-cloak>
                                        <a href="{{ route('services') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-construction">All Services</a>
                                        <a href="{{ route('services.residential') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-construction">Residential Construction</a>
                                        <a href="{{ route('services.commercial') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-construction">Commercial Development</a>
                                        <a href="{{ route('services.industrial') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-construction">Industrial Infrastructure</a>
                                        <a href="{{ route('services.interior') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-construction">Custom Interior Design</a>
                                        <a href="{{ route('services.sustainable') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-construction">Sustainable Building</a>
                                        <a href="{{ route('services.management') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-construction">Project Management</a>
                                    </div>
                                </div>

                                <a href="{{ route('projects') }}" class="px-1 lg:px-1.5 xl:px-2 py-2 text-[13px] lg:text-[14px] xl:text-[15px] font-semibold transition-all duration-200 {{ request()->routeIs('projects') ? 'nav-link-active' : 'text-gray-700 hover:text-orange-construction' }}">
                                    Projects
                                </a>
                                <a href="{{ route('blogs.index') }}" class="px-1 lg:px-1.5 xl:px-2 py-2 text-[13px] lg:text-[14px] xl:text-[15px] font-semibold text-gray-700 hover:text-orange-construction transition-all duration-200">
                                    Blog
                                </a>
                                <a href="{{ route('faq') }}" class="px-1 lg:px-1.5 xl:px-2 py-2 text-[13px] lg:text-[14px] xl:text-[15px] font-semibold transition-all duration-200 {{ request()->routeIs('faq') ? 'nav-link-active' : 'text-gray-700 hover:text-orange-construction' }}">
                                    FAQ
                                </a>
                                <div class="flex items-center px-1 lg:px-1.5 xl:px-2">
                                    <a href="{{ route('public.invest') }}" class="web3-glass group hover:scale-105 scale-[0.8] lg:scale-90 xl:scale-100 origin-left">
                                        <div class="web3-glass-content">
                                            <div class="relative w-2 h-2 rounded-full bg-orange-construction animate-pulse"></div>
                                            Invest
                                        </div>
                                    </a>
                                </div>

                                <!-- Pages Dropdown -->
                                <div class="relative" @mouseenter="pagesOpen = true" @mouseleave="pagesOpen = false">
                                    <button class="flex items-center gap-0.5 lg:gap-1 px-1 lg:px-1.5 xl:px-2 py-2 text-[13px] lg:text-[14px] xl:text-[15px] font-semibold text-gray-700 hover:text-orange-construction transition-all duration-200 {{ request()->routeIs('about') || request()->routeIs('team') || request()->routeIs('testimonials') ? 'nav-link-active' : '' }}">
                                        Pages
                                        <svg class="w-3.5 h-3.5 lg:w-4 lg:h-4 transition-transform duration-200" :class="pagesOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    <div x-show="pagesOpen" 
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="opacity-0 scale-95"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         class="absolute left-0 mt-0 w-48 bg-white border border-gray-100 shadow-lg rounded-xl py-2 z-[110]"
                                         x-cloak>
                                        <a href="{{ route('about') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-construction {{ request()->routeIs('about') ? 'text-orange-construction' : '' }}">About Us</a>
                                        <a href="{{ route('team') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-construction {{ request()->routeIs('team') ? 'text-orange-construction' : '' }}">Team</a>
                                        <a href="{{ route('testimonials') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-construction {{ request()->routeIs('testimonials') ? 'text-orange-construction' : '' }}">Testimonials</a>
                                    </div>
                                </div>

                                <a href="{{ route('contact') }}" class="px-1 lg:px-1.5 xl:px-2 py-2 text-[13px] lg:text-[14px] xl:text-[15px] font-semibold transition-all duration-200 {{ request()->routeIs('contact') ? 'nav-link-active' : 'text-gray-700 hover:text-orange-construction' }}">
                                    Contact
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 lg:gap-4">
                            <div class="flex items-center gap-2 lg:gap-3 xl:gap-6">
                                @auth
                                    <a href="{{ route('dashboard') }}" class="text-[13px] lg:text-sm font-semibold text-gray-600 hover:text-orange-construction transition-colors whitespace-nowrap">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-[13px] lg:text-sm font-semibold text-gray-600 hover:text-orange-construction transition-colors whitespace-nowrap">Sign In</a>
                                @endauth
                                <div class="hidden md:flex">
                                    <a href="{{ $content['header_cta_link'] ?? route('contact') }}" class="inline-flex items-center px-3 lg:px-4 xl:px-6 py-2 xl:py-3 text-[13px] lg:text-[14px] xl:text-[15px] font-bold text-white transition-all bg-orange-construction rounded-full hover:bg-orange-600 shadow-md shadow-orange-500/20 whitespace-nowrap">
                                        {{ $content['header_cta_text'] ?? 'Request a Quote' }}
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Mobile Menu Toggle -->
                            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile Navigation Overlay -->
                <div x-show="mobileMenuOpen" 
                     @click.away="mobileMenuOpen = false"
                     x-transition:enter="transition ease-out duration-200" 
                     x-transition:enter-start="opacity-0 -translate-y-4" 
                     x-transition:enter-end="opacity-100 translate-y-0" 
                     x-transition:leave="transition ease-in duration-150" 
                     x-transition:leave-start="opacity-100 translate-y-0" 
                     x-transition:leave-end="opacity-0 -translate-y-4" 
                     x-cloak
                     class="md:hidden absolute top-full left-0 w-full bg-white shadow-xl border-t border-gray-100 z-[101]">
                    <div class="px-4 py-6 space-y-1">
                        <a href="{{ route('home') }}" class="block px-4 py-3 text-base font-bold {{ request()->routeIs('home') ? 'text-orange-construction' : 'text-gray-700' }} hover:text-orange-construction hover:bg-orange-50 rounded-xl transition-all">
                            Home
                        </a>
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-base font-bold text-gray-700 hover:text-orange-construction hover:bg-orange-50 rounded-xl transition-all">
                                Services
                                <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" class="pl-8 space-y-1" x-cloak>
                                <a href="{{ route('services') }}" class="block px-4 py-2 text-sm font-semibold text-gray-600 hover:text-orange-construction">All Services</a>
                                <a href="{{ route('services.residential') }}" class="block px-4 py-2 text-sm font-semibold text-gray-600 hover:text-orange-construction">Residential Construction</a>
                                <a href="{{ route('services.commercial') }}" class="block px-4 py-2 text-sm font-semibold text-gray-600 hover:text-orange-construction">Commercial Development</a>
                                <a href="{{ route('services.industrial') }}" class="block px-4 py-2 text-sm font-semibold text-gray-600 hover:text-orange-construction">Industrial Infrastructure</a>
                                <a href="{{ route('services.interior') }}" class="block px-4 py-2 text-sm font-semibold text-gray-600 hover:text-orange-construction">Custom Interior Design</a>
                                <a href="{{ route('services.sustainable') }}" class="block px-4 py-2 text-sm font-semibold text-gray-600 hover:text-orange-construction">Sustainable Building</a>
                                <a href="{{ route('services.management') }}" class="block px-4 py-2 text-sm font-semibold text-gray-600 hover:text-orange-construction">Project Management</a>
                            </div>
                        </div>
                        <a href="{{ route('projects') }}" class="block px-4 py-3 text-base font-bold text-gray-700 hover:text-orange-construction hover:bg-orange-50 rounded-xl transition-all">
                            Projects
                        </a>
                        <a href="{{ route('blogs.index') }}" class="block px-4 py-3 text-base font-bold text-gray-700 hover:text-orange-construction hover:bg-orange-50 rounded-xl transition-all">
                            Blog
                        </a>
                        <a href="{{ route('faq') }}" class="block px-4 py-3 text-base font-bold text-gray-700 hover:text-orange-construction hover:bg-orange-50 rounded-xl transition-all">
                            FAQ
                        </a>
                        <div class="px-4 py-2">
                            <a href="{{ route('public.invest') }}" class="web3-glass w-full">
                                <div class="web3-glass-content py-4 justify-center">
                                    <div class="relative w-2 h-2 rounded-full bg-orange-construction animate-pulse"></div>
                                    Invest
                                </div>
                            </a>
                        </div>
                        <div x-data="{ open: {{ request()->routeIs('about') || request()->routeIs('team') || request()->routeIs('testimonials') ? 'true' : 'false' }} }">
                            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-base font-bold {{ request()->routeIs('about') || request()->routeIs('team') || request()->routeIs('testimonials') ? 'text-orange-construction bg-orange-50' : 'text-gray-700 hover:text-orange-construction hover:bg-orange-50' }} rounded-xl transition-all">
                                Pages
                                <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" class="pl-8 space-y-1" x-cloak>
                                <a href="{{ route('about') }}" class="block px-4 py-2 text-sm font-semibold {{ request()->routeIs('about') ? 'text-orange-construction' : 'text-gray-600 hover:text-orange-construction' }}">About Us</a>
                                <a href="{{ route('team') }}" class="block px-4 py-2 text-sm font-semibold {{ request()->routeIs('team') ? 'text-orange-construction' : 'text-gray-600 hover:text-orange-construction' }}">Team</a>
                                <a href="{{ route('testimonials') }}" class="block px-4 py-2 text-sm font-semibold {{ request()->routeIs('testimonials') ? 'text-orange-construction' : 'text-gray-600 hover:text-orange-construction' }}">Testimonials</a>
                            </div>
                        </div>
                        <a href="{{ route('contact') }}" class="block px-4 py-3 text-base font-bold text-gray-700 hover:text-orange-construction hover:bg-orange-50 rounded-xl transition-all">
                            Contact Us
                        </a>
                        
                        <div class="pt-4 mt-4 border-t border-gray-100 px-4 flex flex-col gap-3">
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-center py-3 text-gray-600 font-bold hover:bg-gray-50 rounded-xl">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-center py-3 text-gray-600 font-bold hover:bg-gray-50 rounded-xl">Sign In</a>
                            @endauth
                            <a href="{{ $content['header_cta_link'] ?? route('contact') }}" class="block w-full text-center py-4 bg-orange-construction text-white font-bold rounded-xl shadow-lg shadow-orange-500/10">
                                {{ $content['header_cta_text'] ?? 'Request a Quote' }}
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="flex-grow">
                @yield('content')
            </main>

            <!-- The Footer -->
            <footer class="bg-slate-950 text-slate-400 pt-24 pb-12 border-t border-slate-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-24">
                        <!-- Column 1 (Branding) -->
                        <div class="space-y-8">
                            <a href="{{ route('home') }}" class="flex items-center gap-3">
                                @if(isset($content['header_logo_url']) && $content['header_logo_url'])
                                    <img src="{{ $content['header_logo_url'] }}" alt="{{ $content['site_name'] ?? 'Atom Forge' }} Logo" class="h-16 w-auto brightness-0 invert">
                                @else
                                    <img src="{{ asset('images/Atom Forge Logo.png For White Background.png') }}" alt="Atom Forge Logo" class="h-16 w-auto brightness-0 invert">
                                @endif
                                <div class="flex flex-col justify-center -space-y-1">
                                    <span class="font-bold text-2xl text-white tracking-tight leading-tight">
                                        {{ $content['site_name'] ?? 'Atom Forge' }}
                                    </span>
                                    <span class="font-bold text-xs text-orange-construction tracking-[0.3em] uppercase leading-tight">
                                        Construction
                                    </span>
                                </div>
                            </a>
                            <p class="leading-relaxed text-[15px]">
                                {{ $content['footer_description'] ?? "Atom Forge Construction is focused on delivering high-quality, durable, and innovative building solutions. We combine modern engineering and precision craftsmanship to turn ideas into solid structures." }}
                            </p>
                        </div>
                        
                        <!-- Column 2 (Address) -->
                        <div>
                            <h3 class="text-white text-lg font-bold uppercase tracking-wider mb-8">ADDRESS</h3>
                            <ul class="space-y-6 text-[15px]">
                                <li class="flex items-start gap-4">
                                    <i class="fa-solid fa-location-dot text-orange-construction mt-1 text-lg"></i>
                                    <a href="https://www.google.com/maps/place/Atom+Forge+Construction/@26.732891,83.3862048,164m/data=!3m1!1e3!4m22!1m15!4m14!1m6!1m2!1s0x399143be04f92235:0x5bd0ddd9ec36db2a!2sAtom+Forge+Construction,+HIG+II,+Gautam+Vihar+Vistar,+Taramandal,+Gorakhpur,+Uttar+Pradesh+273014!2m2!1d83.3862029!2d26.7327535!1m6!1m2!1s0x399143be04f92235:0x5bd0ddd9ec36db2a!2sAtom+Forge+Construction,+HIG+II,+Gautam+Vihar+Vistar,+Taramandal,+Gorakhpur,+Uttar+Pradesh+273014!2m2!1d83.3862029!2d26.7327535!3m5!1s0x399143be04f92235:0x5bd0ddd9ec36db2a!8m2!3d26.7327535!4d83.3862029!16s%2Fg%2F11yrsbgfwj" target="_blank" class="hover:text-orange-construction transition-colors">
                                        {{ $content['contact_address'] ?? 'HIG II, Gautam Vihar Vistar, Taramandal, Gorakhpur, Uttar Pradesh 273014' }}
                                    </a>
                                </li>
                                <li class="flex items-center gap-4">
                                    <i class="fa-solid fa-phone text-orange-construction text-lg"></i>
                                    <span>{{ $content['contact_phone'] ?? '+91 8318754257' }}</span>
                                </li>
                                <li class="flex items-center gap-4">
                                    <i class="fa-brands fa-whatsapp text-orange-construction text-lg"></i>
                                    <a href="https://wa.me/918318754257" target="_blank" class="hover:text-orange-construction transition-colors">+91 8318754257</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Column 3 (Newsletter & Social) -->
                        <div>
                            <h3 class="text-white text-lg font-bold uppercase tracking-wider mb-8">NEWSLETTER</h3>
                            <form action="#" class="relative mb-10">
                                <input type="email" placeholder="Your Email" class="w-full bg-slate-900 border border-slate-800 rounded-full px-6 py-4 text-sm text-white focus:ring-2 focus:ring-orange-construction/20 focus:border-orange-construction transition-all outline-none pr-16">
                                <button class="absolute right-2 top-2 bottom-2 w-12 bg-orange-construction text-white rounded-full flex items-center justify-center hover:bg-orange-600 transition-colors shadow-lg shadow-orange-500/20">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </form>
                            
                            <div class="space-y-6">
                                <p class="text-sm font-bold text-white uppercase tracking-widest">We're social, connect with us</p>
                                <div class="flex gap-4">
                                    <a href="#" class="w-10 h-10 bg-slate-900 border border-slate-800 rounded-full flex items-center justify-center hover:bg-orange-construction hover:border-orange-construction hover:text-white transition-all duration-300">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="w-10 h-10 bg-slate-900 border border-slate-800 rounded-full flex items-center justify-center hover:bg-orange-construction hover:border-orange-construction hover:text-white transition-all duration-300">
                                        <i class="fa-brands fa-google-plus-g"></i>
                                    </a>
                                    <a href="#" class="w-10 h-10 bg-slate-900 border border-slate-800 rounded-full flex items-center justify-center hover:bg-orange-construction hover:border-orange-construction hover:text-white transition-all duration-300">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                    <a href="#" class="w-10 h-10 bg-slate-900 border border-slate-800 rounded-full flex items-center justify-center hover:bg-orange-construction hover:border-orange-construction hover:text-white transition-all duration-300">
                                        <i class="fa-brands fa-linkedin-in"></i>
                                    </a>
                                    <a href="#" class="w-10 h-10 bg-slate-900 border border-slate-800 rounded-full flex items-center justify-center hover:bg-orange-construction hover:border-orange-construction hover:text-white transition-all duration-300">
                                        <i class="fa-brands fa-dribbble"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-20 pt-8 border-t border-slate-900 flex flex-col md:flex-row justify-center items-center gap-4 text-xs font-bold uppercase tracking-widest text-slate-500">
                        <p>{{ $content['copyright_text'] ?? '© Atom Forge Construction. All rights reserved.' }} Designed & Developed by <a href="https://raitechcorporation.com/" target="_blank" class="text-orange-construction">Rai Tech Corporation</a></p>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Floating Quick Call Button -->
        <a href="tel:+918318754257" class="fixed bottom-40 right-8 z-[100] bg-[#EE5A24] text-white w-14 h-14 rounded-full shadow-2xl hover:bg-orange-600 transition-all transform hover:scale-110 flex items-center justify-center group" title="Call Us Now">
            <i class="fa-solid fa-phone text-xl"></i>
            <span class="absolute right-full mr-4 bg-slate-900 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Call Us Now</span>
        </a>

        <!-- Floating WhatsApp Support -->
        <a href="https://wa.me/918318754257" target="_blank" class="fixed bottom-24 right-8 z-[100] bg-emerald-500 text-white w-14 h-14 rounded-full shadow-2xl hover:bg-emerald-600 transition-all transform hover:scale-110 flex items-center justify-center group" title="Chat with us on WhatsApp">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.29-4.143c1.589.943 3.147 1.44 4.744 1.441 5.401 0 9.798-4.396 9.802-9.797 0-2.618-1.02-5.08-2.871-6.932-1.85-1.852-4.311-2.873-6.93-2.873-5.401 0-9.798 4.397-9.802 9.799 0 1.9.54 3.42 1.581 4.966l-.1.173-1.013 3.7.126.033 3.663-.957zm11.532-6.536c-.234-.117-1.385-.683-1.599-.761-.215-.078-.371-.117-.527.117-.156.234-.605.761-.742.918-.137.156-.273.176-.508.059-.234-.117-.988-.364-1.882-1.161-.695-.62-1.165-1.385-1.301-1.619-.137-.234-.015-.361.103-.477.106-.105.234-.273.351-.41.117-.137.156-.234.234-.391.078-.156.039-.293-.019-.41-.059-.117-.527-1.27-.723-1.738-.191-.462-.387-.399-.527-.406-.136-.007-.293-.009-.449-.009-.156 0-.41.059-.625.293-.215.234-.82.801-.82 1.953s.84 2.266.957 2.422c.117.156 1.653 2.523 4.004 3.538.559.241.996.386 1.337.494.56.178 1.069.153 1.472.093.449-.066 1.385-.566 1.581-1.113.195-.547.195-1.016.137-1.113-.058-.097-.214-.156-.448-.273z"></path>
            </svg>
            <span class="absolute right-full mr-4 bg-slate-900 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">WhatsApp Support</span>
        </a>

        @stack('scripts')
    </body>
</html>
