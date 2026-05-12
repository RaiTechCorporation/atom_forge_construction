@extends('layouts.public')

@section('content')
    <!-- Refined Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100/50 border border-orange-100 text-orange-700 text-xs font-bold uppercase tracking-wider mb-6">
                Our Expertise
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                Residential Construction
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto font-medium">
                From custom villas to modern apartments, we deliver high-quality residential spaces built with precision.
            </p>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none -z-10">
            <div class="absolute top-[-20%] left-[-10%] w-[30%] h-[60%] bg-orange-50 rounded-full blur-[100px] opacity-50"></div>
        </div>
    </section>

    <!-- Detailed Service Content -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 lg:gap-24 items-center mb-24">
                <div class="order-2 md:order-1">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">Your Dream Home, Built to Last</h2>
                    <p class="text-slate-500 text-lg mb-8 leading-relaxed font-medium">
                        At Atom Forge Construction, we understand that a home is more than just a structure; it's a reflection of your dreams and aspirations. Our residential construction services are designed to bring your vision to life with uncompromising quality and attention to detail.
                    </p>
                    <p class="text-slate-500 text-lg mb-8 leading-relaxed font-medium">
                        We combine traditional craftsmanship with modern building techniques to ensure that every home we build is aesthetically pleasing, functional, and durable. Our commitment to excellence is visible in every brick laid and every finish applied.
                    </p>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                        @foreach(['Custom Villa Construction', 'Luxury Apartments', 'Home Renovations', 'Smart Home Integration', 'Green Building Options', 'Modular Solutions'] as $item)
                        <li class="flex items-center gap-3 text-slate-700 font-semibold">
                            <div class="w-5 h-5 rounded-full bg-orange-100 flex items-center justify-center text-orange-primary">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-orange-primary text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-orange-500/20">
                        Get a Consultation
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                <div class="order-1 md:order-2 relative">
                    <div class="absolute -inset-4 bg-orange-primary/5 rounded-[2.5rem] blur-2xl -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=1200" alt="Residential Construction" class="rounded-[2rem] shadow-2xl border border-slate-100">
                </div>
            </div>

            <!-- Key Features Grid -->
            <div class="mb-32">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Why Build With Atom Forge?</h2>
                    <p class="text-slate-500 max-w-2xl mx-auto">We provide a comprehensive range of residential services designed to make your building experience seamless and rewarding.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-200 transition-colors group">
                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-orange-primary mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-pencil-ruler text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Architectural Planning</h3>
                        <p class="text-slate-500 leading-relaxed">Personalized blueprints that optimize space, natural light, and modern aesthetics while respecting your budget.</p>
                    </div>
                    <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-200 transition-colors group">
                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-orange-primary mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-shield-check text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Quality Assurance</h3>
                        <p class="text-slate-500 leading-relaxed">Rigorous material testing and multi-stage inspections to ensure your home meets international safety standards.</p>
                    </div>
                    <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-200 transition-colors group">
                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-orange-primary mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-leaf text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Eco-Friendly Tech</h3>
                        <p class="text-slate-500 leading-relaxed">Integration of sustainable energy solutions and thermal insulation to reduce your long-term utility costs.</p>
                    </div>
                </div>
            </div>

            <!-- Building Process -->
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-white overflow-hidden relative">
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-primary/10 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <div class="relative z-10">
                    <div class="text-center mb-20">
                        <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">Our Process</span>
                        <h2 class="text-3xl md:text-5xl font-extrabold mb-6 tracking-tight">How We Build Your Home</h2>
                        <p class="text-slate-400 max-w-2xl mx-auto">A systematic approach from the first sketch to the final handover.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">01</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Consultation</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">We discuss your ideas, lifestyle needs, and budget to create a project roadmap.</p>
                        </div>
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">02</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Design & Permit</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Finalizing architectural designs and handling all necessary legal approvals and permits.</p>
                        </div>
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">03</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Construction</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">The actual build phase where our master craftsmen bring the blueprints to life.</p>
                        </div>
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">04</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Handover</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Final walk-through, quality sign-off, and handing you the keys to your new home.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-orange-primary rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-white/10 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-8 tracking-tight">Ready to build your dream home?</h2>
                    <p class="text-orange-50 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">Contact our residential construction experts today to discuss your project and get a custom quote.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('contact') }}" class="w-full sm:w-auto px-10 py-4 bg-white text-orange-primary font-bold rounded-xl hover:bg-slate-50 transition-all shadow-xl">Start Your Project</a>
                        <a href="{{ route('services') }}" class="w-full sm:w-auto px-10 py-4 bg-orange-600 text-white font-bold rounded-xl hover:bg-orange-700 transition-all border border-orange-500">All Services</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
