<!-- Sidebar -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
       x-cloak
       class="fixed top-0 left-0 w-[280px] h-screen bg-[#0f172a] text-slate-400 z-[70] flex flex-col transition-transform duration-300 ease-in-out border-r border-slate-800/40 shadow-2xl">
    
    <!-- Sidebar Logo Section -->
    <div class="h-[60px] flex items-center px-8 border-b border-slate-800/50">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 group">
            <div class="w-8 h-8 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('images/Atom Forge Logo.png For White Background.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <span class="font-black text-lg text-white tracking-tighter uppercase italic">
                Atom<span class="text-indigo-500">Forge</span>
            </span>
        </a>
    </div>

    <div class="p-4 flex-1 overflow-y-auto custom-scrollbar space-y-8">
        <!-- Close Button (Mobile Only) -->
        <button @click="sidebarOpen = false" class="md:hidden absolute top-4 right-4 text-slate-400 hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        @php
            $isInvestorMode = request()->routeIs('investor.*');
        @endphp

        <!-- Main Navigation Group -->
        <div>
            @if(!$isInvestorMode)
                <span class="px-4 text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 block">Core Operations</span>
            @endif
            <nav class="space-y-1">
                @if(!$isInvestorMode)
                    @php
                        $links = [
                            ['name' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'grid'],
                            ['name' => 'Blog Management', 'route' => 'admin.blogs.index', 'icon' => 'news'],
                        ];
                    @endphp

                    @foreach($links as $link)
                        @if(auth()->user()->hasPermission('view-dashboard'))
                            <a href="{{ route($link['route']) }}" 
                            class="group flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs($link['route']) ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <span class="{{ request()->routeIs($link['route']) ? 'text-white' : 'text-slate-600 group-hover:text-slate-200' }}">
                                    @if($link['icon'] == 'grid')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                    @elseif($link['icon'] == 'news')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                                    @endif
                                </span>
                                {{ __($link['name']) }}
                            </a>
                        @endif
                    @endforeach
                @else
                    <!-- Investor Dashboard Link -->
                    <a href="{{ route('investor.dashboard') }}" 
                       class="group flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('investor.dashboard') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <span class="{{ request()->routeIs('investor.dashboard') ? 'text-white' : 'text-slate-600 group-hover:text-slate-200' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </span>
                        {{ __('Dashboard') }}
                    </a>

                    <!-- Wallet Balance (Prominent) -->
                    @if(Auth::user()->investor)
                    <div class="px-4 py-3 bg-emerald-500/10 rounded-2xl border border-emerald-500/20 mb-2">
                        <div class="flex items-center gap-3">
                            <span class="text-emerald-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </span>
                            <div>
                                <p class="text-[8px] font-black text-emerald-500/60 uppercase tracking-[0.2em] leading-none mb-1">Wallet Balance</p>
                                <p class="text-sm font-black text-emerald-400">₹{{ number_format(Auth::user()->investor->balance, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Wallet Dropdown -->
                    <div x-data="{ walletOpen: {{ request()->routeIs('investor.wallet.*') ? 'true' : 'false' }} }">
                        <button @click="walletOpen = !walletOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('investor.wallet.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('investor.wallet.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </span>
                                {{ __('Wallet') }}
                            </div>
                            <svg :class="walletOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="walletOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            <a href="{{ route('investor.wallet.add-funds') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.wallet.add-funds') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Add Funds</a>
                            <a href="{{ route('investor.transactions.all') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.transactions.all') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Transaction History</a>
                        </div>
                    </div>

                    <!-- Portfolio Dropdown -->
                    <div x-data="{ portfolioOpen: {{ request()->routeIs('investor.portfolio.*') ? 'true' : 'false' }} }">
                        <button @click="portfolioOpen = !portfolioOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('investor.portfolio.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('investor.portfolio.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </span>
                                {{ __('Portfolio') }}
                            </div>
                            <svg :class="portfolioOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="portfolioOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            <a href="{{ route('investor.portfolio.overview') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.portfolio.overview') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Overview</a>
                            <a href="{{ route('investor.portfolio.active') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.portfolio.active') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Active Investments</a>
                            <a href="{{ route('investor.portfolio.completed') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.portfolio.completed') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Completed Investments</a>
                        </div>
                    </div>

                    <!-- Projects Dropdown -->
                    <div x-data="{ projectsOpen: {{ request()->routeIs('investor.projects.*') ? 'true' : 'false' }} }">
                        <button @click="projectsOpen = !projectsOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('investor.projects.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('investor.projects.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </span>
                                {{ __('Projects') }}
                            </div>
                            <svg :class="projectsOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="projectsOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            <a href="{{ route('investor.projects.all') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.projects.all') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">All Projects</a>
                            <a href="{{ route('investor.projects.performance') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.projects.performance') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Project Performance</a>
                        </div>
                    </div>

                    <!-- Earnings Dropdown -->
                    <div x-data="{ earningsOpen: {{ request()->routeIs('investor.earnings.*') ? 'true' : 'false' }} }">
                        <button @click="earningsOpen = !earningsOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('investor.earnings.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('investor.earnings.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </span>
                                {{ __('Earnings') }}
                            </div>
                            <svg :class="earningsOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="earningsOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            <a href="{{ route('investor.earnings.summary') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.earnings.summary') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Earnings Summary</a>
                            <a href="{{ route('investor.earnings.history') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.earnings.history') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Payout History</a>
                            <a href="{{ route('investor.earnings.analytics') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.earnings.analytics') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">ROI Analytics</a>
                        </div>
                    </div>

                    <!-- Transactions Dropdown -->
                    <div x-data="{ transactionsOpen: {{ request()->routeIs('investor.transactions.*') ? 'true' : 'false' }} }">
                        <button @click="transactionsOpen = !transactionsOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('investor.transactions.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('investor.transactions.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </span>
                                {{ __('Transactions') }}
                            </div>
                            <svg :class="transactionsOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="transactionsOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            <a href="{{ route('investor.transactions.all') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.transactions.all') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">All Transactions</a>
                            <a href="{{ route('investor.transactions.history') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.transactions.history') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Investment History</a>
                            <a href="{{ route('investor.transactions.withdrawals') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.transactions.withdrawals') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Withdrawals</a>
                        </div>
                    </div>

                    <!-- Documents Dropdown -->
                    <div x-data="{ documentsOpen: {{ request()->routeIs('investor.documents.*') ? 'true' : 'false' }} }">
                        <button @click="documentsOpen = !documentsOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('investor.documents.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('investor.documents.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                </span>
                                {{ __('Documents') }}
                            </div>
                            <svg :class="documentsOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="documentsOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            <a href="{{ route('investor.documents.agreements') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.documents.agreements') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Agreements</a>
                            <a href="{{ route('investor.documents.reports') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.documents.reports') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Reports</a>
                            <a href="{{ route('investor.documents.receipts') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.documents.receipts') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Receipts</a>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <a href="{{ route('investor.notifications') }}" 
                       class="group flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('investor.notifications') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <span class="{{ request()->routeIs('investor.notifications') ? 'text-white' : 'text-slate-600 group-hover:text-slate-200' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </span>
                        {{ __('Notifications') }}
                    </a>

                    <!-- Support -->
                    <a href="{{ route('investor.support') }}" 
                       class="group flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('investor.support') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        <span class="{{ request()->routeIs('investor.support') ? 'text-white' : 'text-slate-600 group-hover:text-slate-200' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </span>
                        {{ __('Support') }}
                    </a>

                    <!-- Profile Dropdown -->
                    <div x-data="{ profileOpen: {{ request()->routeIs('investor.profile.*') ? 'true' : 'false' }} }">
                        <button @click="profileOpen = !profileOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('investor.profile.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('investor.profile.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </span>
                                {{ __('Profile') }}
                            </div>
                            <svg :class="profileOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="profileOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            <a href="{{ route('investor.profile.info') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.profile.info') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Personal Info</a>
                            <a href="{{ route('investor.profile.bank') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.profile.bank') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Bank Details</a>
                            <a href="{{ route('investor.profile.security') }}" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investor.profile.security') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">Security Settings</a>
                        </div>
                    </div>
                @endif
            </nav>
        </div>

        <!-- Management Modules Group -->
        @if(auth()->user()->isAdmin() && !$isInvestorMode)
        <div>
            <span class="px-4 text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 block">Asset Management</span>
            <nav class="space-y-1">
                @unless(auth()->user()->isSiteSupervisor())
                @if(auth()->user()->hasPermission('view-payroll'))
                <!-- Investors Dropdown -->
                    <div x-data="{ investorsDropdownOpen: {{ request()->routeIs('investors.*') || request()->routeIs('investments.*') || request()->routeIs('payouts.*') || request()->routeIs('fund-requests.*') ? 'true' : 'false' }} }">
                        <button @click="investorsDropdownOpen = !investorsDropdownOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('investors.*') || request()->routeIs('investments.*') || request()->routeIs('payouts.*') || request()->routeIs('fund-requests.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('investors.*') || request()->routeIs('investments.*') || request()->routeIs('payouts.*') || request()->routeIs('fund-requests.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </span>
                                {{ __('Investors') }}
                            </div>
                            <svg :class="investorsDropdownOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="investorsDropdownOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            <a href="{{ route('investors.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investors.*') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Registry') }}
                            </a>
                            @if(auth()->user()->hasPermission('view-payroll'))
                            <a href="{{ route('investments.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('investments.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Ledger') }}
                            </a>
                            <a href="{{ route('fund-requests.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('fund-requests.*') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Fund Requests') }}
                            </a>
                            <a href="{{ route('payouts.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('payouts.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Payouts') }}
                            </a>
                            @endif
                        </div>
                    </div>
                @endif
                @endunless

                    @if(auth()->user()->hasPermission('view-projects'))
                    <!-- Projects Dropdown -->
                    <div x-data="{ 
                        projectsOpen: {{ request()->routeIs('projects.*') || request()->routeIs('construction-plans.*') ? 'true' : 'false' }},
                        activeProjectsOpen: {{ request()->routeIs('projects.show') || request()->routeIs('projects.edit') ? 'true' : 'false' }}
                    }" class="mt-1">
                        <button @click="projectsOpen = !projectsOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('projects.*') || request()->routeIs('construction-plans.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('projects.*') || request()->routeIs('construction-plans.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </span>
                                {{ __('Portfolio') }}
                            </div>
                            <svg :class="projectsOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="projectsOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            <a href="{{ route('projects.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('projects.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ auth()->user()->isSiteSupervisor() ? __('My Projects') : __('Registry') }}
                            </a>
                            
                            @unless(auth()->user()->isSiteSupervisor())
                            @if(auth()->user()->hasPermission('create-projects'))
                            <a href="{{ route('projects.create') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('projects.create') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Launch New') }}
                            </a>
                            @endif
                            @endunless

                            <!-- Nested Active Projects Dropdown -->
                            @if(isset($sidebarProjects) && $sidebarProjects->count() > 0)
                                <div class="mt-2 border-t border-slate-800/50 pt-3 mb-2">
                                    <button @click="activeProjectsOpen = !activeProjectsOpen" 
                                            class="w-full flex items-center justify-between gap-2 px-4 py-1 text-[9px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-white transition-all">
                                        <span>{{ __('Active Site Feeds') }}</span>
                                        <svg :class="activeProjectsOpen ? 'rotate-180' : ''" class="w-2.5 h-2.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    
                                    <div x-show="activeProjectsOpen" x-cloak x-transition class="mt-2 space-y-1">
                                        @foreach($sidebarProjects as $sideProject)
                                            <a href="{{ route('projects.show', $sideProject) }}" 
                                               class="group flex items-center gap-3 px-4 py-2 text-[9px] font-black uppercase tracking-widest rounded-lg transition-all {{ request()->fullUrlIs(route('projects.show', $sideProject)) ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-600 hover:text-slate-300 hover:bg-white/5' }}">
                                                <div class="w-1.5 h-1.5 rounded-full {{ request()->fullUrlIs(route('projects.show', $sideProject)) ? 'bg-indigo-400 shadow-lg shadow-indigo-400/50' : 'bg-slate-700' }} group-hover:scale-125 transition-transform"></div>
                                                {{ Str::limit($sideProject->name, 18) }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @unless(auth()->user()->isSiteSupervisor())
                            <a href="{{ route('construction-plans.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('construction-plans.*') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Design Packages') }}
                            </a>

                            @if(auth()->user()->hasPermission('view-media'))
                            <a href="{{ route('project-updates.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('project-updates.*') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Site Feed Updates') }}
                            </a>
                            @endif

                            <!-- Project Payments Dropdown -->
                            <div x-data="{ paymentsOpen: {{ request()->routeIs('project-payments.*') ? 'true' : 'false' }} }" class="mt-2">
                                <button @click="paymentsOpen = !paymentsOpen" 
                                        class="w-full flex items-center justify-between gap-2 px-4 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-white transition-all">
                                    <span>{{ __('Project Payments') }}</span>
                                    <svg :class="paymentsOpen ? 'rotate-180' : ''" class="w-2.5 h-2.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                
                                <div x-show="paymentsOpen" x-cloak x-transition class="mt-2 space-y-1">
                                    <a href="{{ route('project-payments.create') }}" 
                                       class="block px-4 py-2 text-[9px] font-black uppercase tracking-widest rounded-lg transition-all {{ request()->routeIs('project-payments.create') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-600 hover:text-slate-300 hover:bg-white/5' }}">
                                        {{ __('1. Add Payment') }}
                                    </a>
                                    <a href="{{ route('project-payments.history') }}" 
                                       class="block px-4 py-2 text-[9px] font-black uppercase tracking-widest rounded-lg transition-all {{ request()->routeIs('project-payments.history') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-600 hover:text-slate-300 hover:bg-white/5' }}">
                                        {{ __('2. View Payment History') }}
                                    </a>
                                    <a href="{{ route('project-payments.index') }}" 
                                       class="block px-4 py-2 text-[9px] font-black uppercase tracking-widest rounded-lg transition-all {{ request()->routeIs('project-payments.index') && !request()->routeIs('project-payments.create') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-600 hover:text-slate-300 hover:bg-white/5' }}">
                                        {{ __('3. Download Receipt') }}
                                    </a>
                                    <a href="{{ route('project-payments.index') }}" 
                                       class="block px-4 py-2 text-[9px] font-black uppercase tracking-widest rounded-lg transition-all {{ request()->routeIs('project-payments.index') ? 'text-slate-600 hover:text-slate-300 hover:bg-white/5' : 'text-slate-600 hover:text-slate-300 hover:bg-white/5' }}">
                                        {{ __('4. Print Invoice') }}
                                    </a>
                                    <a href="{{ route('project-payments.balances') }}" 
                                       class="block px-4 py-2 text-[9px] font-black uppercase tracking-widest rounded-lg transition-all {{ request()->routeIs('project-payments.balances') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-600 hover:text-slate-300 hover:bg-white/5' }}">
                                        {{ __('5. Balance Auto Calculate') }}
                                    </a>
                                </div>
                            </div>
                            @endunless
                        </div>
                    </div>
                    @endif

                    @if(auth()->user()->hasPermission('view-projects'))
                    @unless(auth()->user()->isSiteSupervisor())
                    <!-- Expenses Dropdown -->
                    <div x-data="{ expensesOpen: {{ request()->routeIs('expenses.*') ? 'true' : 'false' }} }" class="mt-1">
                        <button @click="expensesOpen = !expensesOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('expenses.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('expenses.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </span>
                                {{ __('Expenses') }}
                            </div>
                            <svg :class="expensesOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="expensesOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            <a href="{{ route('expenses.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('expenses.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Ledger') }}
                            </a>
                            @if(auth()->user()->hasPermission('create-expenses'))
                            <a href="{{ route('expenses.create') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('expenses.create') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Record Expense') }}
                            </a>
                            @endif
                        </div>
                    </div>
                    @endunless
                    @endif

                    @if(auth()->user()->hasPermission('view-inventory'))
                    @unless(auth()->user()->isSiteSupervisor())
                    <!-- Materials Dropdown -->
                    <div x-data="{ materialsOpen: {{ request()->routeIs('materials.*') || request()->routeIs('material_transactions.*') ? 'true' : 'false' }} }" class="mt-1">
                        <button @click="materialsOpen = !materialsOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('materials.*') || request()->routeIs('material_transactions.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('materials.*') || request()->routeIs('material_transactions.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </span>
                                {{ __('Materials') }}
                            </div>
                            <svg :class="materialsOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="materialsOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            <a href="{{ route('materials.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('materials.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Catalog') }}
                            </a>
                            @if(auth()->user()->hasPermission('add-inventory'))
                            <a href="{{ route('materials.create') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('materials.create') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Add Stock') }}
                            </a>
                            @endif
                            <a href="{{ route('material_transactions.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('material_transactions.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Log') }}
                            </a>
                        </div>
                    </div>
                    @endunless
                    @endif

                    @if(auth()->user()->hasPermission('view-employees'))
                    <!-- Labour Dropdown -->
                    <div x-data="{ labourOpen: {{ request()->routeIs('labour.*') || request()->routeIs('attendance.*') || request()->routeIs('labour.work-progress.*') ? 'true' : 'false' }} }" class="mt-1">
                        <button @click="labourOpen = !labourOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('labour.*') || request()->routeIs('attendance.*') || request()->routeIs('labour.work-progress.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('labour.*') || request()->routeIs('attendance.*') || request()->routeIs('labour.work-progress.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </span>
                                {{ __('Labour') }}
                            </div>
                            <svg :class="labourOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="labourOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            @unless(auth()->user()->isSiteSupervisor())
                            <a href="{{ route('labour.dashboard') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('labour.dashboard') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Dashboard') }}
                            </a>
                            @endunless

                            <a href="{{ route('labour.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('labour.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('All Labours') }}
                            </a>
                            
                            @if(auth()->user()->isSiteSupervisor())
                            <a href="{{ route('labour.create') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('labour.create') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Register New Labour') }}
                            </a>
                            @endif

                            @if(auth()->user()->hasPermission('manage-attendance'))
                            <a href="{{ route('labour.work-progress.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('labour.work-progress.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Daily Work Progress') }}
                            </a>
                            <a href="{{ route('attendance.create') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('attendance.create') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Mark Attendance') }}
                            </a>
                            @endif
                            <a href="{{ route('attendance.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('attendance.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Records') }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if(auth()->user()->hasPermission('view-employees'))
                    @unless(auth()->user()->isSiteSupervisor())
                    <!-- Site Managers Dropdown -->
                    <div x-data="{ managersOpen: {{ request()->routeIs('site-managers.*') ? 'true' : 'false' }} }" class="mt-1">
                        <button @click="managersOpen = !managersOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('site-managers.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('site-managers.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </span>
                                {{ __('Site Managers') }}
                            </div>
                            <svg :class="managersOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="managersOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            <a href="{{ route('site-managers.dashboard') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('site-managers.dashboard') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Dashboard') }}
                            </a>
                            <a href="{{ route('site-managers.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('site-managers.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('All Site Managers') }}
                            </a>
                            <a href="{{ route('site-managers.attendance') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('site-managers.attendance') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Attendance') }}
                            </a>
                            <a href="{{ route('site-managers.attendance-records') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('site-managers.attendance-records') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Records') }}
                            </a>
                            <a href="{{ route('site-managers.payouts.index') }}" 
                               class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('site-managers.payouts.*') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                {{ __('Payouts') }}
                            </a>
                        </div>
                    </div>
                    @endunless
                    @endif

                    @if(auth()->user()->hasPermission('view-media'))
                    @unless(auth()->user()->isSiteSupervisor())
                    <!-- Web Intelligence (CMS) Group -->
                    <div x-data="{ cmsOpen: {{ request()->routeIs('website-content.*') ? 'true' : 'false' }} }" class="mt-1">
                        <button @click="cmsOpen = !cmsOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('website-content.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('website-content.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                </span>
                                {{ __('CMS') }}
                            </div>
                            <svg :class="cmsOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="cmsOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            @php
                                $cmsItems = [
                                    ['name' => 'All Sections', 'group' => ''],
                                    ['name' => 'Header', 'group' => 'header'],
                                    ['name' => 'Footer', 'group' => 'footer'],
                                    ['name' => 'Home', 'group' => 'home'],
                                    ['name' => 'Services', 'group' => 'services'],
                                    ['name' => 'Projects', 'group' => 'projects'],
                                    ['name' => 'About', 'group' => 'about'],
                                    ['name' => 'Contact', 'group' => 'contact'],
                                ];
                            @endphp
                            @foreach($cmsItems as $cms)
                                <a href="{{ route('website-content.index', $cms['group'] ? ['group' => $cms['group']] : []) }}" 
                                   class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->get('group') == $cms['group'] && request()->routeIs('website-content.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                    {{ __($cms['name']) }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endunless
                    @endif
                </nav>
            </div>

            @unless(auth()->user()->isSiteSupervisor())
            <!-- Administration Group -->
            @if(auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('view-settings') || auth()->user()->hasPermission('view-users'))
            <div class="mt-8">
                <span class="px-4 text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 block">System Control</span>
                <nav class="space-y-1">
                    <div x-data="{ adminOpen: {{ request()->routeIs('admin.*') || request()->routeIs('email-config.*') || request()->routeIs('group-email.*') || request()->routeIs('roles.*') ? 'true' : 'false' }} }">
                        <button @click="adminOpen = !adminOpen" 
                                class="w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ request()->routeIs('admin.*') || request()->routeIs('email-config.*') || request()->routeIs('group-email.*') || request()->routeIs('roles.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('admin.*') || request()->routeIs('email-config.*') || request()->routeIs('group-email.*') || request()->routeIs('roles.*') ? 'text-white' : 'text-slate-600' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </span>
                                {{ __('Administration') }}
                            </div>
                            <svg :class="adminOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="adminOpen" x-cloak x-transition class="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                            @if(auth()->user()->hasPermission('view-settings'))
                                <a href="{{ route('admin.email-config.index') }}" 
                                class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('admin.email-config.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                    {{ __('Email Settings') }}
                                </a>
                            @endif
                            @if(auth()->user()->hasPermission('update-settings'))
                                <a href="{{ route('admin.group-email.index') }}" 
                                class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('admin.group-email.index') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                    {{ __('Broadcast') }}
                                </a>
                            @endif
                            @if(auth()->user()->hasPermission('view-users'))
                                <a href="/users" 
                                class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->is('users') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                    {{ __('User Management') }}
                                </a>
                                <a href="{{ route('roles.index') }}" 
                                class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all {{ request()->routeIs('roles.*') ? 'text-indigo-400 bg-indigo-500/10' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                                    {{ __('Role Permissions') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
            @endif
            @endunless
        @endif
    </div>

    <!-- User Profile Tooltip (Bottom) -->
    <div class="p-4 border-t border-slate-800/50 bg-[#0c1221]">
        <div class="px-4 py-3 bg-slate-900/50 border border-slate-800/50 rounded-2xl flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-black text-xs shadow-lg shadow-indigo-600/20 uppercase overflow-hidden">
                @if(Auth::user()->profile_picture)
                    <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                @else
                    {{ substr(Auth::user()->name, 0, 1) }}
                @endif
            </div>
            <div class="flex flex-col min-w-0">
                <span class="text-xs font-black text-white leading-none truncate uppercase tracking-tighter">{{ Auth::user()->name }}</span>
                <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-1">
                    {{ Auth::user()->isSuperAdmin() ? 'Systems Lead' : (Auth::user()->isAdminStaff() ? 'Operations Staff' : (Auth::user()->isInvestor() ? 'Capital Partner' : 'My Account')) }}
                </span>
                @if(Auth::user()->isInvestor() && Auth::user()->investor)
                    <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mt-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        ₹{{ number_format(Auth::user()->investor->balance, 2) }}
                    </span>
                @endif
            </div>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-red-500 hover:text-red-400 hover:bg-red-500/10 rounded-xl transition-all">
                <span class="mr-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </span>
                {{ __('Logout') }}
            </button>
        </form>
    </div>
</aside>