<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    @if(auth()->user()->isAdmin())
                        {{ __('Administrative Control') }}
                    @elseif(auth()->user()->isInvestor())
                        {{ __('Investor Portfolio') }}
                    @else
                        {{ __('Operations Dashboard') }}
                    @endif
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Monitor and manage your construction ecosystem in real-time.') }}
                </p>
            </div>
            <div class="flex items-center bg-white px-4 py-2 rounded-lg border border-slate-200 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500 flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    {{ __('SYSTEM OPERATIONAL') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Welcome Section -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-8 flex flex-col md:flex-row items-center justify-between gap-8 bg-slate-900 bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-950 text-white">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center justify-center text-white text-3xl font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold tracking-tight">{{ __('Welcome back') }}, {{ auth()->user()->name }}</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-slate-300 text-sm font-medium">{{ __('Access Tier:') }}</span>
                            <span class="bg-indigo-500/20 border border-indigo-400/30 px-3 py-0.5 rounded-full text-indigo-100 font-bold text-[10px] tracking-widest uppercase">
                                {{ str_replace('_', ' ', auth()->user()->role) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                    @if(auth()->user()->isInvestor())
                        <a href="{{ route('investor.dashboard') }}" class="w-full sm:w-auto text-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all text-sm shadow-lg shadow-indigo-600/20">Investor Desk</a>
                    @else
                        <a href="{{ route('investor.register.create') }}" class="w-full sm:w-auto text-center px-6 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl transition-all text-sm shadow-lg shadow-emerald-600/20">Become an Investor</a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="w-full sm:w-auto text-center px-6 py-2.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold rounded-xl transition-all text-sm">Account Settings</a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit" class="w-full text-center px-6 py-2.5 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 text-red-400 font-bold rounded-xl transition-all text-sm">
                            {{ __('Logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if(auth()->user()->isAdmin())
        <!-- Quick Actions -->
        <div>
            <div class="flex items-center gap-3 mb-6">
                <div class="h-6 w-1 bg-indigo-600 rounded-full"></div>
                <h3 class="text-lg font-bold text-slate-900">{{ __('Priority Actions') }}</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if(auth()->user()->hasPermission('create-projects'))
                <a href="{{ route('expenses.create') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 hover:border-indigo-600/50 hover:shadow-xl hover:shadow-indigo-600/5 transition-all duration-300">
                    <div class="w-12 h-12 bg-slate-50 border border-slate-100 text-slate-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-1 group-hover:text-indigo-600 transition-colors">{{ __('Record Expense') }}</h4>
                    <p class="text-slate-500 font-medium text-xs leading-relaxed">{{ __('Log financial transactions and attach digital receipts.') }}</p>
                </a>
                @endif
                
                @if(auth()->user()->hasPermission('manage-attendance'))
                <a href="{{ route('attendance.create') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-600/50 hover:shadow-xl hover:shadow-emerald-600/5 transition-all duration-300">
                    <div class="w-12 h-12 bg-slate-50 border border-slate-100 text-slate-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-600 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-1 group-hover:text-emerald-600 transition-colors">{{ __('Deploy Workforce') }}</h4>
                    <p class="text-slate-500 font-medium text-xs leading-relaxed">{{ __('Manage daily attendance and workforce distribution.') }}</p>
                </a>
                @endif

                @if(auth()->user()->hasPermission('add-inventory'))
                <a href="{{ route('material_transactions.create') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 hover:border-amber-600/50 hover:shadow-xl hover:shadow-amber-600/5 transition-all duration-300">
                    <div class="w-12 h-12 bg-slate-50 border border-slate-100 text-slate-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-amber-600 group-hover:text-white group-hover:border-amber-600 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-1 group-hover:text-amber-600 transition-colors">{{ __('Stock Inventory') }}</h4>
                    <p class="text-slate-500 font-medium text-xs leading-relaxed">{{ __('Track material movements and inventory levels.') }}</p>
                </a>
                @endif
            </div>
        </div>

        <!-- Secondary Modules -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                <h4 class="text-lg font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">{{ __('Asset Management') }}</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @php
                        $modules = [
                            ['name' => 'Projects Portfolio', 'route' => 'projects.index', 'icon' => '🏗️', 'permission' => 'view-projects'],
                            ['name' => 'Pricing Plans', 'route' => 'construction-plans.index', 'icon' => '💎', 'permission' => 'view-projects'],
                            ['name' => 'Expense Ledger', 'route' => 'expenses.index', 'icon' => '💸', 'permission' => 'view-projects'],
                            ['name' => 'Labour Force', 'route' => 'labour.index', 'icon' => '👷', 'permission' => 'view-employees'],
                            ['name' => 'Material Registry', 'route' => 'materials.index', 'icon' => '🧱', 'permission' => 'view-inventory'],
                            ['name' => 'Vendor Database', 'route' => 'vendors.index', 'icon' => '🤝', 'permission' => 'view-vendors'],
                            ['name' => 'Site Feed Updates', 'route' => 'project-updates.index', 'icon' => '📸', 'permission' => 'view-media'],
                        ];
                    @endphp
                    @foreach($modules as $mod)
                        @if(auth()->user()->hasPermission($mod['permission']))
                        <a href="{{ route($mod['route']) }}" class="flex items-center justify-between p-4 bg-slate-50/50 border border-slate-100 rounded-xl hover:bg-slate-50 hover:border-indigo-200 transition-all group">
                            <div class="flex items-center gap-3">
                                <span class="text-xl">{{ $mod['icon'] }}</span>
                                <span class="font-bold text-slate-700 text-xs uppercase tracking-wider group-hover:text-indigo-600 transition-colors">{{ $mod['name'] }}</span>
                            </div>
                            <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="bg-slate-900 p-8 rounded-2xl shadow-xl shadow-slate-900/20 text-white flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h4 class="text-2xl font-bold mb-3 tracking-tight">{{ __('Intelligence Center') }}</h4>
                    <p class="text-slate-200 font-medium mb-8 leading-relaxed text-sm">{{ __('Gain strategic oversight with advanced analytics and automated site reporting.') }}</p>
                </div>
                @if(auth()->user()->hasPermission('view-reports'))
                <a href="{{ route('reports.index') }}" class="relative z-10 w-full inline-flex items-center justify-center px-6 py-3 bg-white text-slate-900 font-bold rounded-xl hover:bg-slate-50 transition-all text-sm group shadow-lg">
                    {{ __('Generate Report') }}
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                @endif
            </div>
        </div>
        @endif
    </div>
    @if(auth()->user()->isInvestor())
    <div class="space-y-8 mt-8">
        <!-- Investor Welcome/CTA -->
        <div class="bg-indigo-50 border border-indigo-100 rounded-[2rem] p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="max-w-xl">
                <h3 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Access Your Investor Dashboard</h3>
                <p class="text-slate-600 font-medium leading-relaxed mb-6">Track your active investments, view project milestones, and monitor your payout schedules in one centralized portal.</p>
                <a href="{{ route('investor.dashboard') }}" class="inline-flex items-center px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-sm uppercase tracking-widest rounded-2xl transition-all shadow-lg shadow-indigo-600/20 group">
                    Go to Investor Portal
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
            <div class="w-full md:w-64 h-64 bg-white rounded-[2rem] shadow-xl shadow-slate-200 flex items-center justify-center border border-slate-100">
                <svg class="w-24 h-24 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
