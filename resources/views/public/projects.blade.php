@extends('layouts.public')

@section('content')
    <!-- Refined Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100/50 border border-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider mb-6">
                Our Portfolio
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                {{ $content['projects_hero_title'] ?? 'Built Excellence' }}
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto font-medium">
                {{ $content['projects_hero_subtitle'] ?? 'Showcasing our journey of building landmarks and transforming spaces with precision engineering.' }}
            </p>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none -z-10">
            <div class="absolute top-[-20%] left-[-10%] w-[30%] h-[60%] bg-blue-50 rounded-full blur-[100px] opacity-50"></div>
        </div>
    </section>

    <!-- Portfolio Filter -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
            <div class="flex flex-wrap justify-center gap-3">
                <button class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition-all">All Projects</button>
                <button class="px-6 py-2 bg-slate-50 text-slate-600 rounded-xl font-bold border border-slate-100 hover:bg-slate-100 transition-all">Residential</button>
                <button class="px-6 py-2 bg-slate-50 text-slate-600 rounded-xl font-bold border border-slate-100 hover:bg-slate-100 transition-all">Commercial</button>
                <button class="px-6 py-2 bg-slate-50 text-slate-600 rounded-xl font-bold border border-slate-100 hover:bg-slate-100 transition-all">Interiors</button>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @php
                    $projects = [
                        [
                            'title' => 'Skyline Towers',
                            'type' => 'Commercial',
                            'desc' => 'A multi-story commercial complex built with modern amenities and energy-efficient designs.',
                            'loc' => 'City Center, USA',
                            'img' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab'
                        ],
                        [
                            'title' => 'Sunset Villa',
                            'type' => 'Residential',
                            'desc' => 'A luxury residential project combining elegant architecture with sustainable living features.',
                            'loc' => 'South Extension, USA',
                            'img' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750'
                        ],
                        [
                            'title' => 'Greenwood Interiors',
                            'type' => 'Interiors',
                            'desc' => 'A full interior design project for a premium workspace, focusing on productivity and comfort.',
                            'loc' => 'Tech Park, USA',
                            'img' => 'https://images.unsplash.com/photo-1600585154340-be6199f7a09f'
                        ],
                        [
                            'title' => 'Blue Ridge Apartments',
                            'type' => 'Residential',
                            'desc' => 'Modern apartment project with world-class facilities and high-quality construction materials.',
                            'loc' => 'Outer Ring Road, USA',
                            'img' => 'https://images.unsplash.com/photo-1541888946425-d81bb19480c5'
                        ],
                        [
                            'title' => 'Industrial Logistics Hub',
                            'type' => 'Commercial',
                            'desc' => 'An expansive logistics and manufacturing facility designed for maximum operational efficiency.',
                            'loc' => 'Industrial Area, USA',
                            'img' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e'
                        ],
                        [
                            'title' => 'Zen Workspace',
                            'type' => 'Interiors',
                            'desc' => 'Minimalist office interior design project that combines Zen philosophy with modern workplace needs.',
                            'loc' => 'Hitec City, USA',
                            'img' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6'
                        ],
                    ];
                @endphp

                @foreach($projects as $p)
                <div class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500">
                    <div class="relative overflow-hidden aspect-[4/3]">
                        <img src="{{ $p['img'] }}?auto=format&fit=crop&q=80&w=800" alt="{{ $p['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute top-6 left-6">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-lg text-[10px] font-bold uppercase tracking-widest text-blue-600 shadow-sm">{{ $p['type'] }}</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-bold text-slate-900 mb-3 tracking-tight">{{ $p['title'] }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6 font-medium">{{ $p['desc'] }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-xs text-slate-400 font-bold gap-1.5 uppercase tracking-wider">
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $p['loc'] }}
                            </div>
                            <a href="#" class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-900 hover:bg-blue-600 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Project Invitation Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-50 rounded-[3rem] p-12 md:p-20 text-center border border-slate-100">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">Want to be our next success story?</h2>
                <p class="text-slate-500 text-lg mb-10 max-w-2xl mx-auto font-medium">We are ready to bring your vision to life with the same excellence and care that went into our previous projects.</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center px-10 py-4 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition-all">Start Your Journey</a>
            </div>
        </div>
    </section>
@endsection
