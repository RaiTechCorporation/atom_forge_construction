<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Site Manager Intelligence') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Strategic oversight of your site management personnel.') }}
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <a href="{{ route('site-managers.attendance') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-emerald-600/20 text-xs uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    Mark Attendance
                </a>
                <a href="{{ route('site-managers.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20 text-xs uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Register Manager
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Filters -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <form action="{{ route('site-managers.dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div class="md:col-span-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2 ml-1">Project Site</label>
                    <select name="project_id" class="w-full bg-slate-50 border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="">All Projects</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $projectId == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-slate-900 text-white font-bold py-2.5 rounded-xl text-xs uppercase tracking-widest hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10">
                        Apply Filters
                    </button>
                    @if($projectId)
                        <a href="{{ route('site-managers.dashboard') }}" class="px-4 bg-slate-100 text-slate-600 font-bold py-2.5 rounded-xl text-xs uppercase tracking-widest hover:bg-slate-200 transition-all flex items-center justify-center" title="Clear Filters">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Key Metrics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm group hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Managers</span>
                </div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight italic">{{ number_format($totalManagers) }}</h3>
                <p class="text-[10px] font-bold text-slate-500 mt-1">{{ $activeManagers }} Active</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm group hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Presence</span>
                </div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight italic">{{ \App\Models\SiteManagerAttendance::where('date', now()->format('Y-m-d'))->where('status', 'Present')->count() }}</h3>
                <p class="text-[10px] font-bold text-slate-500 mt-1">Daily Staff</p>
            </div>

            <div class="bg-slate-900 p-5 rounded-2xl shadow-xl shadow-slate-200 group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:scale-110 transition-transform text-white">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Total Payouts</p>
                    <h3 class="text-2xl font-black text-white tracking-tight italic">₹{{ number_format(\App\Models\SiteManagerPayout::sum('net_amount'), 0) }}</h3>
                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mt-1">Management Cost</p>
                </div>
            </div>
        </div>

        <!-- Section Info -->
        <div class="bg-white p-12 rounded-3xl border border-slate-200 shadow-sm text-center">
            <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center text-indigo-600 mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <h4 class="text-2xl font-black text-slate-900 tracking-tight mb-2 italic">{{ __('Site Management Analytics') }}</h4>
            <p class="text-slate-500 font-medium max-w-2xl mx-auto leading-relaxed">
                {{ __('This dashboard provides a high-level overview of your site managers. Detailed performance metrics and individual logs can be found in the Manager Directory.') }}
            </p>
            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('site-managers.index') }}" class="px-8 py-3 bg-slate-900 text-white font-black uppercase tracking-widest text-[10px] rounded-xl hover:bg-slate-800 transition-all">
                    View Full Directory
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
