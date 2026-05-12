@extends('layouts.public')

@section('content')
<article class="bg-white">
    <!-- Article Header -->
    <header class="relative py-24 bg-slate-900 overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <img src="{{ $post->featured_image ?? 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80' }}" alt="Background" class="w-full h-full object-cover">
        </div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center mb-6">
                <span class="px-4 py-1.5 bg-orange-construction text-white text-sm font-bold rounded-full uppercase tracking-widest">Industry Insights</span>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-8 leading-tight">
                {{ $post->title }}
            </h1>
            <div class="flex flex-wrap justify-center items-center gap-6 text-slate-300 font-medium">
                <div class="flex items-center gap-2">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=EE5A24&color=fff" class="w-10 h-10 rounded-full border-2 border-orange-construction" alt="Admin">
                    <span>By Atom Forge Team</span>
                </div>
                <div class="w-1.5 h-1.5 rounded-full bg-slate-500"></div>
                <div class="flex items-center gap-2">
                    <i class="far fa-calendar-alt text-orange-construction"></i>
                    {{ $post->created_at->format('M d, Y') }}
                </div>
                <div class="w-1.5 h-1.5 rounded-full bg-slate-500"></div>
                <div class="flex items-center gap-2">
                    <i class="far fa-clock text-orange-construction"></i>
                    6 Min Read
                </div>
            </div>
        </div>
    </header>

    <!-- Article Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex flex-col lg:flex-row gap-16">
            <!-- Main Content -->
            <div class="lg:w-2/3">
                <div class="blog-box blog-details-box">
                    @if($post->featured_image)
                    <div class="blog-images">
                        <div class="img">
                            <img src="{{ $post->featured_image }}" class="w-full" alt="{{ $post->title }}">
                        </div>
                    </div>
                    @endif

                    <div class="details">
                        <h4 class="blog-title">
                            {{ $post->title }}
                        </h4>
                        <ul class="post-meta">
                            <li>
                                <a href="javascript:;">
                                    <i class="fas fa-calendar"></i>
                                    {{ $post->created_at->format('d M, Y') }}
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fas fa-eye"></i>
                                    {{ rand(100, 500) }} View(s)
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fas fa-comments"></i>
                                    Source : Atom Forge
                                </a>
                            </li>
                        </ul>

                        <div class="content pt-1">
                            {!! $post->content !!}
                        </div>
                    </div>

                    <div class="social-link">
                        <ul class="social-links">
                            <li>
                                <a class="facebook" href="#" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a class="twitter" href="#" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a class="linkedin" href="#" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                            <li>
                                <a class="pinterest" href="#" target="_blank">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </li>
                            <li>
                                <a class="plus" href="#">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                @if($post->faq)
                <div class="mt-20">
                    <h2 class="text-3xl font-bold text-slate-900 mb-8">Frequently Asked Questions</h2>
                    <div class="space-y-4">
                        @foreach($post->faq as $item)
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <h3 class="text-xl font-bold text-slate-900 mb-3">{{ $item['question'] }}</h3>
                            <p class="text-gray-600">{{ $item['answer'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Tags -->
                @if($post->tags)
                <div class="mt-12 flex flex-wrap gap-2 pt-12 border-t border-gray-100">
                    <span class="text-slate-900 font-bold mr-2">Tags:</span>
                    @foreach($post->tags as $tag)
                    <span class="px-4 py-2 bg-slate-100 text-slate-600 text-sm font-semibold rounded-full hover:bg-orange-50 hover:text-orange-construction transition-colors cursor-default">
                        #{{ $tag }}
                    </span>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="lg:w-1/3 space-y-12">
                <!-- Search -->
                <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Search Articles</h3>
                    <div class="relative">
                        <input type="text" placeholder="Search insights..." class="w-full px-6 py-4 bg-white border-transparent focus:border-orange-construction focus:ring-orange-construction rounded-2xl shadow-sm">
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-orange-construction transition-colors">
                            <i class="fas fa-search text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- CTA Card -->
                <div class="bg-slate-900 p-8 rounded-3xl relative overflow-hidden group">
                    <div class="absolute inset-0 opacity-10">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80" alt="Background" class="w-full h-full object-cover">
                    </div>
                    <div class="relative z-10 text-center">
                        <h3 class="text-2xl font-bold text-white mb-4">Have a Project in Mind?</h3>
                        <p class="text-slate-400 mb-8">Let our team of experts help you build your vision with precision and excellence.</p>
                        <a href="{{ route('contact') }}" class="block w-full py-4 bg-orange-construction text-white font-bold rounded-2xl hover:bg-orange-600 shadow-xl shadow-orange-500/20 transition-all transform hover:scale-[1.02] active:scale-95">
                            Get a Free Quote
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</article>
@endsection
