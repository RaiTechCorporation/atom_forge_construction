@extends('layouts.public')

@section('content')
    <!-- Refined Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100/50 border border-orange-100 text-orange-700 text-xs font-bold uppercase tracking-wider mb-6">
                Eco-Conscious
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                Sustainable Building
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto font-medium">
                Eco-friendly construction practices and smart planning for structures that are built to last.
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
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">Building for a Greener Future</h2>
                    <p class="text-slate-500 text-lg mb-8 leading-relaxed font-medium">
                        Atom Forge Construction is committed to sustainable building practices that minimize environmental impact while maximizing energy efficiency and occupant comfort. We integrate eco-friendly materials and innovative technologies into our construction processes.
                    </p>
                    <p class="text-slate-500 text-lg mb-8 leading-relaxed font-medium">
                        Our sustainable building solutions are designed to be cost-effective in the long run, providing our clients with durable and environmentally responsible structures. We help you reduce your carbon footprint while increasing property value.
                    </p>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                        @foreach(['Energy Efficient Design', 'Sustainable Material Sourcing', 'Water Conservation Systems', 'Solar Power Integration', 'Green Roof Technology', 'Smart HVAC Systems', 'Waste Reduction Management', 'Energy Audits'] as $item)
                        <li class="flex items-center gap-3 text-slate-700 font-semibold">
                            <div class="w-5 h-5 rounded-full bg-orange-100 flex items-center justify-center text-orange-primary">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-orange-primary text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-orange-500/20">
                        Go Green with Us
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                <div class="order-1 md:order-2 relative">
                    <div class="absolute -inset-4 bg-orange-primary/5 rounded-[2.5rem] blur-2xl -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1200" alt="Sustainable Building" class="rounded-[2rem] shadow-2xl border border-slate-100">
                </div>
            </div>

            <!-- Key Features Grid -->
            <div class="mb-32">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Sustainability Benefits</h2>
                    <p class="text-slate-500 max-w-2xl mx-auto">Eco-friendly building isn't just good for the planet; it's a smart financial and health investment for you.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-200 transition-colors group">
                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-orange-primary mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-bolt-lightning text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Lower Utility Costs</h3>
                        <p class="text-slate-500 leading-relaxed">High-efficiency insulation, LED lighting, and solar integration can reduce your monthly energy bills by up to 40%.</p>
                    </div>
                    <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-200 transition-colors group">
                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-orange-primary mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-heart-pulse text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Healthier Environment</h3>
                        <p class="text-slate-500 leading-relaxed">Using non-toxic, low-VOC materials and advanced air filtration systems ensures better indoor air quality for occupants.</p>
                    </div>
                    <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-200 transition-colors group">
                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-orange-primary mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-earth-americas text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Future Proofing</h3>
                        <p class="text-slate-500 leading-relaxed">Stay ahead of environmental regulations and increasing energy costs with a structure built for long-term resilience.</p>
                    </div>
                </div>
            </div>

            <!-- Sustainable Process -->
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-white overflow-hidden relative">
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-500/10 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <div class="relative z-10">
                    <div class="text-center mb-20">
                        <span class="text-emerald-400 font-bold uppercase tracking-widest text-sm mb-4 block">Our Green Workflow</span>
                        <h2 class="text-3xl md:text-5xl font-extrabold mb-6 tracking-tight">Sustainable Implementation</h2>
                        <p class="text-slate-400 max-w-2xl mx-auto">We integrate sustainability into every phase of the project, not just as an afterthought.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">01</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Eco-Audit</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Assessment of site conditions and requirements to identify maximum sustainability potential.</p>
                        </div>
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">02</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Passive Design</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Architectural planning that leverages natural light and ventilation to minimize energy needs.</p>
                        </div>
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">03</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Green Sourcing</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Procuring renewable materials and high-efficiency systems from certified sustainable vendors.</p>
                        </div>
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">04</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Monitoring</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Setting up smart systems to monitor and optimize energy and water usage post-occupancy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-orange-primary/20 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-8 tracking-tight">Ready to build sustainably?</h2>
                    <p class="text-slate-400 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">Contact Atom Forge Construction to learn how we can make your next project more eco-friendly and energy-efficient.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('contact') }}" class="w-full sm:w-auto px-10 py-4 bg-orange-primary text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-orange-500/20">Join the Green Movement</a>
                        <a href="{{ route('services') }}" class="w-full sm:w-auto px-10 py-4 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-700 transition-all border border-slate-700">All Services</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
