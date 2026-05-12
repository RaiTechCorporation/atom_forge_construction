@extends('layouts.public')

@section('content')
    <!-- Refined Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100/50 border border-orange-100 text-orange-700 text-xs font-bold uppercase tracking-wider mb-6">
                Business Growth
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                Commercial Development
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto font-medium">
                Large-scale commercial projects that combine modern engineering with efficient execution.
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
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200" alt="Commercial Development" class="rounded-[2rem] shadow-2xl border border-slate-100">
                </div>
                <div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">Innovative Spaces for Business Success</h2>
                    <p class="text-slate-500 text-lg mb-8 leading-relaxed font-medium">
                        Atom Forge Construction specializes in creating commercial spaces that are not only architecturally stunning but also highly functional. We understand the unique requirements of modern businesses and deliver solutions that enhance productivity and brand value.
                    </p>
                    <p class="text-slate-500 text-lg mb-8 leading-relaxed font-medium">
                        From office complexes and retail centers to hospitality projects, we manage every aspect of the development process to ensure timely delivery and superior quality.
                    </p>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                        @foreach(['Office Complex Development', 'Retail & Shopping Centers', 'Hospitality & Hotels', 'Mixed-use Developments', 'IT Parks & Hubs', 'Medical Facilities'] as $item)
                        <li class="flex items-center gap-3 text-slate-700 font-semibold">
                            <div class="w-5 h-5 rounded-full bg-orange-100 flex items-center justify-center text-orange-primary">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-orange-primary text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-orange-500/20">
                        Discuss Your Project
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Key Features Grid -->
            <div class="mb-32">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Strategic Commercial Solutions</h2>
                    <p class="text-slate-500 max-w-2xl mx-auto">Our approach to commercial development is centered around maximizing your ROI through smart engineering and strategic planning.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-200 transition-colors group">
                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-orange-primary mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-chart-line text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">ROI Focused Design</h3>
                        <p class="text-slate-500 leading-relaxed">Designing spaces that optimize usable area and incorporate features that increase property value and tenant retention.</p>
                    </div>
                    <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-200 transition-colors group">
                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-orange-primary mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-clock-history text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Rapid Execution</h3>
                        <p class="text-slate-500 leading-relaxed">Advanced project management techniques to ensure your business space is ready for occupancy on or ahead of schedule.</p>
                    </div>
                    <div class="p-10 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-200 transition-colors group">
                        <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-orange-primary mb-6 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-microchip text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Smart Infrastructure</h3>
                        <p class="text-slate-500 leading-relaxed">Future-ready buildings with integrated smart systems for energy management, security, and connectivity.</p>
                    </div>
                </div>
            </div>

            <!-- Commercial Development Process -->
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-white overflow-hidden relative">
                <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-primary/10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <div class="relative z-10">
                    <div class="text-center mb-20">
                        <span class="text-orange-primary font-bold uppercase tracking-widest text-sm mb-4 block">Development Lifecycle</span>
                        <h2 class="text-3xl md:text-5xl font-extrabold mb-6 tracking-tight">Our Commercial Roadmap</h2>
                        <p class="text-slate-400 max-w-2xl mx-auto">From site analysis to occupancy, we manage every detail of the commercial development lifecycle.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">01</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Site Analysis</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Feasibility studies and site evaluations to ensure the location matches your commercial goals.</p>
                        </div>
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">02</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Strategic Design</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Creating architectural plans that balance aesthetic appeal with operational efficiency.</p>
                        </div>
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">03</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Agile Building</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Constructing with high-efficiency methods to meet strict commercial deadlines and standards.</p>
                        </div>
                        <div class="relative">
                            <div class="text-6xl font-black text-white/10 absolute -top-10 -left-4">04</div>
                            <h4 class="text-xl font-bold mb-4 relative z-10">Ready for Business</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Final handover with all certifications, ready for immediate business operations or leasing.</p>
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
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-8 tracking-tight">Looking for a reliable development partner?</h2>
                    <p class="text-slate-400 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-medium">Partner with Atom Forge Construction for your next commercial development project. Let's build the future together.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('contact') }}" class="w-full sm:w-auto px-10 py-4 bg-orange-primary text-white font-bold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-orange-500/20">Get Started</a>
                        <a href="{{ route('services') }}" class="w-full sm:w-auto px-10 py-4 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-700 transition-all border border-slate-700">All Services</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
