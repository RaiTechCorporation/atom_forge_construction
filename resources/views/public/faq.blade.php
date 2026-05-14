@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-24 overflow-hidden bg-slate-900">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-6">
                {{ $content['faq_title'] ?? 'Frequently Asked Questions' }}
            </h1>
            <p class="text-xl text-slate-300 max-w-2xl mx-auto font-medium">
                {{ $content['faq_subtitle'] ?? 'Find answers to common questions about our services and processes.' }}
            </p>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24 bg-white" x-data="{ active: null }">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4">
                @foreach($faqs as $faq)
                    <div class="border border-slate-200 rounded-2xl overflow-hidden transition-all duration-200"
                         :class="{ 'ring-2 ring-slate-900 border-transparent': active === {{ $faq->id }} }">
                        <button 
                            @click="active = (active === {{ $faq->id }} ? null : {{ $faq->id }})"
                            class="w-full flex items-center justify-between p-6 text-left focus:outline-none"
                        >
                            <span class="text-lg font-bold text-slate-900">{{ $faq->question }}</span>
                            <span class="ml-4 flex-shrink-0 transition-transform duration-200" :class="{ 'rotate-180': active === {{ $faq->id }} }">
                                <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div 
                            x-show="active === {{ $faq->id }}"
                            x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 max-h-0"
                            x-transition:enter-end="opacity-100 max-h-[500px]"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 max-h-[500px]"
                            x-transition:leave-end="opacity-0 max-h-0"
                            class="overflow-hidden"
                        >
                            <div class="px-6 pb-6 text-slate-600 leading-relaxed font-medium">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Still Have Questions? -->
            <div class="mt-20 bg-slate-50 rounded-3xl p-8 md:p-12 text-center border border-slate-100">
                <h3 class="text-2xl font-bold text-slate-900 mb-4">Still have questions?</h3>
                <p class="text-slate-600 mb-8 max-w-lg mx-auto">
                    Can't find the answer you're looking for? Please chat to our friendly team.
                </p>
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-slate-900 rounded-full hover:bg-slate-800 transition-colors shadow-lg shadow-slate-200">
                    Get in touch
                </a>
            </div>
        </div>
    </section>
@endsection
