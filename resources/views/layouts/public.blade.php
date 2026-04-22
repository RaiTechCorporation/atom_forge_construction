<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Atom Forge Construction') }} | Excellence in Building</title>

        <!-- Fonts: Inter for both body and headings for clean SaaS feel -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/js/app.jsx'])
        
        <style>
            [x-cloak] { display: none !important; }
            body { font-family: 'Inter', sans-serif; letter-spacing: -0.01em; }
            .glass { 
                background: rgba(255, 255, 255, 0.7); 
                backdrop-filter: blur(12px) saturate(180%); 
                -webkit-backdrop-filter: blur(12px) saturate(180%);
                border-bottom: 1px solid rgba(255, 255, 255, 0.3); 
            }
            .bg-grid-slate-100 {
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32' fill='none' stroke='rgb(241 245 249 / 0.5)'%3E%3Cpath d='M0 .5H31.5V32'/%3E%3C/svg%3E");
            }
            .bg-dot-matrix {
                background-image: radial-gradient(circle, #cbd5e1 1px, transparent 1px);
                background-size: 24px 24px;
            }
            .text-gradient {
                background: linear-gradient(135deg, #0f172a 0%, #2563eb 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .nav-link-active {
                color: #2563eb;
                position: relative;
            }
            .nav-link-active::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 1rem;
                right: 1rem;
                height: 2px;
                background: #2563eb;
                border-radius: 99px;
            }
        </style>
    </head>
    <body class="antialiased text-slate-900 bg-white selection:bg-blue-600 selection:text-white" x-data="{ mobileMenuOpen: false }">
        <div class="min-h-screen flex flex-col">
            <!-- Refined Top Bar -->
            <div class="bg-slate-50 text-slate-500 text-[12px] py-2.5 hidden lg:block border-b border-slate-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center font-medium">
                    <div class="flex space-x-8 items-center">
                        <span class="flex items-center gap-2 hover:text-slate-900 transition-colors cursor-default">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $content['topbar_address'] ?? $content['contact_address'] ?? '3584 Hickory Heights Drive, USA' }}
                        </span>
                        <span class="flex items-center gap-2 hover:text-slate-900 transition-colors cursor-default">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            {{ $content['topbar_phone'] ?? $content['contact_phone'] ?? '+1 (555) 000-0000' }}
                        </span>
                    </div>
                    <div class="flex space-x-5 items-center">
                        <a href="{{ $content['header_facebook'] ?? $content['social_facebook'] ?? '#' }}" class="hover:text-blue-600 transition-colors">Facebook</a>
                        <a href="{{ $content['header_twitter'] ?? $content['social_twitter'] ?? '#' }}" class="hover:text-blue-600 transition-colors">Twitter</a>
                        <a href="{{ $content['header_linkedin'] ?? $content['social_linkedin'] ?? '#' }}" class="hover:text-blue-600 transition-colors">LinkedIn</a>
                    </div>
                </div>
            </div>

            <!-- Modern Clean Navigation -->
            <nav class="glass sticky top-0 z-[100] transition-all duration-300">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-20">
                        <div class="flex items-center">
                            <!-- Minimalist Logo -->
                            <a href="{{ route('home') }}" class="group flex items-center gap-2.5">
                                @if($content['header_logo_url'] ?? null)
                                    <img src="{{ $content['header_logo_url'] }}" 
                                         alt="{{ $content['site_name'] ?? 'Atom Forge' }}" 
                                         style="height: {{ $content['header_logo_height'] ?? '40' }}px"
                                         class="w-auto transition-transform duration-300">
                                @else
                                    <x-application-logo class="w-10 h-10 transition-transform duration-300" />
                                @endif
                                <span class="font-bold text-xl text-blue-600 tracking-tight">
                                    {{ $content['site_name'] ?? 'Atom Forge' }}
                                </span>
                            </a>

                            <!-- Desktop Navigation Links -->
                            <div class="hidden md:flex lg:ml-12 lg:space-x-1">
                                @php
                                    $navLinks = [
                                        ['name' => 'Home', 'route' => 'home'],
                                        ['name' => 'Services', 'route' => 'services'],
                                        ['name' => 'Projects', 'route' => 'projects'],
                                        ['name' => 'Invest', 'route' => 'public.invest'],
                                        ['name' => 'About', 'route' => 'about'],
                                        ['name' => 'Contact', 'route' => 'contact'],
                                    ];
                                @endphp
                                @foreach($navLinks as $link)
                                <a href="{{ route($link['route']) }}" class="px-4 py-2 text-[14px] font-medium transition-all duration-200 {{ request()->routeIs($link['route']) ? 'nav-link-active' : 'text-slate-600 hover:text-slate-900' }}">
                                    {{ $link['name'] }}
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="hidden md:flex items-center gap-6">
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors">Sign In</a>
                                <a href="{{ $content['header_cta_link'] ?? route('contact') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white transition-all bg-blue-600 rounded-full hover:bg-blue-700 shadow-sm shadow-blue-500/20">
                                    {{ $content['header_cta_text'] ?? 'Request Quote' }}
                                </a>
                            </div>
                            
                            <!-- Mobile Menu Toggle -->
                            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-50 transition-colors">
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
                     class="md:hidden absolute top-full left-0 w-full bg-white shadow-xl border-t border-slate-100 z-[101]">
                    <div class="px-4 py-6 space-y-1">
                        @foreach($navLinks as $link)
                        <a href="{{ route($link['route']) }}" class="block px-4 py-3 text-base font-semibold text-slate-700 hover:text-blue-600 hover:bg-slate-50 rounded-xl transition-all">
                            {{ $link['name'] }}
                        </a>
                        @endforeach
                        <div class="pt-4 mt-4 border-t border-slate-100 px-4 flex flex-col gap-3">
                            <a href="{{ route('login') }}" class="text-center py-3 text-slate-600 font-semibold hover:bg-slate-50 rounded-xl">Sign In</a>
                            <a href="{{ $content['header_cta_link'] ?? route('contact') }}" class="block w-full text-center py-3.5 bg-blue-600 text-white font-bold rounded-xl shadow-md shadow-blue-500/10">
                                {{ $content['header_cta_text'] ?? 'Request Quote' }}
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="flex-grow">
                @yield('content')
            </main>

            <!-- Clean Modern Footer -->
            <footer class="bg-white text-slate-600 pt-24 pb-12 border-t border-slate-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-24">
                        <div class="space-y-6">
                            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                                @if($content['header_logo_url'] ?? null)
                                    <img src="{{ $content['header_logo_url'] }}" 
                                         alt="{{ $content['site_name'] ?? 'Atom Forge' }}" 
                                         style="height: {{ ($content['header_logo_height'] ?? 40) * 0.8 }}px"
                                         class="w-auto">
                                @else
                                    <x-application-logo class="w-8 h-8" />
                                @endif
                                <span class="font-bold text-lg text-blue-600 tracking-tight">
                                    {{ $content['site_name'] ?? 'Atom Forge' }}
                                </span>
                            </a>
                            <p class="leading-relaxed text-[15px] text-slate-500">{{ $content['footer_description'] ?? "Excellence in construction and architectural design. We build tomorrow's infrastructure with today's precision." }}</p>
                            <div class="flex space-x-5">
                                @if($content['social_facebook'] ?? null)
                                <a href="{{ $content['social_facebook'] }}" class="text-slate-400 hover:text-blue-600 transition-colors">
                                    <span class="text-xs font-bold uppercase tracking-wider">Facebook</span>
                                </a>
                                @endif
                                @if($content['social_twitter'] ?? null)
                                <a href="{{ $content['social_twitter'] }}" class="text-slate-400 hover:text-blue-600 transition-colors">
                                    <span class="text-xs font-bold uppercase tracking-wider">Twitter</span>
                                </a>
                                @endif
                                @if($content['social_linkedin'] ?? null)
                                <a href="{{ $content['social_linkedin'] }}" class="text-slate-400 hover:text-blue-600 transition-colors">
                                    <span class="text-xs font-bold uppercase tracking-wider">LinkedIn</span>
                                </a>
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-slate-900 text-sm font-bold uppercase tracking-wider mb-6">Company</h3>
                            <ul class="space-y-4 text-[15px]">
                                @foreach($navLinks as $link)
                                <li><a href="{{ route($link['route']) }}" class="hover:text-blue-600 transition-colors">{{ $link['name'] }}</a></li>
                                @endforeach
                                <li><a href="{{ route('faq') }}" class="hover:text-blue-600 transition-colors">FAQ</a></li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-slate-900 text-sm font-bold uppercase tracking-wider mb-6">Contact</h3>
                            <ul class="space-y-4 text-[15px]">
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>{{ $content['contact_address'] ?? '3584 Hickory Heights Drive, USA' }}</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1.01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    <span>{{ $content['contact_phone'] ?? '+1 (555) 000-0000' }}</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span>{{ $content['contact_email'] ?? 'info@atomforge.com' }}</span>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-slate-900 text-sm font-bold uppercase tracking-wider mb-6">Newsletter</h3>
                            <p class="mb-5 text-[15px] text-slate-500">Subscribe for project updates and insights.</p>
                            <form action="#" class="flex gap-2">
                                <input type="email" placeholder="Email" class="flex-grow bg-slate-50 border border-slate-200 rounded-lg px-3.5 py-2 text-sm focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all outline-none">
                                <button class="px-4 py-2 bg-slate-900 text-white text-sm font-bold rounded-lg hover:bg-slate-800 transition-colors">Join</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="mt-20 pt-8 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4 text-[13px] font-medium text-slate-400">
                        <p>&copy; {{ date('Y') }} {{ $content['copyright_text'] ?? 'Atom Forge Construction. All rights reserved.' }}</p>
                        <div class="flex space-x-6">
                            <a href="{{ route('privacy') }}" class="hover:text-slate-600 transition-colors">Privacy</a>
                            <a href="{{ route('terms') }}" class="hover:text-slate-600 transition-colors">Terms</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
