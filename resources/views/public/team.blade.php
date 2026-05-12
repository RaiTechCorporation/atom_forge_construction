@extends('layouts.public')

@section('content')
    <!-- Refined Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100/50 border border-orange-100 text-orange-700 text-xs font-bold uppercase tracking-wider mb-6">
                Our Experts
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                {{ $content['team_hero_title'] ?? 'Meet Our Team' }}
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto font-medium">
                {{ $content['team_hero_subtitle'] ?? 'Dedicated professionals committed to excellence in every project we undertake.' }}
            </p>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none -z-10">
            <div class="absolute top-[-20%] left-[-10%] w-[30%] h-[60%] bg-orange-50 rounded-full blur-[100px] opacity-50"></div>
        </div>
    </section>

    <!-- Team Grid Section -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Team Member 1 -->
                <div class="group">
                    <div class="relative mb-6 rounded-[2.5rem] overflow-hidden aspect-[4/5] bg-slate-100 shadow-sm transition-all duration-500 group-hover:shadow-2xl group-hover:-translate-y-2 border border-slate-100">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=800" alt="Team Member" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 scale-110 group-hover:scale-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute bottom-8 left-8 right-8 translate-y-4 group-hover:translate-y-0 transition-transform duration-500 opacity-0 group-hover:opacity-100">
                            <div class="flex gap-4">
                                <a href="#" class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-orange-primary hover:text-white transition-colors">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-orange-primary hover:text-white transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-slate-900 mb-1 tracking-tight">Rajesh Sharma</h3>
                        <p class="text-orange-primary font-bold uppercase tracking-widest text-[10px] mb-4">Founder & Managing Director</p>
                        <p class="text-slate-500 font-medium leading-relaxed">Visionary leader with 20+ years of experience in construction and architectural innovation.</p>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="group">
                    <div class="relative mb-6 rounded-[2.5rem] overflow-hidden aspect-[4/5] bg-slate-100 shadow-sm transition-all duration-500 group-hover:shadow-2xl group-hover:-translate-y-2 border border-slate-100">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=800" alt="Team Member" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 scale-110 group-hover:scale-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute bottom-8 left-8 right-8 translate-y-4 group-hover:translate-y-0 transition-transform duration-500 opacity-0 group-hover:opacity-100">
                            <div class="flex gap-4">
                                <a href="#" class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-orange-primary hover:text-white transition-colors">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-orange-primary hover:text-white transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-slate-900 mb-1 tracking-tight">Priya Verma</h3>
                        <p class="text-orange-primary font-bold uppercase tracking-widest text-[10px] mb-4">Chief Operations Officer</p>
                        <p class="text-slate-500 font-medium leading-relaxed">Expert in operational excellence and project management, ensuring seamless delivery of large-scale projects.</p>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="group">
                    <div class="relative mb-6 rounded-[2.5rem] overflow-hidden aspect-[4/5] bg-slate-100 shadow-sm transition-all duration-500 group-hover:shadow-2xl group-hover:-translate-y-2 border border-slate-100">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=800" alt="Team Member" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 scale-110 group-hover:scale-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute bottom-8 left-8 right-8 translate-y-4 group-hover:translate-y-0 transition-transform duration-500 opacity-0 group-hover:opacity-100">
                            <div class="flex gap-4">
                                <a href="#" class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-orange-primary hover:text-white transition-colors">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-orange-primary hover:text-white transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-slate-900 mb-1 tracking-tight">Vikram Singh</h3>
                        <p class="text-orange-primary font-bold uppercase tracking-widest text-[10px] mb-4">Lead Structural Engineer</p>
                        <p class="text-slate-500 font-medium leading-relaxed">Specialized in high-performance structures and sustainable engineering solutions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Our Team CTA -->
    <section class="py-24 bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-orange-primary/20 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-8 tracking-tight">Become Part of Our Excellence</h2>
                    <p class="text-slate-400 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">We are always looking for passionate architects, engineers, and project managers to join our growing family.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('contact') }}" class="w-full sm:w-auto px-10 py-4 bg-orange-primary text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-orange-500/20">Join Our Team</a>
                        <a href="{{ route('about') }}" class="w-full sm:w-auto px-10 py-4 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-700 transition-all border border-slate-700">Learn About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
