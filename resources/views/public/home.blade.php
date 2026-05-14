@extends('layouts.public')

@section('content')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <style>
        .hero-swiper {
            width: 100%;
            height: 85vh;
            min-height: 600px;
        }
        .swiper-slide {
            position: relative;
            overflow: hidden;
        }
        .slide-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform 10s ease-out;
            z-index: 1;
        }
        .swiper-slide-active .slide-bg {
            transform: scale(1.1);
        }
        .slide-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.2) 100%);
            z-index: 2;
        }
        /* Industrial double-exposure effect overlay */
        .slide-exposure {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=60&w=1920');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            mix-blend-mode: overlay;
            z-index: 3;
        }
        .slide-content {
            position: relative;
            z-index: 10;
            height: 100%;
            display: flex;
            align-items: center;
        }
        .btn-pill {
            border-radius: 9999px;
            transition: all 0.3s ease;
        }
        .btn-pill:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(238, 90, 36, 0.3);
        }
        /* Custom Swiper Pagination */
        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: #fff;
            opacity: 0.5;
        }
        .swiper-pagination-bullet-active {
            opacity: 1;
            background: #EE5A24;
            width: 30px;
            border-radius: 6px;
        }
        /* Custom Swiper Navigation */
        .swiper-button-next, .swiper-button-prev {
            color: #fff;
            background: rgba(0,0,0,0.2);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        .swiper-button-next:after, .swiper-button-prev:after {
            font-size: 20px;
            font-weight: bold;
        }
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background: #EE5A24;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-up {
            opacity: 0;
        }
        .reveal {
            animation: fadeInUp 0.8s ease forwards;
        }
        .swiper-slide-active .animate-fade-up {
            animation: fadeInUp 0.8s ease forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; }
        .delay-700 { animation-delay: 0.7s; }
    </style>

    @php
        $slides = [
            [
                'subtitle' => $content['hero_slide_1_subtitle'] ?? 'PRECISE CREATED ONLY FOR YOU',
                'title_dark' => $content['hero_slide_1_title_dark'] ?? 'Building',
                'title_orange' => $content['hero_slide_1_title_orange'] ?? 'Strength',
                'description' => $content['hero_slide_1_description'] ?? 'We deliver reliable, innovative, and high-quality construction solutions designed to stand the test of time.',
                'image' => $content['hero_slide_1_image'] ?? 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=1920',
            ],
            [
                'subtitle' => $content['hero_slide_2_subtitle'] ?? 'PRECISE CREATED ONLY FOR YOU',
                'title_dark' => $content['hero_slide_2_title_dark'] ?? 'Shaping',
                'title_orange' => $content['hero_slide_2_title_orange'] ?? 'The Future',
                'description' => $content['hero_slide_2_description'] ?? "At Atom Forge Construction, we don't just build structures—we engineer the future with precision and passion.",
                'image' => $content['hero_slide_2_image'] ?? 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=1920',
            ],
            [
                'subtitle' => $content['hero_slide_3_subtitle'] ?? 'PRECISE CREATED ONLY FOR YOU',
                'title_dark' => $content['hero_slide_3_title_dark'] ?? 'Modern',
                'title_orange' => $content['hero_slide_3_title_orange'] ?? 'Engineering',
                'description' => $content['hero_slide_3_description'] ?? 'Combining cutting-edge technology with precision craftsmanship for superior building solutions.',
                'image' => $content['hero_slide_3_image'] ?? 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1920',
            ],
        ];
    @endphp

    <!-- Hero Slider Section -->
    <section class="relative overflow-hidden bg-black">
        <div class="swiper hero-swiper">
            <div class="swiper-wrapper">
                @foreach($slides as $slide)
                <div class="swiper-slide">
                    <div class="slide-bg" style="background-image: url('{{ $slide['image'] }}')"></div>
                    <div class="slide-overlay"></div>
                    <div class="slide-exposure"></div>
                    
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 slide-content">
                        <div class="max-w-3xl">
                            <span class="inline-block text-white font-bold tracking-[0.2em] text-sm mb-6 animate-fade-up">{{ $slide['subtitle'] }}</span>
                            <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white mb-8 leading-tight animate-fade-up delay-100">
                                <span class="text-white">{{ $slide['title_dark'] }}</span><br>
                                <span class="text-orange-primary">{{ $slide['title_orange'] }}</span>
                            </h1>
                            <p class="text-lg md:text-xl text-white mb-10 max-w-xl animate-fade-up delay-200">
                                {{ $slide['description'] }}
                            </p>
                            <div class="animate-fade-up delay-300">
                                <a href="{{ route('projects') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-orange-primary text-white font-bold btn-pill">
                                    EXPLORE MORE
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            
            <!-- Add Navigation -->
            <div class="swiper-button-next hidden md:flex"></div>
            <div class="swiper-button-prev hidden md:flex"></div>
        </div>
    </section>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.hero-swiper', {
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });

            const projectsSwiper = new Swiper('.projects-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                navigation: {
                    nextEl: '.projects-next',
                    prevEl: '.projects-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                    1280: {
                        slidesPerView: 4,
                    },
                },
            });

            const testimonialsSwiper = new Swiper('.testimonials-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.testimonials-pagination',
                    clickable: true,
                },
            });
        });
    </script>

    <!-- Dynamic Home Sections -->
    @php
        $cardSections = $homeSections->whereNotNull('icon');
        $rowSections = $homeSections->whereNull('icon');
    @endphp

    @if($cardSections->count() > 0)
    <section class="relative z-20 -mt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($cardSections as $section)
                <div class="bg-white p-12 shadow-xl hover:shadow-2xl rounded-2xl group hover:bg-orange-primary transition-all duration-500 relative animate-fade-up reveal hover:-translate-y-2 border border-gray-50 flex flex-col items-start overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 opacity-[0.03] group-hover:opacity-10 transition-opacity duration-500">
                         <i class="fa-solid fa-{{ $section->icon }} text-[12rem] text-black group-hover:text-white"></i>
                    </div>

                    <div class="mb-8 p-4 bg-orange-50 group-hover:bg-white/10 rounded-2xl transition-colors duration-500">
                        <i class="fa-solid fa-{{ $section->icon }} text-3xl text-orange-primary group-hover:text-white transition-colors duration-500"></i>
                    </div>

                    <div class="space-y-2 mb-12">
                        <h4 class="text-orange-primary group-hover:text-white/80 font-bold uppercase tracking-[0.2em] text-[10px] transition-colors duration-300">
                            {{ $section->subtitle }}
                        </h4>
                        <h3 class="text-2xl font-black text-slate-900 group-hover:text-white leading-tight transition-colors duration-300">
                            {{ $section->title }}
                        </h3>
                    </div>
                    
                    @if($section->button_url)
                    <a href="{{ $section->button_url }}" class="w-12 h-12 bg-slate-900 group-hover:bg-white flex items-center justify-center transition-all duration-300 transform group-hover:rotate-45 shadow-lg rounded-xl mt-auto">
                        <svg class="w-6 h-6 text-white group-hover:text-orange-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @foreach($rowSections as $section)
    <section class="py-24 bg-white overflow-hidden border-b border-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                @if($loop->index % 2 != 0)
                <div class="relative animate-fade-up reveal">
                    <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl group">
                        @if($section->image)
                            <img src="{{ $section->image }}" alt="{{ $section->title }}" class="w-full h-auto transition-transform duration-700 group-hover:scale-105">
                        @endif
                    </div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-orange-primary/10 rounded-2xl -z-0"></div>
                    <div class="absolute -top-6 -right-6 w-32 h-32 border-4 border-orange-primary/5 rounded-2xl -z-0"></div>
                </div>
                @endif

                <div class="@if($loop->index % 2 != 0) lg:pl-12 @else lg:pr-12 @endif animate-fade-up reveal delay-200">
                    @if($section->subtitle)
                        <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">{{ $section->subtitle }}</span>
                    @endif
                    
                    @if($section->title)
                        <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-8 leading-tight">{{ $section->title }}</h2>
                    @endif
                    
                    @if($section->description)
                        <div class="space-y-6 text-slate-500 font-medium text-lg leading-relaxed mb-10">
                            {!! nl2br(e($section->description)) !!}
                        </div>
                    @endif

                    @if($section->button_text && $section->button_url)
                        <a href="{{ $section->button_url }}" class="inline-flex items-center gap-3 px-10 py-4 bg-orange-primary text-white font-bold rounded-full hover:bg-orange-600 transition-all shadow-lg shadow-orange-500/30 group">
                            {{ $section->button_text }}
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    @endif
                </div>

                @if($loop->index % 2 == 0)
                <div class="relative animate-fade-up reveal">
                    <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl group">
                        @if($section->image)
                            <img src="{{ $section->image }}" alt="{{ $section->title }}" class="w-full h-auto transition-transform duration-700 group-hover:scale-105">
                        @endif
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-orange-primary/10 rounded-2xl -z-0"></div>
                    <div class="absolute -top-6 -left-6 w-32 h-32 border-4 border-orange-primary/5 rounded-2xl -z-0"></div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endforeach

    <!-- Statistical / Milestone Section -->
    <section class="py-24 bg-orange-primary relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 L100 0 L100 100 Z"></path>
            </svg>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-white leading-tight">
                    We are always with you to make your project.
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Winning Awards -->
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-black text-white mb-4">{{ $content['stat_1_value'] ?? '10' }}</div>
                    <div class="text-orange-100 font-bold uppercase tracking-widest text-sm">{{ $content['stat_1_label'] ?? 'Winning Awards' }}</div>
                </div>

                <!-- Satisfied Clients -->
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-black text-white mb-4">{{ $content['stat_2_value'] ?? '1230' }}</div>
                    <div class="text-orange-100 font-bold uppercase tracking-widest text-sm">{{ $content['stat_2_label'] ?? 'Satisfied Clients' }}</div>
                </div>

                <!-- Best Projects -->
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-black text-white mb-4">{{ $content['stat_3_value'] ?? '360' }}</div>
                    <div class="text-orange-100 font-bold uppercase tracking-widest text-sm">{{ $content['stat_3_label'] ?? 'Best Projects' }}</div>
                </div>

                <!-- Years Served -->
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-black text-white mb-4">{{ $content['stat_4_value'] ?? '15+' }}</div>
                    <div class="text-orange-100 font-bold uppercase tracking-widest text-sm">{{ $content['stat_4_label'] ?? 'Years Served' }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Services Grid -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">{{ $content['services_section_tagline'] ?? 'THE BEST SERVICES' }}</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-6">{{ $content['services_section_title'] ?? 'Innovative Building Solutions' }}</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">{{ $content['services_section_subtitle'] ?? 'We combine modern engineering, precision craftsmanship, and reliable project management to turn ideas into solid structures, from residential projects to large-scale commercial developments.' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $bestServices = [
                        ['title' => 'Residential Construction', 'description' => 'From custom villas to modern apartments, we deliver high-quality residential spaces built with precision.', 'link' => route('services.residential')],
                        ['title' => 'Commercial Development', 'description' => 'Large-scale commercial projects that combine modern engineering with efficient execution.', 'link' => route('services.commercial')],
                        ['title' => 'Industrial Infrastructure', 'description' => 'Delivering durable and scalable infrastructure solutions for industrial growth and performance.', 'link' => route('services.industrial')],
                        ['title' => 'Custom Interior Design', 'description' => 'Turning concepts into reality with skilled expertise and a relentless focus on aesthetic quality.', 'link' => route('services.interior')],
                        ['title' => 'Sustainable Building', 'description' => 'Eco-friendly construction practices and smart planning for structures that are built to last.', 'link' => route('services.sustainable')],
                        ['title' => 'Project Management', 'description' => 'Reliable end-to-end management ensuring timely delivery and commitment to excellence.', 'link' => route('services.management')],
                    ];
                @endphp

                @foreach($bestServices as $service)
                <a href="{{ $service['link'] }}" class="p-8 border border-gray-100 rounded-xl hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group block">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 bg-orange-primary/10 rounded-lg flex items-center justify-center text-orange-primary group-hover:bg-orange-primary group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">{{ $service['title'] }}</h3>
                    </div>
                    <p class="text-slate-500 line-clamp-2">{{ $service['description'] }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Latest Projects (Case Studies) Section -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-16">
                <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">{{ $content['projects_section_tagline'] ?? 'CASE STUDIES' }}</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight">{{ $content['projects_section_title'] ?? 'Latest Projects' }}</h2>
            </div>

            <div class="relative">
                <div class="swiper projects-swiper !overflow-visible">
                    <div class="swiper-wrapper">
                        @php
                            $projects = [];
                            for ($i = 1; $i <= 5; $i++) {
                                if (isset($content["project_{$i}_name"])) {
                                    $projects[] = [
                                        'name' => $content["project_{$i}_name"],
                                        'image' => $content["project_{$i}_image"] ?? 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=800'
                                    ];
                                }
                            }
                            
                            // Fallback if no projects defined in CMS
                            if (empty($projects)) {
                                $projects = [
                                    ['name' => 'Building Construction', 'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=800'],
                                    ['name' => 'Interior Design', 'image' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=800'],
                                    ['name' => 'Bridge Engineering', 'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=800'],
                                    ['name' => 'Urban Planning', 'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=800'],
                                    ['name' => 'Modern Architecture', 'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=800'],
                                ];
                            }
                        @endphp

                        @foreach($projects as $project)
                        <div class="swiper-slide">
                            <div class="group relative overflow-hidden aspect-[3/4] shadow-lg">
                                <img src="{{ $project['image'] }}" alt="{{ $project['name'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                                    <span class="text-orange-primary font-medium italic mb-1">Latest project</span>
                                    <h3 class="text-2xl font-bold text-white mb-6">{{ $project['name'] }}</h3>
                                    
                                    <a href="#" class="w-12 h-12 bg-orange-primary flex items-center justify-center text-white transition-all duration-300 transform translate-y-4 group-hover:translate-y-0 hover:bg-white hover:text-orange-primary">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex gap-4 mt-12">
                    <button class="projects-prev w-12 h-12 border border-gray-200 flex items-center justify-center text-slate-900 hover:bg-orange-primary hover:text-white hover:border-orange-primary transition-all duration-300">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="projects-next w-12 h-12 border border-gray-200 flex items-center justify-center text-slate-900 hover:bg-orange-primary hover:text-white hover:border-orange-primary transition-all duration-300">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Presentation Section -->
    <section class="relative py-32 bg-slate-900 overflow-hidden">
        <!-- Industrial Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ $content['video_section_bg_image'] ?? 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=1920' }}" alt="Industrial Background" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-slate-900/60"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-6">{{ $content['video_section_title'] ?? 'Our Video Presentation' }}</h2>
            <p class="text-slate-300 max-w-2xl mx-auto mb-12 text-lg">
                {{ $content['video_section_subtitle'] ?? 'Experience our commitment to excellence and innovation through our detailed project showcases and behind-the-scenes look at our construction process.' }}
            </p>

            <div class="flex justify-center">
                <a href="{{ $content['video_section_url'] ?? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ' }}" target="_blank" class="w-24 h-24 bg-orange-primary rounded-full flex items-center justify-center text-white text-3xl shadow-2xl shadow-orange-500/50 hover:scale-110 transition-transform duration-300 group">
                    <i class="fa-solid fa-play ml-1"></i>
                    
                    <!-- Pulsing effect -->
                    <span class="absolute inset-0 rounded-full bg-orange-primary animate-ping opacity-20"></span>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-24 bg-slate-900 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-primary/10 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-orange-primary/10 rounded-full -translate-x-1/2 translate-y-1/2 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-orange-primary font-bold uppercase tracking-widest text-xs mb-4 block">{{ $content['why_choose_tagline'] ?? 'Values' }}</span>
                <h2 class="text-4xl font-extrabold text-white mb-6 tracking-tight">{{ $content['why_choose_title'] ?? 'Why Choose Atom Forge?' }}</h2>
                <p class="text-slate-400 font-medium text-lg">{{ $content['why_choose_subtitle'] ?? 'At Atom Forge Construction, we don’t just build structures—we engineer the future. Leveraging cutting-edge technology, smart planning, and efficient execution, we deliver solutions that are built to last.' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-primary/20 text-orange-primary rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3 tracking-tight">Quality First</h4>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">No compromises on materials or construction standards.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-primary/20 text-orange-primary rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3 tracking-tight">On-Time Delivery</h4>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">Systematic project management to ensure we meet every deadline.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-primary/20 text-orange-primary rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3 tracking-tight">Expert Team</h4>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">Highly skilled engineers, architects, and master craftsmen.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-primary/20 text-orange-primary rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3 tracking-tight">Modern Tech</h4>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">Leveraging the latest in BIM and construction technology.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Plans & Pricing -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">{{ $content['plans_subtitle'] ?? 'Choose the best for yourself' }}</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-6">{{ $content['plans_tagline'] ?? 'Choose Plans & Pricing' }}</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $displayPlans = $plans->count() > 0 ? $plans->take(6) : collect();
                    // If less than 6 plans, we can either show only available or pad with placeholders.
                    // The prompt specifically asked for 6 cards.
                @endphp

                @for($i = 0; $i < 6; $i++)
                    @php
                        $plan = $displayPlans->get($i);
                        $planName = $plan ? $plan->name : "Plan " . ($i + 1);
                        $planPrice = $plan ? "₹" . number_format($plan->price_per_sqft) . " / Sq Ft" : "$76 / Month";
                        $features = $plan && $plan->features ? $plan->features : ["Service 1", "Service 2", "Service 3", "Service 4"];
                    @endphp
                    <div class="bg-white p-10 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">{{ $planName }}</h3>
                        <div class="mb-8">
                            <span class="text-4xl font-black text-slate-900">{{ $planPrice }}</span>
                        </div>
                        <ul class="space-y-4 mb-10 flex-grow">
                            @foreach(array_slice($features, 0, 4) as $feature)
                            <li class="flex items-center gap-3 text-slate-600 font-medium">
                                <svg class="w-5 h-5 text-orange-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('contact', ['plan' => $planName]) }}" class="block w-full text-center py-4 bg-orange-primary text-white font-bold rounded-xl hover:bg-orange-600 transition-all shadow-lg shadow-orange-500/20">
                            Select Plan
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Expert Team Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">OUR EXPERT</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight">Our team of experienced</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($teamMembers as $member)
                <div class="group">
                    <div class="relative overflow-hidden rounded-2xl mb-6 aspect-square shadow-lg">
                        <img src="{{ $member->image }}" alt="{{ $member->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        
                        <!-- Social Icons Overlay -->
                        <div class="absolute inset-x-0 bottom-0 p-6 translate-y-full group-hover:translate-y-0 transition-transform duration-500 bg-gradient-to-t from-orange-primary to-orange-primary/80">
                            <div class="flex justify-center gap-4 text-white">
                                @if($member->facebook) <a href="{{ $member->facebook }}" class="hover:text-slate-900 transition-colors"><i class="fa-brands fa-facebook-f"></i></a> @endif
                                @if($member->twitter) <a href="{{ $member->twitter }}" class="hover:text-slate-900 transition-colors"><i class="fa-brands fa-twitter"></i></a> @endif
                                @if($member->linkedin) <a href="{{ $member->linkedin }}" class="hover:text-slate-900 transition-colors"><i class="fa-brands fa-linkedin-in"></i></a> @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $member->name }}</h3>
                        <p class="text-orange-primary font-medium text-sm">{{ $member->designation }}</p>
                    </div>
                </div>
                @empty
                    @php
                        $fallbackTeam = [
                            ['name' => 'Ervin Kim', 'role' => 'CEO of Apple', 'image' => 'https://i.pravatar.cc/300?u=1'],
                            ['name' => 'Jane Doe', 'role' => 'Lead Architect', 'image' => 'https://i.pravatar.cc/300?u=2'],
                            ['name' => 'John Smith', 'role' => 'Civil Engineer', 'image' => 'https://i.pravatar.cc/300?u=3'],
                            ['name' => 'Sarah Wilson', 'role' => 'Project Manager', 'image' => 'https://i.pravatar.cc/300?u=4'],
                        ];
                    @endphp
                    @foreach($fallbackTeam as $member)
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl mb-6 aspect-square shadow-lg">
                            <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $member['name'] }}</h3>
                            <p class="text-orange-primary font-medium text-sm">{{ $member['role'] }}</p>
                        </div>
                    </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Testimonials (Customer Reviews) Section -->
    <section class="py-24 bg-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">Testimonial</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight">Customer Reviews</h2>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="swiper testimonials-swiper">
                    <div class="swiper-wrapper">
                        @forelse($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="text-center px-4">
                                <div class="mb-8 text-orange-primary/20">
                                    <svg class="w-20 h-20 mx-auto fill-current" viewBox="0 0 24 24">
                                        <path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C15.4647 8 15.017 8.44772 15.017 9V12C15.017 12.5523 14.5693 13 14.017 13H13.017V21H14.017ZM6.01708 21L6.01708 18C6.01708 16.8954 6.91251 16 8.01708 16H11.0171C11.5694 16 12.0171 15.5523 12.0171 15V9C12.0171 8.44772 11.5694 8 11.0171 8H8.01708C7.4648 8 7.01708 8.44772 7.01708 9V12C7.01708 12.5523 6.56937 13 6.01708 13H5.01708V21H6.01708Z" />
                                    </svg>
                                </div>
                                <blockquote class="text-2xl md:text-3xl font-medium text-slate-700 mb-10 leading-relaxed italic">
                                    "{{ $testimonial->quote }}"
                                </blockquote>
                                <div class="flex flex-col items-center">
                                    <h4 class="text-xl font-bold text-slate-900 mb-1">{{ $testimonial->author }}</h4>
                                    <p class="text-orange-primary font-medium">{{ $testimonial->location }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                            @php
                                $fallbackTestimonials = [
                                    [
                                        'quote' => 'That conviction is where the process of change really begins. The architecture of your life is built on the foundation of your choices.',
                                        'author' => 'Jhon Smith',
                                        'location' => 'CEO & Founder'
                                    ],
                                    [
                                        'quote' => 'Exceptional quality and professional service. They transformed our vision into reality with precision and care.',
                                        'author' => 'Sarah Johnson',
                                        'location' => 'Operations Director'
                                    ],
                                    [
                                        'quote' => 'Reliable, innovative, and dedicated. Atom Forge is truly a leader in the construction industry.',
                                        'author' => 'Michael Chen',
                                        'location' => 'Property Developer'
                                    ]
                                ];
                            @endphp

                            @foreach($fallbackTestimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="text-center px-4">
                                    <div class="mb-8 text-orange-primary/20">
                                        <svg class="w-20 h-20 mx-auto fill-current" viewBox="0 0 24 24">
                                            <path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C15.4647 8 15.017 8.44772 15.017 9V12C15.017 12.5523 14.5693 13 14.017 13H13.017V21H14.017ZM6.01708 21L6.01708 18C6.01708 16.8954 6.91251 16 8.01708 16H11.0171C11.5694 16 12.0171 15.5523 12.0171 15V9C12.0171 8.44772 11.5694 8 11.0171 8H8.01708C7.4648 8 7.01708 8.44772 7.01708 9V12C7.01708 12.5523 6.56937 13 6.01708 13H5.01708V21H6.01708Z" />
                                        </svg>
                                    </div>
                                    <blockquote class="text-2xl md:text-3xl font-medium text-slate-700 mb-10 leading-relaxed italic">
                                        "{{ $testimonial['quote'] }}"
                                    </blockquote>
                                    <div class="flex flex-col items-center">
                                        <h4 class="text-xl font-bold text-slate-900 mb-1">{{ $testimonial['author'] }}</h4>
                                        <p class="text-orange-primary font-medium">{{ $testimonial['location'] }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endforelse
                    </div>
                    
                    <!-- Pagination -->
                    <div class="testimonials-pagination flex justify-center gap-2 mt-12"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Blog Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-16">
                <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">Latest Blog</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight">Blogs</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($blogs as $blog)
                <div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="relative overflow-hidden aspect-[16/10]">
                        <img src="{{ $blog->featured_image ?? 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-all duration-500"></div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-6 mb-6 text-sm font-medium text-slate-400">
                            <span class="flex items-center gap-2">
                                <i class="fa-regular fa-calendar text-orange-primary"></i>
                                {{ $blog->created_at->format('d M, Y') }}
                            </span>
                            <span class="flex items-center gap-2">
                                <i class="fa-regular fa-eye text-orange-primary"></i>
                                {{ rand(100, 500) }} <!-- Placeholder for views if not in DB -->
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-orange-primary transition-colors">
                            <a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                        </h3>
                        <p class="text-slate-500 mb-8 line-clamp-2">
                            {{ Str::limit(strip_tags($blog->content), 120) }}
                        </p>
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="inline-flex items-center gap-2 text-orange-primary font-bold group/link">
                            Read More
                            <i class="fa-solid fa-chevron-right text-[10px] transition-transform group-hover/link:translate-x-1"></i>
                        </a>
                    </div>
                </div>
                @empty
                    @php
                        $placeholderBlogs = [
                            [
                                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=800',
                                'date' => '02 Jan, 2019',
                                'views' => '276',
                                'title' => 'How to design effective arts?',
                                'excerpt' => 'Discover the key principles of industrial design that lead to more efficient and aesthetic projects.'
                            ],
                            [
                                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=800',
                                'date' => '15 Jan, 2019',
                                'views' => '412',
                                'title' => 'Modern Architecture Trends',
                                'excerpt' => 'Exploring the fusion of sustainability and luxury in contemporary urban architecture.'
                            ],
                            [
                                'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=800',
                                'date' => '28 Jan, 2019',
                                'views' => '189',
                                'title' => 'Efficient Workspace Design',
                                'excerpt' => 'How the right office environment can boost productivity and employee well-being.'
                            ]
                        ];
                    @endphp
                    @foreach($placeholderBlogs as $blog)
                    <div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="relative overflow-hidden aspect-[16/10]">
                            <img src="{{ $blog['image'] }}" alt="{{ $blog['title'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-all duration-500"></div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-6 mb-6 text-sm font-medium text-slate-400">
                                <span class="flex items-center gap-2">
                                    <i class="fa-regular fa-calendar text-orange-primary"></i>
                                    {{ $blog['date'] }}
                                </span>
                                <span class="flex items-center gap-2">
                                    <i class="fa-regular fa-eye text-orange-primary"></i>
                                    {{ $blog['views'] }}
                                </span>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-orange-primary transition-colors">
                                <a href="{{ route('blogs.index') }}">{{ $blog['title'] }}</a>
                            </h3>
                            <p class="text-slate-500 mb-8 line-clamp-2">
                                {{ $blog['excerpt'] }}
                            </p>
                            <a href="{{ route('blogs.index') }}" class="inline-flex items-center gap-2 text-orange-primary font-bold group/link">
                                Read More
                                <i class="fa-solid fa-chevron-right text-[10px] transition-transform group-hover/link:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Government Project Work Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">PUBLIC WORKS DEPARTMENT</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-6">Government Project Work</h2>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg">We specialize in various categories of public works, delivering high-quality infrastructure for government projects with precision and excellence.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $govCategories = [
                        ['title' => 'Building works', 'icon' => 'building'],
                        ['title' => 'Bridge works', 'icon' => 'archway'],
                        ['title' => 'Road works', 'icon' => 'road'],
                        ['title' => 'Sanitation and water supply works', 'icon' => 'droplet'],
                        ['title' => 'Electrical works', 'icon' => 'bolt'],
                        ['title' => 'Mechanical works', 'icon' => 'gears'],
                    ];
                @endphp

                @foreach($govCategories as $category)
                <div class="p-8 border border-gray-100 rounded-xl hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-orange-primary/10 rounded-lg flex items-center justify-center text-orange-primary group-hover:bg-orange-primary group-hover:text-white transition-colors">
                            <i class="fa-solid fa-{{ $category['icon'] }} text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">{{ $category['title'] }}</h3>
                    </div>
                    <p class="text-slate-500">Executing {{ strtolower($category['title']) }} with precision and strict adherence to PWD standards and quality benchmarks.</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Our Awesome Team Bar -->
    <section class="py-12 bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="max-w-2xl text-center md:text-left">
                    <h2 class="text-3xl md:text-4xl font-black text-white mb-4">Looking for a construction partner you can trust?</h2>
                    <p class="text-slate-400 text-lg">Atom Forge Construction delivers end-to-end building solutions with unmatched quality, speed, and precision. Get results that exceed expectations.</p>
                </div>
                <a href="{{ route('contact') }}" class="px-10 py-4 bg-orange-primary text-white font-bold rounded-xl hover:bg-orange-600 transition-all shadow-lg shadow-orange-500/30 text-lg whitespace-nowrap">
                    Contact Now
                </a>
            </div>
        </div>
    </section>
@endsection
