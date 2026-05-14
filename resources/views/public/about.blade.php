@extends('layouts.public')

@section('content')
    <!-- Refined Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100/50 border border-orange-100 text-orange-700 text-xs font-bold uppercase tracking-wider mb-6">
                Our Story
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                {{ $content['about_hero_title'] ?? 'About Atom Forge' }}
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto font-medium">
                {{ $content['about_hero_subtitle'] ?? 'A forward-thinking construction company focused on delivering high-quality, durable, and innovative building solutions.' }}
            </p>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none -z-10">
            <div class="absolute top-[-20%] left-[-10%] w-[30%] h-[60%] bg-orange-50 rounded-full blur-[100px] opacity-50"></div>
        </div>
    </section>

    <!-- Who We Are -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="relative">
                    <div class="absolute -inset-10 bg-orange-primary/5 rounded-full blur-3xl -z-10 animate-pulse"></div>
                    <div class="rounded-[3rem] overflow-hidden shadow-2xl border border-slate-100 aspect-square">
                        <img src="{{ $content['about_who_we_are_image'] ?? 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=1200' }}" alt="Construction Planning" class="w-full h-full object-cover">
                    </div>
                </div>
                <div>
                    <span class="text-orange-primary font-bold uppercase tracking-widest text-xs mb-4 block">Introduction</span>
                    <h2 class="text-4xl font-extrabold text-slate-900 mb-8 tracking-tight">
                        {{ $content['about_who_we_are_title'] ?? 'Who We Are' }}
                    </h2>
                    <div class="prose prose-slate max-w-none text-slate-500 font-medium text-lg leading-relaxed space-y-6">
                        {!! nl2br(e($content['about_who_we_are_content'] ?? "Atom Forge Construction is a premier firm dedicated to delivering high-quality residential, commercial, and interior projects. We've built a reputation for excellence through our commitment to integrity and innovation.\n\nWe believe every project is a partnership. We work closely with our clients to understand their vision and translate it into reality, ensuring every detail is handled with care and precision.")) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values & Philosophy -->
    <section class="py-24 bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-orange-primary font-bold uppercase tracking-widest text-xs mb-4 block">Our DNA</span>
                <h2 class="text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">{{ $content['about_values_title'] ?? 'Core Values That Drive Us' }}</h2>
                <p class="text-slate-500 font-medium text-lg leading-relaxed">{{ $content['about_values_subtitle'] ?? 'Our foundation is built on principles that ensure we deliver excellence in every square foot we build.' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-12 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all">
                    <div class="w-14 h-14 bg-orange-50 text-orange-primary rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 tracking-tight">Integrity</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">We operate with transparency and honesty in every interaction, from budgeting to final execution.</p>
                </div>
                <div class="bg-white p-12 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all">
                    <div class="w-14 h-14 bg-orange-50 text-orange-primary rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 tracking-tight">Innovation</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">We embrace the latest construction technologies and methods to deliver smarter, more sustainable results.</p>
                </div>
                <div class="bg-white p-12 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all">
                    <div class="w-14 h-14 bg-orange-50 text-orange-primary rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 tracking-tight">Precision</h3>
                    <p class="text-slate-500 font-medium leading-relaxed">Excellence is in the details. We maintain absolute precision in engineering and aesthetic finishes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership/Team Section could go here -->

    <!-- CTA Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-orange-primary/20 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-8 tracking-tight">Work With The Best</h2>
                    <p class="text-slate-400 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">Join our journey of building excellence. We are always looking for challenging projects that push the boundaries of construction.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('contact') }}" class="w-full sm:w-auto px-10 py-4 bg-orange-primary text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-orange-500/20">Connect With Us</a>
                        <a href="{{ route('projects') }}" class="w-full sm:w-auto px-10 py-4 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-700 transition-all border border-slate-700">View Our Work</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
