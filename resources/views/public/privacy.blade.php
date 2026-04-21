@extends('layouts.public')

@section('content')
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                {{ $content['privacy_title'] ?? 'Privacy Policy' }}
            </h1>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-slate max-w-none font-medium text-slate-600 leading-relaxed">
                {!! nl2br(e($content['privacy_content'] ?? 'Your privacy is important to us...')) !!}
            </div>
        </div>
    </section>
@endsection
