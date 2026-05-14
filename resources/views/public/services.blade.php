@extends('layouts.public')

@section('content')
    <!-- Refined Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100/50 border border-orange-100 text-orange-700 text-xs font-bold uppercase tracking-wider mb-6">
                Our Expertise
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                {{ $content['services_hero_title'] ?? 'Our Services' }}
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto font-medium">
                {{ $content['services_hero_subtitle'] ?? 'Atom Forge Construction delivers end-to-end building solutions with unmatched quality, speed, and precision from concept to completion.' }}
            </p>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none -z-10">
            <div class="absolute top-[-20%] left-[-10%] w-[30%] h-[60%] bg-orange-50 rounded-full blur-[100px] opacity-50"></div>
        </div>
    </section>

    <!-- Detailed Services List -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-32">
            @foreach($services as $service)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 lg:gap-24 items-center">
                    <div class="{{ $loop->iteration % 2 == 0 ? 'order-2' : 'order-2 md:order-1' }}">
                        @if($service->icon)
                            <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center mb-8 text-orange-primary">
                                {!! $service->icon !!}
                            </div>
                        @endif
                        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">{{ $service->title }}</h2>
                        <p class="text-slate-500 text-lg mb-8 leading-relaxed font-medium">{{ $service->description }}</p>
                        
                        @if($service->features && count($service->features) > 0)
                            <ul class="space-y-4 mb-8">
                                @foreach($service->features as $item)
                                <li class="flex items-center gap-3 text-slate-700 font-semibold">
                                    <div class="w-5 h-5 rounded-full bg-orange-100 flex items-center justify-center text-orange-primary">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    {{ $item }}
                                </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="flex flex-wrap gap-4">
                            @if($service->button1_text)
                                <a href="{{ $service->button1_link ? (Route::has($service->button1_link) ? route($service->button1_link) : $service->button1_link) : '#' }}" class="inline-flex items-center gap-2 px-6 py-3 bg-orange-primary text-white font-bold rounded-xl hover:opacity-90 transition-all text-sm">
                                    {{ $service->button1_text }}
                                </a>
                            @endif
                            @if($service->button2_text)
                                <a href="{{ $service->button2_link ? (Route::has($service->button2_link) ? route($service->button2_link) : $service->button2_link) : '#' }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-700 transition-all text-sm">
                                    {{ $service->button2_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="{{ $loop->iteration % 2 == 0 ? 'order-1' : 'order-1 md:order-2' }} relative">
                        <div class="absolute -inset-4 bg-orange-primary/5 rounded-[2.5rem] blur-2xl -z-10"></div>
                        @if($service->image)
                            <img src="{{ $service->image }}" alt="{{ $service->title }}" class="rounded-[2rem] shadow-2xl border border-slate-100">
                        @else
                            <div class="aspect-video bg-slate-100 rounded-[2rem] flex items-center justify-center text-slate-300">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-orange-primary/20 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-8 tracking-tight">Need a Custom Solution?</h2>
                    <p class="text-slate-400 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">We provide tailored services that fit your specific project requirements. Our experts are ready to discuss your ideas.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('contact') }}" class="w-full sm:w-auto px-10 py-4 bg-orange-primary text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-orange-500/20">Request a Quote</a>
                        <a href="{{ route('home') }}" class="w-full sm:w-auto px-10 py-4 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-700 transition-all border border-slate-700">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
