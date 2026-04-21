<!-- Sidebar -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
       x-cloak
       class="fixed top-0 left-0 w-[280px] h-screen bg-slate-900 text-slate-300 z-[70] flex flex-col transition-transform duration-300 ease-in-out shadow-2xl">
    
    <!-- Sidebar Logo Section -->
    <div class="h-[60px] flex items-center px-6 border-b border-slate-800">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="p-1.5 bg-indigo-500 rounded-lg shadow-lg shadow-indigo-500/20">
                <x-application-logo class="w-6 h-6 fill-white" />
            </div>
            <span class="font-bold text-lg text-white tracking-tight">
                Atom<span class="text-indigo-400">Forge</span>
            </span>
        </a>
    </div>

    <div class="p-4 flex-1 overflow-y-auto custom-scrollbar">
        <!-- Close Button (Mobile Only) -->
        <button @click="sidebarOpen = false" class="md:hidden absolute top-4 right-4 text-slate-400 hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <!-- Navigation -->
        <nav class="space-y-1">
            @php
                $links = [
                    ['name' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'grid'],
                ];
            @endphp

            @foreach($links as $link)
                <a href="{{ route($link['route']) }}" 
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs($link['route']) ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'hover:bg-slate-800 hover:text-white' }}">
                    <span class="{{ request()->routeIs($link['route']) ? 'text-white' : 'text-slate-400 group-hover:text-slate-200' }}">
                        @if($link['icon'] == 'grid')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        @endif
                    </span>
                    {{ __($link['name']) }}
                </a>
            @endforeach

            <!-- Projects Dropdown -->
            <div x-data="{ projectsOpen: {{ request()->routeIs('projects.*') || request()->routeIs('construction-plans.*') ? 'true' : 'false' }} }" class="mt-1">
                <button @click="projectsOpen = !projectsOpen" 
                        class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('projects.*') || request()->routeIs('construction-plans.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <span class="{{ request()->routeIs('projects.*') || request()->routeIs('construction-plans.*') ? 'text-white' : 'text-slate-400' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </span>
                        {{ __('Projects') }}
                    </div>
                    <svg :class="projectsOpen ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <div x-show="projectsOpen" x-cloak x-transition class="mt-1 ml-4 space-y-1 border-l border-slate-700 pl-4">
                    <a href="{{ route('projects.index') }}" 
                       class="block px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ request()->routeIs('projects.index') ? 'text-indigo-400 bg-indigo-400/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                        {{ __('Project Registry') }}
                    </a>
                    <a href="{{ route('projects.create') }}" 
                       class="block px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ request()->routeIs('projects.create') ? 'text-indigo-400 bg-indigo-400/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                        {{ __('Launch Project') }}
                    </a>
                    <a href="{{ route('construction-plans.index') }}" 
                       class="block px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ request()->routeIs('construction-plans.*') ? 'text-indigo-400 bg-indigo-400/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                        {{ __('Pricing Plans') }}
                    </a>
                </div>
            </div>

            @php
                $links = [
                    ['name' => 'Expenses', 'route' => 'expenses.index', 'icon' => 'currency-dollar'],
                    ['name' => 'Labour', 'route' => 'labour.index', 'icon' => 'users'],
                    ['name' => 'Attendance', 'route' => 'attendance.create', 'icon' => 'calendar-check'],
                    ['name' => 'Materials', 'route' => 'materials.index', 'icon' => 'cube'],
                    ['name' => 'Inventory Log', 'route' => 'material_transactions.index', 'icon' => 'clipboard-list'],
                ];
            @endphp

            @foreach($links as $link)
                <a href="{{ route($link['route']) }}" 
                   class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs($link['route']) ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'hover:bg-slate-800 hover:text-white' }}">
                    <span class="{{ request()->routeIs($link['route']) ? 'text-white' : 'text-slate-400 group-hover:text-slate-200' }}">
                        @if($link['icon'] == 'grid')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        @elseif($link['icon'] == 'briefcase')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        @elseif($link['icon'] == 'currency-dollar')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        @elseif($link['icon'] == 'users')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        @elseif($link['icon'] == 'calendar-check')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        @elseif($link['icon'] == 'cube')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        @elseif($link['icon'] == 'clipboard-list')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        @elseif($link['icon'] == 'truck')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 011 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                        @endif
                    </span>
                    {{ __($link['name']) }}
                </a>
            @endforeach

            <!-- Vendors Dropdown -->
            <div x-data="{ vendorsOpen: {{ request()->routeIs('vendors.*') ? 'true' : 'false' }} }" class="mt-1">
                <button @click="vendorsOpen = !vendorsOpen" 
                        class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('vendors.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <span class="{{ request()->routeIs('vendors.*') ? 'text-white' : 'text-slate-400' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1-1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 011 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                        </span>
                        {{ __('Vendors') }}
                    </div>
                    <svg :class="vendorsOpen ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <div x-show="vendorsOpen" x-cloak x-transition class="mt-1 ml-4 space-y-1 border-l border-slate-700 pl-4">
                    <a href="{{ route('vendors.index') }}" 
                       class="block px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ request()->routeIs('vendors.index') ? 'text-indigo-400 bg-indigo-400/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                        {{ __('Vendor Database') }}
                    </a>
                    <a href="{{ route('vendors.create') }}" 
                       class="block px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ request()->routeIs('vendors.create') ? 'text-indigo-400 bg-indigo-400/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                        {{ __('Register Vendor') }}
                    </a>
                    <a href="{{ route('material_transactions.index') }}" 
                       class="block px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ request()->routeIs('material_transactions.*') ? 'text-indigo-400 bg-indigo-400/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                        {{ __('Purchase History') }}
                    </a>
                    <a href="{{ route('expenses.index') }}" 
                       class="block px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ request()->routeIs('expenses.*') ? 'text-indigo-400 bg-indigo-400/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                        {{ __('Vendor Bills') }}
                    </a>
                </div>
            </div>

            @if(auth()->user()->isAdmin())
                <div class="pt-6 pb-2">
                    <p class="px-3 text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-2">Management</p>
                    <a href="{{ route('reports.index') }}" 
                       class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('reports.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'hover:bg-slate-800 hover:text-white' }}">
                        <span class="{{ request()->routeIs('reports.*') ? 'text-white' : 'text-slate-400 group-hover:text-slate-200' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </span>
                        {{ __('Analytics') }}
                    </a>

                    <div x-data="{ cmsOpen: false }" class="mt-1">
                        <button @click="cmsOpen = !cmsOpen" 
                                class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('website-content.*') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                </span>
                                {{ __('CMS') }}
                            </div>
                            <svg :class="cmsOpen ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="cmsOpen" x-cloak x-transition class="mt-1 ml-4 space-y-1 border-l border-slate-700 pl-4">
                            @foreach([
                                ['name' => 'All Sections', 'group' => null],
                                ['name' => 'Header', 'group' => 'header'],
                                ['name' => 'Footer', 'group' => 'footer'],
                                ['name' => 'Home', 'group' => 'home'],
                                ['name' => 'Services', 'group' => 'services'],
                                ['name' => 'Projects', 'group' => 'projects'],
                                ['name' => 'About', 'group' => 'about'],
                                ['name' => 'Contact', 'group' => 'contact'],
                                ['name' => 'Legal', 'group' => 'legal'],
                                ['name' => 'FAQ', 'group' => 'faq'],
                            ] as $group)
                                <a href="{{ route('website-content.index', ['group' => $group['group']]) }}" 
                                   class="block px-3 py-1.5 text-xs font-medium rounded-md transition-all {{ (request()->query('group') == $group['group']) ? 'text-indigo-400 bg-indigo-400/10' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                                    {{ $group['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </nav>
    </div>

    <!-- Bottom Actions -->
    <div class="p-4 border-t border-slate-800 bg-slate-900/50 space-y-1">
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
            <svg class="w-5 h-5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            Account Settings
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all group">
                <svg class="w-5 h-5 opacity-60 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </button>
        </form>
    </div>
</aside>
