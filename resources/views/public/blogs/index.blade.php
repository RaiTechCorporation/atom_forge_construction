@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative py-20 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1541888946425-d81bb19480c5?auto=format&fit=crop&q=80" alt="Background" class="w-full h-full object-cover">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Latest Insights & News</h1>
        <p class="text-xl text-slate-300 max-w-3xl mx-auto">Stay updated with the latest trends in Indian construction, infrastructure development, and PWD project updates.</p>
    </div>
</section>

<!-- Blog Grid -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <article class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group">
                    <div class="aspect-video relative overflow-hidden">
                        <img src="{{ $post->featured_image ?? 'https://images.unsplash.com/photo-1503387762-592dea58ef23?auto=format&fit=crop&q=80' }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            @if($post->featured_video_url || $post->featured_video_file)
                                <span class="px-3 py-1 bg-rose-600 text-white text-xs font-bold rounded-full uppercase tracking-wider flex items-center gap-1">
                                    <i class="fas fa-play text-[10px]"></i> Video
                                </span>
                            @else
                                <span class="px-3 py-1 bg-orange-construction text-white text-xs font-bold rounded-full uppercase tracking-wider">Construction</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                            <span><i class="far fa-calendar mr-2"></i>{{ $post->created_at->format('M d, Y') }}</span>
                            <span><i class="far fa-user mr-2"></i>Admin</span>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-orange-construction transition-colors">
                            <a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="text-gray-600 line-clamp-3 mb-6">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        <a href="{{ route('blogs.show', $post->slug) }}" class="inline-flex items-center font-bold text-orange-construction hover:gap-3 transition-all">
                            Read Full Article <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="text-6xl text-gray-200 mb-4"><i class="fas fa-newspaper"></i></div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">No Articles Found</h3>
                    <p class="text-gray-600">We're currently working on some amazing content. Please check back soon!</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $posts->links() }}
        </div>
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
