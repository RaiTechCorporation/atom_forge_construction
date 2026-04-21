@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100/50 border border-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider mb-8">
                        {{ $content['hero_badge'] ?? 'Precision in Every Pixel & Pillar' }}
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-slate-900 tracking-tight mb-8 leading-[1.1]">
                        @php
                            $title = $content['hero_title'] ?? 'We Build The Future With Integrity.';
                            $words = explode(' ', $title);
                            $lastWord = array_pop($words);
                            $mainTitle = implode(' ', $words);
                        @endphp
                        {!! $mainTitle !!} <span class="text-blue-600">{!! $lastWord !!}</span>
                    </h1>
                    <p class="text-lg md:text-xl text-slate-500 mb-12 max-w-xl font-medium leading-relaxed">
                        {{ $content['hero_subtitle'] ?? 'Atom Forge Construction delivers world-class residential and commercial infrastructure. Excellence driven by innovation and precision.' }}
                    </p>
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <a href="{{ route('projects') }}" class="w-full sm:w-auto px-10 py-5 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 transition-all shadow-xl shadow-blue-500/25 text-center">
                            View Portfolio
                        </a>
                        <a href="{{ route('services') }}" class="w-full sm:w-auto px-10 py-5 bg-slate-50 text-slate-900 font-bold rounded-2xl hover:bg-slate-100 transition-all border border-slate-200 text-center">
                            Our Services
                        </a>
                    </div>
                    
                    <!-- Trust Badges -->
                    <div class="mt-16 pt-10 border-t border-slate-100 flex flex-wrap items-center gap-10">
                        <div class="flex items-center gap-3">
                            <div class="text-2xl font-bold text-slate-900">{{ $content['stat_1_value'] ?? '150+' }}</div>
                            <div class="text-[11px] font-bold uppercase tracking-widest text-slate-400 leading-tight">{!! str_replace(' ', '<br>', $content['stat_1_label'] ?? 'Projects Delivered') !!}</div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="text-2xl font-bold text-slate-900">{{ $content['stat_2_value'] ?? '10+' }}</div>
                            <div class="text-[11px] font-bold uppercase tracking-widest text-slate-400 leading-tight">{!! str_replace(' ', '<br>', $content['stat_2_label'] ?? 'Years Of Experience') !!}</div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="text-2xl font-bold text-slate-900">{{ $content['stat_3_value'] ?? '98%' }}</div>
                            <div class="text-[11px] font-bold uppercase tracking-widest text-slate-400 leading-tight">{!! str_replace(' ', '<br>', $content['stat_3_label'] ?? 'Client Satisfaction') !!}</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative w-full">
                    <div class="absolute -inset-10 bg-blue-600/5 rounded-full blur-3xl -z-10 animate-pulse"></div>
                    <div class="relative grid grid-cols-2 gap-4 w-full">
                        <div class="space-y-4 pt-12">
                            <div class="rounded-[2rem] overflow-hidden shadow-2xl border border-slate-100 h-48 md:h-64">
                                <img src="{{ $content['hero_image_1'] ?? 'https://images.unsplash.com/photo-1541888946425-d81bb19480c5?auto=format&fit=crop&q=80&w=800' }}" alt="Construction Site" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </div>
                            <div class="rounded-[2rem] overflow-hidden shadow-2xl border border-slate-100 h-64 md:h-80">
                                <img src="{{ $content['hero_image_2'] ?? 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=800' }}" alt="Modern Building" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="rounded-[2rem] overflow-hidden shadow-2xl border border-slate-100 h-64 md:h-80">
                                <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&q=80&w=800" alt="Interior Design" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </div>
                            <div class="rounded-[2rem] overflow-hidden shadow-2xl border border-slate-100 h-48 md:h-64">
                                <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=800" alt="Blueprint" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Card -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 glass p-6 rounded-3xl shadow-2xl border border-white/50 backdrop-blur-xl hidden md:block">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-green-500/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Project Verified</p>
                                <p class="text-[11px] font-medium text-slate-500">Quality Checked & ISO Certified</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Background accents -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-slate-50/50 -z-10 skew-x-12 translate-x-1/4"></div>
    </section>

    <!-- Services Overview -->
    <section class="py-24 bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
                <div class="max-w-2xl">
                    <span class="text-blue-600 font-bold uppercase tracking-widest text-xs mb-4 block">Expertise</span>
                    <h2 class="text-4xl font-extrabold text-slate-900 mb-6 tracking-tight leading-tight">Comprehensive Building Solutions</h2>
                    <p class="text-slate-500 font-medium text-lg leading-relaxed">From initial concept to final handover, we provide end-to-end services that ensure your project is a resounding success.</p>
                </div>
                <a href="{{ route('services') }}" class="group flex items-center gap-3 font-bold text-slate-900 hover:text-blue-600 transition-colors">
                    Explore All Services 
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Construction -->
                <div class="group bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-2 transition-all duration-500">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-8 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 tracking-tight">Construction</h3>
                    <p class="text-slate-500 font-medium leading-relaxed mb-8">World-class residential and commercial building solutions with absolute structural integrity.</p>
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600">Learn More <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                </div>

                <!-- Interiors -->
                <div class="group bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-2 transition-all duration-500">
                    <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mb-8 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 tracking-tight">Interiors</h3>
                    <p class="text-slate-500 font-medium leading-relaxed mb-8">Bespoke interior design and decoration services that transform spaces into experiences.</p>
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600">Learn More <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                </div>

                <!-- Turnkey -->
                <div class="group bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-emerald-500/10 hover:-translate-y-2 transition-all duration-500">
                    <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center mb-8 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 tracking-tight">Turnkey</h3>
                    <p class="text-slate-500 font-medium leading-relaxed mb-8">Hassle-free end-to-end project management from design to final handover.</p>
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-600">Learn More <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Sneak Peek -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div class="max-w-2xl">
                    <span class="text-blue-600 font-bold uppercase tracking-widest text-xs mb-4 block">Portfolio</span>
                    <h2 class="text-4xl font-extrabold text-slate-900 mb-6 tracking-tight leading-tight">Featured Projects</h2>
                    <p class="text-slate-500 font-medium text-lg leading-relaxed">A glimpse into our recent work across various sectors.</p>
                </div>
                <a href="{{ route('projects') }}" class="group flex items-center gap-3 font-bold text-slate-900 hover:text-blue-600 transition-colors">
                    View Full Portfolio 
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="group relative rounded-[2.5rem] overflow-hidden aspect-[16/10] shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200" alt="Commercial Project" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent"></div>
                    <div class="absolute bottom-10 left-10">
                        <span class="px-3 py-1 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-lg mb-4 inline-block">Commercial</span>
                        <h3 class="text-2xl font-bold text-white tracking-tight">Skyline Corporate Tower</h3>
                    </div>
                </div>
                <div class="group relative rounded-[2.5rem] overflow-hidden aspect-[16/10] shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=1200" alt="Residential Project" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent"></div>
                    <div class="absolute bottom-10 left-10">
                        <span class="px-3 py-1 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-lg mb-4 inline-block">Residential</span>
                        <h3 class="text-2xl font-bold text-white tracking-tight">The Heritage Villas</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-24 bg-slate-900 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full -translate-x-1/2 translate-y-1/2 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-blue-500 font-bold uppercase tracking-widest text-xs mb-4 block">Values</span>
                <h2 class="text-4xl font-extrabold text-white mb-6 tracking-tight">Why Choose Atom Forge?</h2>
                <p class="text-slate-400 font-medium text-lg">We combine traditional craftsmanship with modern technology to deliver projects that exceed expectations.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600/20 text-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3 tracking-tight">Quality First</h4>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">No compromises on materials or construction standards.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600/20 text-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3 tracking-tight">On-Time Delivery</h4>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">Systematic project management to ensure we meet every deadline.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600/20 text-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3 tracking-tight">Expert Team</h4>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">Highly skilled engineers, architects, and master craftsmen.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600/20 text-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3 tracking-tight">Modern Tech</h4>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">Leveraging the latest in BIM and construction technology.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Plans -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-blue-600 font-bold uppercase tracking-widest text-xs mb-4 block">Strategic Options</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-6 tracking-tight uppercase italic">
                    {!! $content['plans_title_1'] ?? 'Choose the best' !!} <span class="text-blue-600">{!! $content['plans_title_2'] ?? 'for yourself' !!}</span>
                    <br>
                    <span class="text-slate-400">{!! $content['plans_subtitle'] ?? 'Choose Plans & Pricing' !!}</span>
                </h2>
                <p class="text-slate-500 font-bold uppercase text-[10px] tracking-[0.4em]">{{ $content['plans_tagline'] ?? 'Integrated Construction Solutions for Every Scale' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($plans as $plan)
                <div class="bg-white rounded-[2.5rem] border-4 border-black p-10 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all duration-300">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h3 class="text-2xl font-black text-slate-900 uppercase tracking-tight">{{ $plan->name }}</h3>
                            <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em] mt-1">Structural Grade {{ $loop->iteration }}</p>
                        </div>
                    </div>
                    
                    <div class="mb-10">
                        <span class="text-4xl font-black text-slate-900">₹{{ number_format($plan->price_per_sqft) }}</span>
                        <span class="text-slate-400 font-bold uppercase text-[10px] tracking-widest ml-2">/ SQ FT</span>
                    </div>

                    <ul class="space-y-4 mb-10">
                        @if($plan->features)
                            @foreach($plan->features as $feature)
                            <li class="flex items-center gap-3 text-sm font-bold text-slate-600">
                                <div class="w-5 h-5 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                {{ $feature }}
                            </li>
                            @endforeach
                        @else
                            <li class="text-slate-400 text-xs italic uppercase font-black">Standard industrial specs included</li>
                        @endif
                    </ul>

                    <a href="{{ route('contact', ['plan' => $plan->name]) }}" class="block w-full text-center py-4 bg-black text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-800 transition-all shadow-xl">
                        Select Plan
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-blue-600 rounded-[3rem] p-12 md:p-24 text-center relative overflow-hidden shadow-2xl shadow-blue-500/20">
                <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-8 tracking-tight leading-tight">Ready to start your next<br>landmark project?</h2>
                    <p class="text-blue-100 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">Connect with our team today for a free consultation and quote.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('contact') }}" class="w-full sm:w-auto px-12 py-5 bg-white text-blue-600 font-bold rounded-2xl hover:bg-slate-50 transition-all shadow-xl">Contact Us Now</a>
                        <a href="tel:{{ str_replace([' ', '(', ')', '-'], '', $content['contact_phone'] ?? '+15550000000') }}" class="w-full sm:w-auto px-12 py-5 bg-blue-700 text-white font-bold rounded-2xl hover:bg-blue-800 transition-all border border-blue-500/30">Call {{ $content['contact_phone'] ?? '+1 (555) 000-0000' }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
