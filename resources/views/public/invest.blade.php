@extends('layouts.public')

@push('styles')
    <style>
        .btn-pill {
            border-radius: 9999px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-pill:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(238, 90, 36, 0.3);
        }
        /* Ensure theme colors are available even if Tailwind hasn't recompiled */
        .text-orange-construction, .text-orange-primary {
            color: #EE5A24 !important;
        }
        .bg-orange-construction, .bg-orange-primary {
            background-color: #EE5A24 !important;
        }
        .border-orange-construction, .border-orange-primary {
            border-color: #EE5A24 !important;
        }
        .shadow-orange-primary\/25 {
            --tw-shadow-color: rgba(238, 90, 36, 0.25);
            --tw-shadow: var(--tw-shadow-intro,0 0 #0000),var(--tw-shadow-intro,0 0 #0000),0 20px 25px -5px var(--tw-shadow-color),0 8px 10px -6px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        }
        .shadow-orange-primary\/30 {
            --tw-shadow-color: rgba(238, 90, 36, 0.3);
            --tw-shadow: var(--tw-shadow-intro,0 0 #0000),var(--tw-shadow-intro,0 0 #0000),0 20px 25px -5px var(--tw-shadow-color),0 8px 10px -6px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        }
        .bg-orange-construction\/10 {
            background-color: rgba(238, 90, 36, 0.1) !important;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-floating {
            animation: floating 3s ease-in-out infinite;
        }
        .animate-floating-delayed {
            animation: floating 3s ease-in-out infinite;
            animation-delay: 1.5s;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-black">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=2000" alt="Construction Investment" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-b from-black via-black/80 to-black"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight mb-8">
                Invest in the <span class="text-orange-construction">Future</span> of Infrastructure
            </h1>
            <p class="text-xl text-slate-100 mb-12 max-w-2xl mx-auto font-medium leading-relaxed drop-shadow-sm">
                Join Atom Forge Construction in building world-class residential and commercial projects. Secure, transparent, and high-yield investment opportunities.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ route('investor.register.create') }}" class="px-10 py-5 bg-orange-construction text-white font-bold btn-pill shadow-xl shadow-orange-primary/25">
                        Create Investor Profile
                    </a>
                @else
                    <a href="{{ route('register', ['type' => 'investor']) }}" class="px-10 py-5 bg-orange-construction text-white font-bold btn-pill shadow-xl shadow-orange-primary/25">
                        Start Investing Now
                    </a>
                    <a href="{{ route('login') }}" class="px-10 py-5 bg-white/10 text-white font-bold btn-pill hover:bg-white/20 transition-all border border-white/20">
                        Sign In to Your Account
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Why Invest Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-black mb-4 uppercase tracking-wider">Why Invest With Us?</h2>
                <div class="w-20 h-1.5 bg-orange-construction mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="p-8 rounded-3xl bg-gray-50 border border-gray-100 text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-orange-50 text-orange-construction rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-black mb-4">Secure Assets</h3>
                    <p class="text-gray-500 font-medium">All investments are backed by physical real estate assets and rigorous legal frameworks.</p>
                </div>

                <div class="p-8 rounded-3xl bg-gray-50 border border-gray-100 text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-orange-50 text-orange-construction rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-black mb-4">High Returns</h3>
                    <p class="text-gray-500 font-medium">Competitive ROI driven by strategic project selection and efficient execution.</p>
                </div>

                <div class="p-8 rounded-3xl bg-gray-50 border border-gray-100 text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-orange-50 text-orange-construction rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-black mb-4">Real-time Tracking</h3>
                    <p class="text-gray-500 font-medium">Monitor project progress and financial updates through our dedicated Investor Portal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Potential Growth Section -->
    <section class="py-24 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative py-12 px-4 md:px-8">
                    <div class="absolute top-0 left-0 w-40 h-40 bg-orange-construction/10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 right-0 w-40 h-40 bg-orange-construction/10 rounded-full blur-3xl"></div>
                    <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=1200" alt="Potential Growth" class="relative z-10 rounded-3xl shadow-2xl w-full">
                    
                    <div class="relative md:absolute md:top-4 md:-right-4 bg-white p-6 rounded-2xl shadow-xl z-20 border border-gray-100 animate-floating mt-8 md:mt-0">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-black text-white rounded-full flex items-center justify-center font-bold text-xl">25+</div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Active</p>
                                <p class="text-sm font-black text-black">Projects</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative md:absolute md:bottom-4 md:-left-4 bg-white p-6 rounded-2xl shadow-xl z-20 border border-gray-100 animate-floating-delayed mt-4 md:mt-0">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-orange-construction text-white rounded-full flex items-center justify-center font-bold text-xl">15%</div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Projected</p>
                                <p class="text-sm font-black text-black">Annual Growth</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative md:absolute md:bottom-1/4 md:-right-6 bg-white p-6 rounded-2xl shadow-xl z-20 border border-gray-100 animate-floating mt-4 md:mt-0">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-orange-construction/10 text-orange-construction rounded-full flex items-center justify-center font-bold text-xl">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Trusted by</p>
                                <p class="text-sm font-black text-black">500+ Investors</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-3xl md:text-5xl font-black text-black mb-8 leading-tight">
                        Fueling Growth Through <span class="text-orange-construction">Innovation</span> & Strategy
                    </h2>
                    <p class="text-gray-600 text-lg mb-10 leading-relaxed">
                        Atom Forge Construction is positioned at the intersection of traditional craftsmanship and modern technology. Our growth strategy is built on solid market analysis and scalable execution models.
                    </p>

                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-white text-orange-construction rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-black mb-1">Strategic Urban Development</h4>
                                <p class="text-gray-500">Focusing on emerging satellite cities and high-growth corridors with massive infrastructure demand.</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-white text-orange-construction rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-black mb-1">Smart Construction Technology</h4>
                                <p class="text-gray-500">Implementing AI-driven project management and modular building techniques to maximize efficiency.</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-white text-orange-construction rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9 a9 9 0 019-9"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-black mb-1">Sustainable & Green Energy</h4>
                                <p class="text-gray-500">Leading the shift towards eco-friendly builds, tapping into the rapidly expanding green real estate market.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Market Outlook Section -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <span class="text-orange-construction font-bold uppercase tracking-widest text-sm mb-4 block">Market Insights</span>
                    <h2 class="text-3xl md:text-5xl font-black text-black mb-8 leading-tight">Construction Sector <span class="text-orange-construction">Opportunity</span></h2>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        The infrastructure and real estate sector remains one of the most stable and high-growth investment avenues globally. Urbanization trends and industrial expansion are driving unprecedented demand for quality construction.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="text-3xl font-black text-orange-construction mb-2">$12T+</div>
                            <p class="text-sm font-bold text-black uppercase tracking-wider">Global Market Size</p>
                            <p class="text-xs text-gray-500 mt-1">Projected construction output by 2030</p>
                        </div>
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="text-3xl font-black text-orange-construction mb-2">7.2%</div>
                            <p class="text-sm font-bold text-black uppercase tracking-wider">CAGR</p>
                            <p class="text-xs text-gray-500 mt-1">Annual growth in residential sector</p>
                        </div>
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="text-3xl font-black text-orange-construction mb-2">85%</div>
                            <p class="text-sm font-bold text-black uppercase tracking-wider">Urbanization</p>
                            <p class="text-xs text-gray-500 mt-1">Population moving to cities by 2050</p>
                        </div>
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="text-3xl font-black text-orange-construction mb-2">40%</div>
                            <p class="text-sm font-bold text-black uppercase tracking-wider">Green Building</p>
                            <p class="text-xs text-gray-500 mt-1">Growth in sustainable infrastructure</p>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=1200" alt="Market Analysis" class="rounded-3xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Highlights Section -->
    <section class="py-24 bg-gray-900 text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div class="max-w-2xl">
                    <span class="text-orange-construction font-bold uppercase tracking-widest text-sm mb-4 block">Our Portfolio</span>
                    <h2 class="text-3xl md:text-5xl font-black mb-6">Investment-Ready <span class="text-orange-construction">Projects</span></h2>
                    <p class="text-gray-400 text-lg">
                        Explore our current and upcoming projects that offer diverse investment profiles across residential, commercial, and industrial segments.
                    </p>
                </div>
                <a href="{{ route('projects') }}" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-bold rounded-full transition-all border border-white/20 whitespace-nowrap">
                    VIEW FULL PORTFOLIO
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group relative overflow-hidden rounded-3xl aspect-[4/5]">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=800" alt="Residential Project" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-90 p-8 flex flex-col justify-end">
                        <span class="inline-block px-3 py-1 bg-orange-construction text-white text-[10px] font-bold uppercase tracking-widest rounded mb-4 w-fit">Residential</span>
                        <h4 class="text-2xl font-bold mb-2">Zenith Heights</h4>
                        <p class="text-gray-300 text-sm mb-6">Luxury high-rise residential complex in the heart of the business district.</p>
                        <div class="flex justify-between items-center pt-6 border-t border-white/10">
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Target ROI</p>
                                <p class="text-lg font-black text-orange-construction">18.5%</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Progress</p>
                                <p class="text-lg font-black">45%</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-3xl aspect-[4/5]">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=800" alt="Commercial Project" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-90 p-8 flex flex-col justify-end">
                        <span class="inline-block px-3 py-1 bg-orange-construction text-white text-[10px] font-bold uppercase tracking-widest rounded mb-4 w-fit">Commercial</span>
                        <h4 class="text-2xl font-bold mb-2">Forge Tech Plaza</h4>
                        <p class="text-gray-300 text-sm mb-6">Modern IT hub and commercial space designed for global tech giants.</p>
                        <div class="flex justify-between items-center pt-6 border-t border-white/10">
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Target ROI</p>
                                <p class="text-lg font-black text-orange-construction">21.2%</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Progress</p>
                                <p class="text-lg font-black">15%</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-3xl aspect-[4/5]">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=800" alt="Industrial Project" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-90 p-8 flex flex-col justify-end">
                        <span class="inline-block px-3 py-1 bg-orange-construction text-white text-[10px] font-bold uppercase tracking-widest rounded mb-4 w-fit">Industrial</span>
                        <h4 class="text-2xl font-bold mb-2">Nexus Logistics Park</h4>
                        <p class="text-gray-300 text-sm mb-6">Smart warehousing and logistics infrastructure for the e-commerce era.</p>
                        <div class="flex justify-between items-center pt-6 border-t border-white/10">
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Target ROI</p>
                                <p class="text-lg font-black text-orange-construction">15.8%</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Progress</p>
                                <p class="text-lg font-black">78%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Investment Process Section -->
    <section class="py-24 bg-black text-white overflow-hidden relative">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-orange-construction/5 -skew-x-12 transform translate-x-20"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black mb-4 uppercase tracking-wider">How to Get Started</h2>
                <div class="w-20 h-1.5 bg-orange-construction mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="relative text-center">
                    <div class="w-16 h-16 bg-white/10 border border-white/20 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-black text-orange-construction relative z-10">1</div>
                    <div class="hidden md:block absolute top-8 left-[calc(50%+32px)] w-full h-[2px] bg-gradient-to-r from-orange-construction/50 to-transparent"></div>
                    <h4 class="text-xl font-bold mb-3">Register</h4>
                    <p class="text-gray-400 text-sm">Create your investor profile and verify your identity.</p>
                </div>

                <div class="relative text-center">
                    <div class="w-16 h-16 bg-white/10 border border-white/20 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-black text-orange-construction relative z-10">2</div>
                    <div class="hidden md:block absolute top-8 left-[calc(50%+32px)] w-full h-[2px] bg-gradient-to-r from-orange-construction/50 to-transparent"></div>
                    <h4 class="text-xl font-bold mb-3">Browse Projects</h4>
                    <p class="text-gray-400 text-sm">Explore active construction projects and their ROIs.</p>
                </div>

                <div class="relative text-center">
                    <div class="w-16 h-16 bg-white/10 border border-white/20 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-black text-orange-construction relative z-10">3</div>
                    <div class="hidden md:block absolute top-8 left-[calc(50%+32px)] w-full h-[2px] bg-gradient-to-r from-orange-construction/50 to-transparent"></div>
                    <h4 class="text-xl font-bold mb-3">Invest</h4>
                    <p class="text-gray-400 text-sm">Choose your project and allocate funds securely.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-construction rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-black text-white shadow-lg shadow-orange-primary/40">4</div>
                    <h4 class="text-xl font-bold mb-3">Earn Returns</h4>
                    <p class="text-gray-400 text-sm">Receive payouts and track progress in real-time.</p>
                </div>
            </div>

            <div class="mt-20 text-center">
                <a href="{{ route('register', ['type' => 'investor']) }}" class="inline-flex items-center gap-3 px-10 py-5 bg-orange-construction text-white font-bold btn-pill shadow-xl shadow-orange-primary/30">
                    JOIN THE NETWORK
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>
    <!-- Investor FAQ Section -->
    <section class="py-24 bg-white" x-data="{ activeFaq: null }">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-orange-construction font-bold uppercase tracking-widest text-sm mb-4 block">Information</span>
                <h2 class="text-3xl md:text-4xl font-black text-black mb-6">Investor <span class="text-orange-construction">FAQ</span></h2>
                <p class="text-gray-500">Common questions about our investment process and security.</p>
            </div>

            <div class="space-y-4">
                <div class="border border-gray-100 rounded-2xl overflow-hidden">
                    <button @click="activeFaq === 1 ? activeFaq = null : activeFaq = 1" class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors">
                        <span class="font-bold text-black">What is the minimum investment amount?</span>
                        <svg class="w-5 h-5 text-orange-construction transition-transform duration-300" :class="activeFaq === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse class="p-6 pt-0 text-gray-600 border-t border-gray-100">
                        The minimum investment varies by project, typically starting at ₹5,00,000. This allows us to maintain a high-quality pool of committed partners.
                    </div>
                </div>

                <div class="border border-gray-100 rounded-2xl overflow-hidden">
                    <button @click="activeFaq === 2 ? activeFaq = null : activeFaq = 2" class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors">
                        <span class="font-bold text-black">How are my funds secured?</span>
                        <svg class="w-5 h-5 text-orange-construction transition-transform duration-300" :class="activeFaq === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse class="p-6 pt-0 text-gray-600 border-t border-gray-100">
                        Funds are held in project-specific escrow accounts and are allocated only as project milestones are achieved, verified by third-party auditors.
                    </div>
                </div>

                <div class="border border-gray-100 rounded-2xl overflow-hidden">
                    <button @click="activeFaq === 3 ? activeFaq = null : activeFaq = 3" class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors">
                        <span class="font-bold text-black">When do I receive my returns?</span>
                        <svg class="w-5 h-5 text-orange-construction transition-transform duration-300" :class="activeFaq === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse class="p-6 pt-0 text-gray-600 border-t border-gray-100">
                        Returns are typically distributed semi-annually or upon completion of specific project phases, as outlined in the investment agreement.
                    </div>
                </div>

                <div class="border border-gray-100 rounded-2xl overflow-hidden">
                    <button @click="activeFaq === 4 ? activeFaq = null : activeFaq = 4" class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors">
                        <span class="font-bold text-black">Can I visit the project sites?</span>
                        <svg class="w-5 h-5 text-orange-construction transition-transform duration-300" :class="activeFaq === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse class="p-6 pt-0 text-gray-600 border-t border-gray-100">
                        Yes, we encourage our investors to schedule site visits. Transparency is one of our core values, and we provide regular updates through our investor portal.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="py-24 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-5xl font-black text-black mb-8">Ready to Build Your <span class="text-orange-construction">Legacy</span>?</h2>
            <p class="text-gray-600 text-lg mb-10 max-w-2xl mx-auto">
                Join a network of professional investors who trust Atom Forge Construction for excellence, transparency, and growth.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register', ['type' => 'investor']) }}" class="px-10 py-5 bg-orange-construction text-white font-bold btn-pill shadow-xl shadow-orange-primary/25">
                    GET STARTED NOW
                </a>
                <a href="{{ route('contact') }}" class="px-10 py-5 bg-white text-black font-bold btn-pill border border-gray-200 hover:bg-gray-50 transition-all">
                    TALK TO AN EXPERT
                </a>
            </div>
        </div>
    </section>
@endsection
