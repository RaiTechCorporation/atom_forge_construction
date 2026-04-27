@extends('layouts.public')

@section('content')
    <!-- Refined Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100/50 border border-blue-100 text-blue-700 text-xs font-bold uppercase tracking-wider mb-6">
                Our Expertise
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                {{ $content['services_hero_title'] ?? 'Our Services' }}
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto font-medium">
                {{ $content['services_hero_subtitle'] ?? 'Atom Forge Construction delivers end-to-end building solutions with unmatched quality, speed, and precision from concept to completion.' }}
            </p>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none -z-10">
            <div class="absolute top-[-20%] left-[-10%] w-[30%] h-[60%] bg-blue-50 rounded-full blur-[100px] opacity-50"></div>
        </div>
    </section>

    <!-- Detailed Services List -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-32">
            <!-- Service 1: Construction -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 lg:gap-24 items-center">
                <div class="order-2 md:order-1">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-8 text-blue-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">Residential & Commercial Construction</h2>
                    <p class="text-slate-500 text-lg mb-8 leading-relaxed font-medium">We specialize in building houses, villas, and commercial complexes that stand the test of time. Our construction process is characterized by meticulous planning and high-quality craftsmanship.</p>
                    <ul class="space-y-4">
                        @foreach(['Foundation and Structure', 'Masonry and Brickwork', 'Electrical and Plumbing', 'Roofing and Finishing'] as $item)
                        <li class="flex items-center gap-3 text-slate-700 font-semibold">
                            <div class="w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="order-1 md:order-2 relative">
                    <div class="absolute -inset-4 bg-blue-600/5 rounded-[2.5rem] blur-2xl -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=1200" alt="Construction Service" class="rounded-[2rem] shadow-2xl border border-slate-100">
                </div>
            </div>

            <!-- Service 2: Interiors -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 lg:gap-24 items-center">
                <div class="relative">
                    <div class="absolute -inset-4 bg-indigo-600/5 rounded-[2.5rem] blur-2xl -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&q=80&w=1200" alt="Interior Service" class="rounded-[2rem] shadow-2xl border border-slate-100">
                </div>
                <div>
                    <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mb-8 text-indigo-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">Interior Design & Decoration</h2>
                    <p class="text-slate-500 text-lg mb-8 leading-relaxed font-medium">Transform your living or working space with our custom interior solutions. We combine functionality with aesthetics to create beautiful and productive environments.</p>
                    <ul class="space-y-4">
                        @foreach(['Modular Kitchens', 'False Ceiling and Lighting', 'Custom Furniture', 'Wall Decor and Painting'] as $item)
                        <li class="flex items-center gap-3 text-slate-700 font-semibold">
                            <div class="w-5 h-5 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Service 3: Turnkey -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 lg:gap-24 items-center">
                <div class="order-2 md:order-1">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-8 text-blue-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">End-to-End Turnkey Projects</h2>
                    <p class="text-slate-500 text-lg mb-8 leading-relaxed font-medium">Leveraging cutting-edge technology and smart planning, we deliver construction solutions that are scalable, sustainable, and built to last. Our team ensures precision and perfection in every turnkey project.</p>
                    <ul class="space-y-4">
                        @foreach(['Design and Planning', 'Project Management', 'Material Procurement', 'Final Handover'] as $item)
                        <li class="flex items-center gap-3 text-slate-700 font-semibold">
                            <div class="w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="order-1 md:order-2 relative">
                    <div class="absolute -inset-4 bg-blue-600/5 rounded-[2.5rem] blur-2xl -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1541888946425-d81bb19480c5?auto=format&fit=crop&q=80&w=1200" alt="Turnkey Projects" class="rounded-[2rem] shadow-2xl border border-slate-100">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-blue-600/20 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-8 tracking-tight">Need a Custom Solution?</h2>
                    <p class="text-slate-400 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">We provide tailored services that fit your specific project requirements. Our experts are ready to discuss your ideas.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('contact') }}" class="w-full sm:w-auto px-10 py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/20">Request a Quote</a>
                        <a href="{{ route('home') }}" class="w-full sm:w-auto px-10 py-4 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-700 transition-all border border-slate-700">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
