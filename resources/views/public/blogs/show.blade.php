@extends('layouts.public')

@section('content')
<article class="bg-white">
    <!-- Article Header -->
    <header class="relative py-32 bg-slate-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ $post->featured_image ?? 'https://images.unsplash.com/photo-1541888946425-d81bb19480c5?auto=format&fit=crop&q=80' }}" alt="Background" class="w-full h-full object-cover opacity-20 scale-105">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 via-slate-900 to-slate-900"></div>
        </div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center mb-8">
                <span class="px-4 py-1.5 bg-orange-construction text-white text-xs font-black rounded-full uppercase tracking-[0.2em] shadow-lg shadow-orange-500/20 border border-orange-400/30">Construction Insight</span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-10 leading-[1.1] tracking-tight">
                {{ $post->title }}
            </h1>
            <div class="flex flex-wrap justify-center items-center gap-8 text-slate-400 font-bold uppercase tracking-widest text-[10px]">
                <div class="flex items-center gap-3 bg-white/5 px-4 py-2 rounded-full border border-white/10">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=EE5A24&color=fff" class="w-6 h-6 rounded-full border border-orange-construction" alt="Admin">
                    <span class="text-white">Atom Forge Team</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="far fa-calendar-alt text-orange-construction text-sm"></i>
                    {{ $post->created_at->format('M d, Y') }}
                </div>
                <div class="flex items-center gap-2">
                    <i class="far fa-clock text-orange-construction text-sm"></i>
                    6 Min Read
                </div>
            </div>
        </div>
    </header>

    <!-- Article Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="flex flex-col lg:flex-row gap-20">
            <!-- Main Content -->
            <div class="lg:w-2/3">
                <div class="relative -mt-40 mb-16 rounded-[2.5rem] overflow-hidden shadow-2xl border-8 border-white group">
                    <img src="{{ $post->featured_image ?? 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" alt="{{ $post->title }}">
                    @if($post->featured_video_url || $post->featured_video_file)
                    <div class="absolute inset-0 flex items-center justify-center bg-slate-900/20 backdrop-blur-[2px]">
                        <a href="{{ $post->featured_video_url ?? $post->featured_video_file }}" target="_blank" class="w-24 h-24 bg-orange-construction text-white rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform group/play">
                            <i class="fas fa-play text-2xl ml-1"></i>
                        </a>
                    </div>
                    @endif
                </div>

                <div class="prose prose-lg prose-slate max-w-none prose-headings:text-slate-900 prose-headings:font-black prose-p:text-slate-600 prose-p:leading-relaxed prose-a:text-orange-construction prose-strong:text-slate-900 prose-img:rounded-3xl shadow-none border-none p-0">
                    {!! $post->content !!}
                </div>

                @if($post->faq)
                <div class="mt-24 pt-16 border-t border-slate-100">
                    <h2 class="text-3xl font-black text-slate-900 mb-12 flex items-center gap-4">
                        <span class="w-12 h-1 bg-orange-construction"></span>
                        Frequently Asked Questions
                    </h2>
                    <div class="space-y-6">
                        @foreach($post->faq as $item)
                        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                            <h3 class="text-xl font-bold text-slate-900 mb-4 flex items-start gap-3">
                                <span class="text-orange-construction font-black">Q.</span>
                                {{ $item['question'] }}
                            </h3>
                            <p class="text-slate-600 leading-relaxed pl-8">
                                {{ $item['answer'] }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Tags -->
                @if($post->tags)
                <div class="mt-16 flex flex-wrap gap-3 pt-12 border-t border-slate-100">
                    <span class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] w-full mb-2">Tagged with</span>
                    @foreach($post->tags as $tag)
                    <span class="px-5 py-2.5 bg-slate-50 text-slate-600 text-xs font-bold rounded-full hover:bg-orange-construction hover:text-white transition-all cursor-default border border-slate-100 uppercase tracking-widest">
                        #{{ $tag }}
                    </span>
                    @endforeach
                </div>
                @endif

                <!-- Share -->
                <div class="mt-12 bg-slate-900 rounded-[2rem] p-10 flex flex-col md:flex-row items-center justify-between gap-8 overflow-hidden relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-orange-construction/10 rounded-full blur-3xl"></div>
                    <div class="relative">
                        <h4 class="text-xl font-black text-white mb-1">Spread the Word</h4>
                        <p class="text-slate-400 text-sm">Help others learn about construction excellence.</p>
                    </div>
                    <div class="flex gap-4 relative">
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-orange-construction text-white rounded-2xl flex items-center justify-center transition-all hover:-translate-y-1"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-orange-construction text-white rounded-2xl flex items-center justify-center transition-all hover:-translate-y-1"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-orange-construction text-white rounded-2xl flex items-center justify-center transition-all hover:-translate-y-1"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:w-1/3 space-y-10">
                <!-- Search -->
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm sticky top-8">
                    <h3 class="text-xl font-black text-slate-900 mb-8 flex items-center gap-3">
                        <span class="w-2 h-8 bg-orange-construction rounded-full"></span>
                        Search Knowledge
                    </h3>
                    <div class="relative group">
                        <input type="text" placeholder="Explore topics..." class="w-full px-6 py-5 bg-slate-50 border-slate-100 focus:bg-white focus:border-orange-construction focus:ring-4 focus:ring-orange-construction/10 rounded-2xl transition-all font-medium">
                        <button class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-orange-construction transition-colors">
                            <i class="fas fa-search text-xl"></i>
                        </button>
                    </div>

                    <div class="mt-12">
                        <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 p-10 rounded-[2.5rem] relative overflow-hidden group border border-white/5 shadow-2xl">
                            <!-- Animated Background Elements -->
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-orange-construction/20 rounded-full blur-[80px] group-hover:bg-orange-construction/30 transition-colors duration-700"></div>
                            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-indigo-500/10 rounded-full blur-[80px]"></div>
                            
                            <div class="relative z-10">
                                <div class="w-16 h-16 bg-white/5 backdrop-blur-xl rounded-2xl flex items-center justify-center mb-8 border border-white/10 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500">
                                    <i class="fas fa-hard-hat text-2xl text-orange-construction"></i>
                                </div>
                                
                                <h3 class="text-3xl font-black text-white mb-6 leading-tight tracking-tight">
                                    Ready to build your <span class="text-orange-construction italic">vision</span>?
                                </h3>
                                
                                <p class="text-slate-400 text-base mb-10 leading-relaxed font-medium">
                                    Partner with India's most trusted infrastructure experts for precision-engineered excellence.
                                </p>
                                
                                <a href="{{ route('contact') }}" class="group/btn inline-flex items-center justify-center w-full py-5 bg-orange-construction text-white font-black rounded-2xl hover:bg-orange-600 shadow-2xl shadow-orange-500/40 transition-all transform hover:scale-[1.03] active:scale-95 text-xs tracking-[0.2em] relative overflow-hidden">
                                    <span class="relative z-10 flex items-center gap-3">
                                        GET A FREE QUOTE
                                        <i class="fas fa-arrow-right text-[10px] group-hover/btn:translate-x-1 transition-transform"></i>
                                    </span>
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover/btn:animate-shimmer"></div>
                                </a>
                                
                                <div class="mt-8 flex items-center justify-center gap-6 grayscale opacity-40 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
                                    <div class="h-6 w-px bg-white/10"></div>
                                    <span class="text-[10px] font-black text-slate-500 tracking-[0.2em] uppercase">ISO 9001:2015</span>
                                    <div class="h-6 w-px bg-white/10"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</article>
@endsection
