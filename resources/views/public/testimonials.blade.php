@extends('layouts.public')

@section('content')
    <!-- Refined Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100/50 border border-orange-100 text-orange-700 text-xs font-bold uppercase tracking-wider mb-6">
                {{ $content['testimonials_tagline'] ?? 'Client Success' }}
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                {{ $content['testimonials_hero_title'] ?? 'What Our Clients Say' }}
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto font-medium">
                {{ $content['testimonials_hero_subtitle'] ?? 'We take pride in delivering excellence. Read about the experiences of those who have built their dreams with us.' }}
            </p>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none -z-10">
            <div class="absolute top-[-20%] left-[-10%] w-[30%] h-[60%] bg-orange-50 rounded-full blur-[100px] opacity-50"></div>
        </div>
    </section>

    <!-- Testimonials Grid -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($testimonials as $testimonial)
                <!-- Testimonial -->
                <div class="bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex gap-1 text-orange-primary mb-6">
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                    </div>
                    <p class="text-slate-600 font-medium text-lg leading-relaxed mb-8 italic">
                        "{{ $testimonial->quote }}"
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-slate-200 overflow-hidden">
                            @if($testimonial->image_url)
                                <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->author }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">{{ $testimonial->author }}</h4>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">{{ $testimonial->location }}</p>
                        </div>
                    </div>
                </div>
                @empty
                    @php
                        $testimonialCount = 1;
                        $hasHardcoded = false;
                    @endphp
                    @while(isset($content["testimonial_{$testimonialCount}_quote"]))
                        @php
                            $quote = $content["testimonial_{$testimonialCount}_quote"];
                            $author = $content["testimonial_{$testimonialCount}_author"] ?? '';
                            $location = $content["testimonial_{$testimonialCount}_location"] ?? '';
                            $image = $content["testimonial_{$testimonialCount}_image"] ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=200';
                            $hasHardcoded = true;
                        @endphp
                        <div class="bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                            <div class="flex gap-1 text-orange-primary mb-6">
                                <i class="fas fa-star text-sm"></i>
                                <i class="fas fa-star text-sm"></i>
                                <i class="fas fa-star text-sm"></i>
                                <i class="fas fa-star text-sm"></i>
                                <i class="fas fa-star text-sm"></i>
                            </div>
                            <p class="text-slate-600 font-medium text-lg leading-relaxed mb-8 italic">
                                "{{ $quote }}"
                            </p>
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-slate-200 overflow-hidden">
                                    <img src="{{ $image }}" alt="{{ $author }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900">{{ $author }}</h4>
                                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">{{ $location }}</p>
                                </div>
                            </div>
                        </div>
                        @php $testimonialCount++; @endphp
                    @endwhile

                    @if(!$hasHardcoded)
                        <div class="col-span-full text-center py-12">
                            <p class="text-slate-500 font-medium">No testimonials available at the moment.</p>
                        </div>
                    @endif
                @endforelse
            </div>
        </div>
    </section>

    <!-- Share Your Experience CTA -->
    <section class="py-24 bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-orange-primary/20 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-8 tracking-tight">Ready to Build Your Story?</h2>
                    <p class="text-slate-400 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">Join our growing list of satisfied clients and let's construct something extraordinary together.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('contact') }}" class="w-full sm:w-auto px-10 py-4 bg-orange-primary text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-orange-500/20">Start Your Project</a>
                        <a href="{{ route('projects') }}" class="w-full sm:w-auto px-10 py-4 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-700 transition-all border border-slate-700">View Our Portfolio</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
