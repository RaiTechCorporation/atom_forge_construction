@extends('layouts.public')

@section('content')
    <!-- Refined Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100/50 border border-orange-100 text-orange-700 text-xs font-bold uppercase tracking-wider mb-6">
                Client Success
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
                <!-- Testimonial 1 -->
                <div class="bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex gap-1 text-orange-primary mb-6">
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                    </div>
                    <p class="text-slate-600 font-medium text-lg leading-relaxed mb-8 italic">
                        "Atom Forge Construction transformed our vision into a stunning reality. Their attention to detail and commitment to quality are truly unmatched in the industry."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-slate-200 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=200" alt="Client" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">Arjun Mehta</h4>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Homeowner, Mumbai</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex gap-1 text-orange-primary mb-6">
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                    </div>
                    <p class="text-slate-600 font-medium text-lg leading-relaxed mb-8 italic">
                        "The project was delivered on time and within budget. Their professional approach and transparent communication made the entire process stress-free."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-slate-200 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=200" alt="Client" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">Sneha Kapoor</h4>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">CEO, TechSpace</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex gap-1 text-orange-primary mb-6">
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                    </div>
                    <p class="text-slate-600 font-medium text-lg leading-relaxed mb-8 italic">
                        "From structural integrity to aesthetic finishes, everything was perfect. I highly recommend Atom Forge for any high-end construction project."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-slate-200 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=200" alt="Client" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">Vikram Malhotra</h4>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Real Estate Developer</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 4 -->
                <div class="bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex gap-1 text-orange-primary mb-6">
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                    </div>
                    <p class="text-slate-600 font-medium text-lg leading-relaxed mb-8 italic">
                        "Exceptional engineering and project management. They handled our complex industrial build with remarkable precision."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-slate-200 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1556157382-97eda2d62296?auto=format&fit=crop&q=80&w=200" alt="Client" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">Rahul Singhania</h4>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Director, RS Logistics</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 5 -->
                <div class="bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex gap-1 text-orange-primary mb-6">
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                    </div>
                    <p class="text-slate-600 font-medium text-lg leading-relaxed mb-8 italic">
                        "Their design-build approach saved us significant time and resources. A truly innovative construction partner."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-slate-200 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=200" alt="Client" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">Ananya Iyer</h4>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Architectural Consultant</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 6 -->
                <div class="bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex gap-1 text-orange-primary mb-6">
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                        <i class="fas fa-star text-sm"></i>
                    </div>
                    <p class="text-slate-600 font-medium text-lg leading-relaxed mb-8 italic">
                        "Highly satisfied with the sustainable building practices they incorporated into our new office complex."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-slate-200 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1542909168-82c3e7fdca5c?auto=format&fit=crop&q=80&w=200" alt="Client" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">David Wilson</h4>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Sustainability Lead, EcoCorp</p>
                        </div>
                    </div>
                </div>
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
