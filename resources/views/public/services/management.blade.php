@extends('layouts.public')

@section('content')
    <!-- Refined Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100/50 border border-orange-100 text-orange-700 text-xs font-bold uppercase tracking-wider mb-6">
                Expert Oversight
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                Project Management
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto font-medium">
                Reliable end-to-end management ensuring timely delivery and commitment to excellence.
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
                <div class="relative">
                    <div class="absolute -inset-4 bg-orange-primary/5 rounded-[2.5rem] blur-2xl -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=1200" alt="Project Management" class="rounded-[2rem] shadow-2xl border border-slate-100">
                </div>
                <div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">Seamless Execution from Start to Finish</h2>
                    <p class="text-slate-500 text-lg mb-8 leading-relaxed font-medium">
                        Atom Forge Construction offers professional project management services to ensure that your construction projects are completed on time, within budget, and to the highest quality standards. Our experienced project managers handle every detail of the construction process.
                    </p>
                    <p class="text-slate-500 text-lg mb-8 leading-relaxed font-medium">
                        We use advanced project management tools and methodologies to provide transparency and efficiency throughout the project lifecycle, from planning and procurement to construction and final handover. We act as your single point of contact for all project needs.
                    </p>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                        @foreach(['Comprehensive Project Planning', 'Budget & Cost Management', 'Quality Control & Assurance', 'Timeline & Schedule Tracking', 'Vendor & Subcontractor Coordination', 'Risk Mitigation & Management', 'Permit & Regulatory Liaison', 'Site Supervision'] as $item)
                        <li class="flex items-center gap-3 text-slate-700 font-semibold">
                            <div class="w-5 h-5 rounded-full bg-orange-100 flex items-center justify-center text-orange-primary">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-orange-primary text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-orange-500/20">
                        Manage Your Project
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Key Features Grid -->
            <div class="mb-32">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Management Excellence</h2>
                    <p class="text-slate-500 max-w-2xl mx-auto">Our management services provide the clarity and control you need to ensure project success without the stress.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-200 transition-colors group">
                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-orange-primary mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-eye text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Full Transparency</h3>
                        <p class="text-slate-500 leading-relaxed">Regular, detailed reporting on budget, timeline, and quality metrics so you're always in the loop.</p>
                    </div>
                    <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-200 transition-colors group">
                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-orange-primary mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-coins text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Cost Optimization</h3>
                        <p class="text-slate-500 leading-relaxed">Aggressive procurement management and waste reduction strategies to keep your project within budget.</p>
                    </div>
                    <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-200 transition-colors group">
                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-orange-primary mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-handshake text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Vendor Accountability</h3>
                        <p class="text-slate-500 leading-relaxed">Strict oversight of all subcontractors to ensure they meet our high standards of quality and safety.</p>
                    </div>
                </div>
            </div>

            <!-- Management Process -->
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-white overflow-hidden relative">
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-primary/10 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <div class="relative z-10">
                    <div class="text-center mb-20">
                        <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">Our Methodology</span>
                        <h2 class="text-3xl md:text-5xl font-extrabold mb-6 tracking-tight">How We Manage Success</h2>
                        <p class="text-slate-400 max-w-2xl mx-auto">A rigorous management framework designed for high-performance delivery.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">01</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Pre-Construction</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Detailed budgeting, scheduling, and procurement strategy before ground-breaking.</p>
                        </div>
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">02</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Coordination</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Managing day-to-day logistics, labor, and material flows on the construction site.</p>
                        </div>
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">03</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Quality Control</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Continuous inspections to ensure every phase of the project meets specifications.</p>
                        </div>
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">04</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Close-Out</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Managing final inspections, certifications, and project documentation for a smooth handover.</p>
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
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-8 tracking-tight">Need expert project management?</h2>
                    <p class="text-slate-400 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">Let Atom Forge Construction manage your next construction project for a hassle-free and successful delivery.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('contact') }}" class="w-full sm:w-auto px-10 py-4 bg-orange-primary text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-orange-500/20">Talk to a Project Manager</a>
                        <a href="{{ route('services') }}" class="w-full sm:w-auto px-10 py-4 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-700 transition-all border border-slate-700">All Services</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
