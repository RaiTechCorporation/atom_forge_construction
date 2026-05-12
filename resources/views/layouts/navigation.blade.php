<nav class="bg-white/70 backdrop-blur-xl border-b border-slate-200/60 fixed top-0 left-0 md:left-[280px] w-full md:w-[calc(100%-280px)] h-[60px] z-[60] shadow-sm shadow-slate-200/20">
    <!-- Primary Navigation Menu -->
    <div class="px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex justify-between h-full">
            <!-- Left Side: Mobile Toggle & Context -->
            <div class="flex items-center gap-6">
                <button @click="sidebarOpen = true" class="inline-flex items-center justify-center p-2.5 rounded-xl text-slate-600 hover:bg-slate-100/80 transition-all md:hidden border border-transparent hover:border-slate-200">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                
                <div class="hidden md:flex items-center gap-3 text-sm">
                    <div class="px-2.5 py-1 bg-slate-50 border border-slate-100 rounded-lg text-[10px] font-black uppercase tracking-widest text-slate-400">
                        @if(request()->routeIs('investor.*'))
                            Investor Panel
                        @elseif(Auth::user()->isSiteSupervisor())
                            Supervisor Portal
                        @elseif(Auth::user()->isAdmin())
                            Administration
                        @else
                            Client Portal
                        @endif
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg>
                    <span class="text-slate-900 font-black tracking-tight">{{ request()->route()->getName() ? ucwords(str_replace(['.', '-'], ' ', explode('.', request()->route()->getName())[0])) : 'Dashboard' }}</span>
                </div>
            </div>

            <!-- Right Side: Utility Links -->
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-indigo-600 transition-all group">
                    View Portal
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>

                <div class="h-4 w-px bg-slate-200 hidden sm:block"></div>

                <!-- Settings Dropdown -->
                <div class="hidden md:block">
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-4 px-1.5 py-1.5 hover:bg-slate-50 rounded-2xl transition-all group border border-transparent hover:border-slate-100">
                                <div class="flex flex-col items-end">
                                    <span class="text-xs font-black text-slate-900 leading-tight group-hover:text-indigo-600 transition-colors">{{ Auth::user()->name }}</span>
                                    <span class="text-[9px] font-black text-slate-400 leading-tight uppercase tracking-tighter">
                                        @if(request()->routeIs('investor.*') || Auth::user()->isInvestor())
                                            Investor
                                        @elseif(Auth::user()->isSuperAdmin())
                                            Super Admin
                                        @elseif(Auth::user()->isSiteSupervisor())
                                            Site Supervisor
                                        @elseif(Auth::user()->isAdminStaff())
                                            Staff
                                        @else
                                            Client
                                        @endif
                                    </span>
                                </div>
                                <div class="w-9 h-9 rounded-xl bg-slate-900 flex items-center justify-center text-white font-black text-xs ring-4 ring-white shadow-lg shadow-slate-900/10 group-hover:bg-indigo-600 transition-colors overflow-hidden">
                                    @if(Auth::user()->profile_picture)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    @endif
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="p-1">
                                <x-dropdown-link :href="route('profile.edit')" class="rounded-md text-slate-700 hover:bg-slate-50">
                                    {{ __('Profile Settings') }}
                                </x-dropdown-link>

                                @if(!auth()->user()->investor && !auth()->user()->isSiteSupervisor())
                                    <x-dropdown-link :href="route('investor.register.create')" class="rounded-md text-emerald-600 hover:bg-emerald-50 font-bold">
                                        {{ __('Become an Investor') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="my-1 border-t border-slate-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" class="rounded-md text-red-600 hover:bg-red-50"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Logout') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
                
                <!-- Simple Mobile Settings & Logout -->
                <div class="md:hidden flex items-center gap-2">
                    <a href="{{ route('profile.edit') }}" class="p-2 text-slate-600 hover:text-indigo-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="p-2 text-red-500 hover:text-red-700 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
