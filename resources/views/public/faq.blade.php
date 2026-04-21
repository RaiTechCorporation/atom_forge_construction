@extends('layouts.public')

@section('content')
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                {{ $content['faq_title'] ?? 'Frequently Asked Questions' }}
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto font-medium">
                {{ $content['faq_subtitle'] ?? 'Find answers to common questions about our services and processes.' }}
            </p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100">
                <h3 class="text-xl font-bold text-slate-900 mb-4">{{ $content['faq_1_question'] ?? 'What types of projects do you handle?' }}</h3>
                <p class="text-slate-600 font-medium leading-relaxed">{{ $content['faq_1_answer'] ?? 'We handle residential, commercial, and interior design projects of all scales.' }}</p>
            </div>
            <!-- Additional FAQs can be added here -->
        </div>
    </section>
@endsection
