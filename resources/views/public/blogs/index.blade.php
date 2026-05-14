@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative py-32 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1541888946425-d81bb19480c5?auto=format&fit=crop&q=80" alt="Background" class="w-full h-full object-cover opacity-20 scale-105 animate-pulse-slow">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 via-slate-900 to-slate-900"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-1.5 bg-orange-construction/20 text-orange-construction text-sm font-bold rounded-full mb-6 border border-orange-construction/30 uppercase tracking-widest">Knowledge Hub</span>
        <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-8 tracking-tight">
            Building the <span class="text-orange-construction">Future</span>
        </h1>
        <p class="text-xl text-slate-400 max-w-2xl mx-auto leading-relaxed">
            Expert insights into India's infrastructure evolution, construction technology, and sustainable development.
        </p>
    </div>
</section>

<!-- Blog Grid -->
<section class="py-24 bg-slate-50 relative -mt-10 rounded-t-[3rem] z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($posts as $post)
                <article class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-slate-100 flex flex-col">
                    <div class="aspect-[16/10] relative overflow-hidden">
                        <img src="{{ $post->featured_image ?? 'https://images.unsplash.com/photo-1503387762-592dea58ef23?auto=format&fit=crop&q=80' }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="absolute top-4 left-4 flex gap-2">
                            @if($post->featured_video_url || $post->featured_video_file)
                                <span class="px-3 py-1 bg-white/90 backdrop-blur-md text-rose-600 text-[10px] font-black rounded-full uppercase tracking-tighter flex items-center gap-1.5 shadow-sm">
                                    <span class="w-2 h-2 bg-rose-600 rounded-full animate-ping"></span> Video
                                </span>
                            @endif
                            <span class="px-3 py-1 bg-orange-construction text-white text-[10px] font-black rounded-full uppercase tracking-tighter shadow-sm">Insight</span>
                        </div>
                    </div>
                    
                    <div class="p-8 flex-1 flex flex-col">
                        <div class="flex items-center gap-4 text-xs font-bold text-slate-400 mb-4 uppercase tracking-widest">
                            <span class="flex items-center gap-1.5"><i class="far fa-calendar-alt text-orange-construction"></i> {{ $post->created_at->format('M d, Y') }}</span>
                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                            <span class="flex items-center gap-1.5"><i class="far fa-clock text-orange-construction"></i> 5 Min Read</span>
                        </div>
                        
                        <h2 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-orange-construction transition-colors line-clamp-2 leading-tight">
                            <a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        
                        <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-8">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        
                        <div class="mt-auto pt-6 border-t border-slate-50">
                            <a href="{{ route('blogs.show', $post->slug) }}" class="inline-flex items-center gap-2 text-sm font-black text-slate-900 hover:text-orange-construction transition-all group/link">
                                READ FULL ARTICLE
                                <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-32 bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 4v4h4"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">No Articles Found</h3>
                    <p class="text-slate-500">We're currently writing some amazing content. Check back soon!</p>
                </div>
            @endforelse
        </div>

        @if($posts->hasPages())
        <div class="mt-20">
            {{ $posts->links() }}
        </div>
        @endif
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-20 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-white p-12 rounded-3xl shadow-sm border border-gray-100">
            <h2 class="text-3xl font-bold text-slate-900 mb-4">Subscribe to Our Newsletter</h2>
            <p class="text-gray-600 mb-8">Get the latest infrastructure news and project updates delivered straight to your inbox.</p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-2xl mx-auto">
                <input type="email" placeholder="Your Email Address" class="flex-1 px-6 py-4 bg-slate-50 border-transparent focus:border-orange-construction focus:ring-orange-construction rounded-full text-slate-900 font-medium shadow-inner transition-all" required>
                <button type="submit" class="px-8 py-4 bg-orange-construction text-white font-bold rounded-full hover:bg-orange-600 shadow-lg shadow-orange-500/30 transition-all transform hover:scale-105 active:scale-95">
                    Subscribe Now
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
