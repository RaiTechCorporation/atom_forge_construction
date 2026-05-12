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
                'subtitle' => 'PRECISE CREATED ONLY FOR YOU',
                'title_dark' => 'Building',
                'title_orange' => 'Strength',
                'description' => 'We deliver reliable, innovative, and high-quality construction solutions designed to stand the test of time.',
                'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=1920',
            ],
            [
                'subtitle' => 'PRECISE CREATED ONLY FOR YOU',
                'title_dark' => 'Shaping',
                'title_orange' => 'The Future',
                'description' => 'At Atom Forge Construction, we don\'t just build structures—we engineer the future with precision and passion.',
                'image' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=1920',
            ],
            [
                'subtitle' => 'PRECISE CREATED ONLY FOR YOU',
                'title_dark' => 'Modern',
                'title_orange' => 'Engineering',
                'description' => 'Combining cutting-edge technology with precision craftsmanship for superior building solutions.',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1920',
            ],
            [
                'subtitle' => 'PRECISE CREATED ONLY FOR YOU',
                'title_dark' => 'Smart',
                'title_orange' => 'Planning',
                'description' => 'Efficient execution and strategic project management from concept to completion.',
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=1920',
            ],
            [
                'subtitle' => 'PRECISE CREATED ONLY FOR YOU',
                'title_dark' => 'Reliable',
                'title_orange' => 'Partners',
                'description' => 'A commitment to excellence, safety, and timely delivery in every stage of construction.',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1920',
            ],
            [
                'subtitle' => 'PRECISE CREATED ONLY FOR YOU',
                'title_dark' => 'Sustainable',
                'title_orange' => 'Builds',
                'description' => 'Delivering construction solutions that are scalable, sustainable, and built to last.',
                'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1920',
            ],
            [
                'subtitle' => 'PRECISE CREATED ONLY FOR YOU',
                'title_dark' => 'Excellence',
                'title_orange' => 'Redefined',
                'description' => 'Turning your ideas into solid structures with unmatched quality and precision.',
                'image' => 'https://images.unsplash.com/photo-1541888946425-d81bb19480c5?auto=format&fit=crop&q=80&w=1920',
            ],
            [
                'subtitle' => 'PRECISE CREATED ONLY FOR YOU',
                'title_dark' => 'Potential',
                'title_orange' => 'Growth',
                'description' => 'Unlocking massive opportunities in the construction sector with strategic planning.',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1920',
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

    <!-- Floating Service Cards -->
    <section class="relative z-20 -mt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $featureCards = [
                        ['title' => 'A Global Network', 'subtitle' => 'International Presence', 'icon' => 'globe', 'delay' => 'delay-100'],
                        ['title' => 'A Global Network', 'subtitle' => 'Certified Excellence', 'icon' => 'award', 'delay' => 'delay-200'],
                        ['title' => 'A Global Network', 'icon' => 'building', 'subtitle' => 'Modern Infrastructure', 'delay' => 'delay-300'],
                        ['title' => 'A Global Network', 'icon' => 'users', 'subtitle' => 'Professional Team', 'delay' => 'delay-400'],
                        ['title' => 'A Global Network', 'icon' => 'tools', 'subtitle' => 'Latest Technology', 'delay' => 'delay-500'],
                        ['title' => 'Innovative Solution', 'icon' => 'lightbulb', 'subtitle' => 'Creative Engineering', 'delay' => 'delay-700'],
                    ];
                @endphp

                @foreach($featureCards as $card)
                <div class="bg-white p-12 shadow-xl hover:shadow-2xl rounded-2xl group hover:bg-orange-primary transition-all duration-500 relative animate-fade-up reveal {{ $card['delay'] }} hover:-translate-y-2 border border-gray-50 flex flex-col items-start overflow-hidden">
                    <!-- Subtle Background Icon for hover -->
                    <div class="absolute -right-8 -bottom-8 opacity-[0.03] group-hover:opacity-10 transition-opacity duration-500">
                         @if($card['icon'] == 'globe')
                            <svg class="w-48 h-48 text-black group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        @elseif($card['icon'] == 'award')
                            <svg class="w-48 h-48 text-black group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        @elseif($card['icon'] == 'building')
                            <svg class="w-48 h-48 text-black group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        @elseif($card['icon'] == 'users')
                            <svg class="w-48 h-48 text-black group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        @elseif($card['icon'] == 'tools')
                            <svg class="w-48 h-48 text-black group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 011-1h1a2 2 0 100-4H7a1 1 0 01-1-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
                        @elseif($card['icon'] == 'lightbulb')
                            <svg class="w-48 h-48 text-black group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.663 17h4.674a1 1 0 01.992.883l.194 1.488a1 1 0 01-.992 1.129H9.47a1 1 0 01-.992-1.129l.194-1.488a1 1 0 01.992-.883zM12 3a7 7 0 00-7 7c0 1.582.528 3.039 1.414 4.208A7 7 0 0112 14.122a7 7 0 015.586-2.914A7 7 0 0012 3z"></path></svg>
                        @endif
                    </div>

                    <div class="mb-8 p-4 bg-orange-50 group-hover:bg-white/10 rounded-2xl transition-colors duration-500">
                        @if($card['icon'] == 'globe')
                            <svg class="w-10 h-10 text-orange-primary group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        @elseif($card['icon'] == 'award')
                            <svg class="w-10 h-10 text-orange-primary group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        @elseif($card['icon'] == 'building')
                            <svg class="w-10 h-10 text-orange-primary group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        @elseif($card['icon'] == 'users')
                            <svg class="w-10 h-10 text-orange-primary group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        @elseif($card['icon'] == 'tools')
                            <svg class="w-10 h-10 text-orange-primary group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 011-1h1a2 2 0 100-4H7a1 1 0 01-1-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
                        @elseif($card['icon'] == 'lightbulb')
                            <svg class="w-10 h-10 text-orange-primary group-hover:text-white transition-colors duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M9.663 17h4.674a1 1 0 01.992.883l.194 1.488a1 1 0 01-.992 1.129H9.47a1 1 0 01-.992-1.129l.194-1.488a1 1 0 01.992-.883zM12 3a7 7 0 00-7 7c0 1.582.528 3.039 1.414 4.208A7 7 0 0112 14.122a7 7 0 015.586-2.914A7 7 0 0012 3z"></path></svg>
                        @endif
                    </div>

                    <div class="space-y-2 mb-12">
                        <h4 class="text-orange-primary group-hover:text-white/80 font-bold uppercase tracking-[0.2em] text-[10px] transition-colors duration-300">
                            {{ $card['subtitle'] }}
                        </h4>
                        <h3 class="text-2xl font-black text-slate-900 group-hover:text-white leading-tight transition-colors duration-300">
                            {{ $card['title'] }}
                        </h3>
                    </div>
                    
                    <a href="#" class="w-12 h-12 bg-slate-900 group-hover:bg-white flex items-center justify-center transition-all duration-300 transform group-hover:rotate-45 shadow-lg rounded-xl mt-auto">
                        <svg class="w-6 h-6 text-white group-hover:text-orange-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Column: Image -->
                <div class="relative">
                    <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=800" alt="Modern Architecture" class="w-full h-auto">
                    </div>
                    <!-- Decorative element -->
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-orange-primary/10 rounded-2xl -z-0"></div>
                    <div class="absolute -top-6 -right-6 w-32 h-32 border-4 border-orange-primary/20 rounded-2xl -z-0"></div>
                </div>

                <!-- Right Column: Content -->
                <div>
                    <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">A Little Bit More</span>
                    <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-8 leading-tight">About Us</h2>
                    
                    <div class="space-y-6 text-slate-500 font-medium text-lg leading-relaxed mb-10">
                        <p>
                            We are a leading construction firm dedicated to delivering excellence in every project we undertake. With decades of experience, our team of experts ensures that your vision is brought to life with precision and care.
                        </p>
                        <p>
                            Our commitment to quality, innovation, and sustainability sets us apart in the industry. We work closely with our clients to provide tailored solutions that meet their unique needs and exceed their expectations.
                        </p>
                    </div>

                    <a href="{{ route('about') }}" class="inline-flex items-center gap-3 px-10 py-4 bg-orange-primary text-white font-bold rounded-full hover:bg-orange-600 transition-all shadow-lg shadow-orange-500/30">
                        Read More
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

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
                    <div class="text-5xl md:text-6xl font-black text-white mb-4">10</div>
                    <div class="text-orange-100 font-bold uppercase tracking-widest text-sm">Winning Awards</div>
                </div>

                <!-- Satisfied Clients -->
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-black text-white mb-4">1230</div>
                    <div class="text-orange-100 font-bold uppercase tracking-widest text-sm">Satisfied Clients</div>
                </div>

                <!-- Best Projects -->
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-black text-white mb-4">360</div>
                    <div class="text-orange-100 font-bold uppercase tracking-widest text-sm">Best Projects</div>
                </div>

                <!-- Years Served -->
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-black text-white mb-4">15+</div>
                    <div class="text-orange-100 font-bold uppercase tracking-widest text-sm">Years Served</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Services Grid -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">THE BEST SERVICES</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-6">Innovative Building Solutions</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">We combine modern engineering, precision craftsmanship, and reliable project management to turn ideas into solid structures, from residential projects to large-scale commercial developments.</p>
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
                <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">CASE STUDIES</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight">Latest Projects</h2>
            </div>

            <div class="relative">
                <div class="swiper projects-swiper !overflow-visible">
                    <div class="swiper-wrapper">
                        @php
                            $projects = [
                                ['name' => 'Building Construction', 'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=800'],
                                ['name' => 'Interior Design', 'image' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=800'],
                                ['name' => 'Bridge Engineering', 'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=800'],
                                ['name' => 'Urban Planning', 'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=800'],
                                ['name' => 'Modern Architecture', 'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=800'],
                            ];
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
            <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=1920" alt="Industrial Background" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-slate-900/60"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-6">Our Video Presentation</h2>
            <p class="text-slate-300 max-w-2xl mx-auto mb-12 text-lg">
                Experience our commitment to excellence and innovation through our detailed project showcases and behind-the-scenes look at our construction process.
            </p>

            <div class="flex justify-center">
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="w-24 h-24 bg-orange-primary rounded-full flex items-center justify-center text-white text-3xl shadow-2xl shadow-orange-500/50 hover:scale-110 transition-transform duration-300 group">
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
                <span class="text-orange-primary font-bold uppercase tracking-widest text-xs mb-4 block">Values</span>
                <h2 class="text-4xl font-extrabold text-white mb-6 tracking-tight">Why Choose Atom Forge?</h2>
                <p class="text-slate-400 font-medium text-lg">At Atom Forge Construction, we don’t just build structures—we engineer the future. Leveraging cutting-edge technology, smart planning, and efficient execution, we deliver solutions that are built to last.</p>
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
                <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">Choose the best for yourself</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-6">Choose Plans & Pricing</h2>
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
                @php
                    $team = [
                        ['name' => 'Ervin Kim', 'role' => 'CEO of Apple', 'image' => 'https://i.pravatar.cc/300?u=1'],
                        ['name' => 'Jane Doe', 'role' => 'Lead Architect', 'image' => 'https://i.pravatar.cc/300?u=2'],
                        ['name' => 'John Smith', 'role' => 'Civil Engineer', 'image' => 'https://i.pravatar.cc/300?u=3'],
                        ['name' => 'Sarah Wilson', 'role' => 'Project Manager', 'image' => 'https://i.pravatar.cc/300?u=4'],
                    ];
                @endphp

                @foreach($team as $member)
                <div class="group">
                    <div class="relative overflow-hidden rounded-2xl mb-6 aspect-square shadow-lg">
                        <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        
                        <!-- Social Icons Overlay -->
                        <div class="absolute inset-x-0 bottom-0 p-6 translate-y-full group-hover:translate-y-0 transition-transform duration-500 bg-gradient-to-t from-orange-primary to-orange-primary/80">
                            <div class="flex justify-center gap-4 text-white">
                                <a href="#" class="hover:text-slate-900 transition-colors"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="hover:text-slate-900 transition-colors"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#" class="hover:text-slate-900 transition-colors"><i class="fa-brands fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $member['name'] }}</h3>
                        <p class="text-orange-primary font-medium text-sm">{{ $member['role'] }}</p>
                    </div>
                </div>
                @endforeach
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
                        @php
                            $testimonials = [
                                [
                                    'quote' => 'That conviction is where the process of change really begins. The architecture of your life is built on the foundation of your choices.',
                                    'author' => 'Jhon Smith',
                                    'designation' => 'CEO & Founder'
                                ],
                                [
                                    'quote' => 'Exceptional quality and professional service. They transformed our vision into reality with precision and care.',
                                    'author' => 'Sarah Johnson',
                                    'designation' => 'Operations Director'
                                ],
                                [
                                    'quote' => 'Reliable, innovative, and dedicated. Atom Forge is truly a leader in the construction industry.',
                                    'author' => 'Michael Chen',
                                    'designation' => 'Property Developer'
                                ]
                            ];
                        @endphp

                        @foreach($testimonials as $testimonial)
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
                                    <p class="text-orange-primary font-medium">{{ $testimonial['designation'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight">LOREM IPSUM DOLOR</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $blogs = [
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

                @foreach($blogs as $blog)
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
