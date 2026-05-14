<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    @if(auth()->user()->isAdmin())
                        {{ __('Dashboard Control') }}
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
        @if(auth()->user()->isSiteSupervisor())
        <!-- Supervisor Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-8 h-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-slate-900">{{ $totalLabours }}</h3>
                <p class="text-slate-500 text-xs font-medium">{{ __('Total Labours') }}</p>
            </div>

            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-slate-900">{{ $supervisorLabours }}</h3>
                <p class="text-slate-500 text-xs font-medium">{{ __('Project Labours') }}</p>
            </div>

            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-10V4m0 10V4m0 10l1.293 1.293a1 1 0 010 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414L10 14m4 0l-4 4-4-4"></path></svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-slate-900">{{ $projectLabours->count() }}</h3>
                <p class="text-slate-500 text-xs font-medium">{{ __('Active Projects') }}</p>
            </div>
        </div>

        <!-- Project Wise Labour Summary -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-8 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900">{{ __('Labour Distribution Per Project') }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">{{ __('Project Name') }}</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-center">{{ __('Labour Count') }}</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($projectLabours as $project)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-slate-900">{{ $project->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-bold">
                                    {{ $project->labours_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 {{ $project->status === 'Ongoing' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }} text-[10px] font-bold uppercase tracking-wider rounded-lg">
                                    {{ $project->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Supervisor Quick Actions -->
        <div>
            <div class="flex items-center gap-3 mb-6">
                <div class="h-6 w-1 bg-indigo-600 rounded-full"></div>
                <h3 class="text-lg font-bold text-slate-900">{{ __('Supervisor Control Center') }}</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Manage Attendance -->
                <a href="{{ route('attendance.create') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 hover:border-emerald-600/50 hover:shadow-xl hover:shadow-emerald-600/5 transition-all duration-300">
                    <div class="w-12 h-12 bg-slate-50 border border-slate-100 text-slate-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-600 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-1 group-hover:text-emerald-600 transition-colors">{{ __('Labour Attendance') }}</h4>
                    <p class="text-slate-500 font-medium text-xs leading-relaxed">{{ __('Mark daily attendance for site workers.') }}</p>
                </a>

                <!-- Daily Work Progress -->
                <a href="{{ route('labour.work-progress.index') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 hover:border-blue-600/50 hover:shadow-xl hover:shadow-blue-600/5 transition-all duration-300">
                    <div class="w-12 h-12 bg-slate-50 border border-slate-100 text-slate-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-1 group-hover:text-blue-600 transition-colors">{{ __('Work Progress') }}</h4>
                    <p class="text-slate-500 font-medium text-xs leading-relaxed">{{ __('Log daily activities and construction milestones.') }}</p>
                </a>

                <!-- Attendance Records -->
                <a href="{{ route('attendance.index') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 hover:border-amber-600/50 hover:shadow-xl hover:shadow-amber-600/5 transition-all duration-300">
                    <div class="w-12 h-12 bg-slate-50 border border-slate-100 text-slate-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-amber-600 group-hover:text-white group-hover:border-amber-600 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-1 group-hover:text-amber-600 transition-colors">{{ __('Attendance Logs') }}</h4>
                    <p class="text-slate-500 font-medium text-xs leading-relaxed">{{ __('Review past attendance history and reports.') }}</p>
                </a>

                <!-- Add New Labour -->
                <a href="{{ route('labour.create') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 hover:border-indigo-600/50 hover:shadow-xl hover:shadow-indigo-600/5 transition-all duration-300">
                    <div class="w-12 h-12 bg-slate-50 border border-slate-100 text-slate-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-1 group-hover:text-indigo-600 transition-colors">{{ __('Register Labour') }}</h4>
                    <p class="text-slate-500 font-medium text-xs leading-relaxed">{{ __('Onboard new workers to the site database.') }}</p>
                </a>
            </div>

            <!-- Assigned Projects Section -->
            <div class="mt-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="h-6 w-1 bg-emerald-600 rounded-full"></div>
                        <h3 class="text-lg font-bold text-slate-900">{{ __('My Assigned Projects') }}</h3>
                    </div>
                    <a href="{{ route('projects.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors flex items-center gap-1">
                        {{ __('View All') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @php
                        $assignedManager = auth()->user()->siteManager;
                        $assignedProject = $assignedManager ? $assignedManager->project : null;
                    @endphp

                    @if($assignedProject)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold uppercase tracking-wider rounded-lg mb-2 inline-block">
                                        {{ $assignedProject->status ?? 'Active' }}
                                    </span>
                                    <h4 class="text-xl font-bold text-slate-900">{{ $assignedProject->name }}</h4>
                                    <p class="text-slate-500 text-sm mt-1 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $assignedProject->location }}
                                    </p>
                                </div>
                                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-10V4m0 10V4m0 10l1.293 1.293a1 1 0 010 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414L10 14m4 0l-4 4-4-4"></path></svg>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-6">
                                <div class="bg-slate-50/50 p-3 rounded-xl border border-slate-100">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ __('Start Date') }}</p>
                                    <p class="text-sm font-bold text-slate-700 mt-0.5">{{ $assignedProject->start_date ? $assignedProject->start_date->format('M d, Y') : 'N/A' }}</p>
                                </div>
                                <div class="bg-slate-50/50 p-3 rounded-xl border border-slate-100">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ __('End Date') }}</p>
                                    <p class="text-sm font-bold text-slate-700 mt-0.5">{{ $assignedProject->end_date ? $assignedProject->end_date->format('M d, Y') : 'N/A' }}</p>
                                </div>
                            </div>
                            <a href="{{ route('projects.show', $assignedProject->id) }}" class="mt-6 w-full inline-flex items-center justify-center px-4 py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-slate-800 transition-all">
                                {{ __('Access Project Details') }}
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="col-span-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-12 text-center">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm border border-slate-100">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-10V4m0 10V4m0 10l1.293 1.293a1 1 0 010 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414L10 14m4 0l-4 4-4-4"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900">{{ __('No Projects Assigned') }}</h4>
                        <p class="text-slate-500 text-sm mt-1 max-w-sm mx-auto">{{ __('You currently have no active projects assigned. Contact your administrator for assignment.') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @elseif(auth()->user()->isAdmin())
        <!-- Admin Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-8 h-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-10V4m0 10V4m0 10l1.293 1.293a1 1 0 010 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414L10 14m4 0l-4 4-4-4"></path></svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-slate-900">{{ $totalProjects }}</h3>
                <p class="text-slate-500 text-xs font-medium">{{ __('Total Projects') }}</p>
            </div>

            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-slate-900">{{ $totalLabours }}</h3>
                <p class="text-slate-500 text-xs font-medium">{{ __('Total Labours') }}</p>
            </div>

            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-slate-900">{{ $totalInvestors }}</h3>
                <p class="text-slate-500 text-xs font-medium">{{ __('Total Investors') }}</p>
            </div>

            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-8 h-8 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-slate-900">₹{{ number_format($totalInvestments) }}</h3>
                <p class="text-slate-500 text-xs font-medium">{{ __('Total Investments') }}</p>
            </div>

            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-8 h-8 bg-rose-50 text-rose-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-slate-900">₹{{ number_format($totalExpenses) }}</h3>
                <p class="text-slate-500 text-xs font-medium">{{ __('Total Expenses') }}</p>
            </div>
        </div>

        <!-- Workforce Intelligence Section -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden mb-8">
            <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-600/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Global Workforce Intelligence</h3>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Cross-Project Labour Metrics</p>
                    </div>
                </div>

                <!-- Date Filters -->
                <form action="{{ route('dashboard') }}" method="GET" class="flex flex-wrap items-center gap-3">
                    <select name="project_id" onchange="this.form.submit()" class="text-[10px] font-black uppercase tracking-widest border-slate-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 min-w-[150px]">
                        <option value="">{{ __('All Projects') }}</option>
                        @foreach($allProjects as $proj)
                            <option value="{{ $proj->id }}" {{ $projectId == $proj->id ? 'selected' : '' }}>{{ $proj->name }}</option>
                        @endforeach
                    </select>

                    <select name="filter" onchange="this.form.submit()" class="text-[10px] font-black uppercase tracking-widest border-slate-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="day" {{ $filter == 'day' ? 'selected' : '' }}>Daily</option>
                        <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>Weekly</option>
                        <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Monthly</option>
                        <option value="custom" {{ $filter == 'custom' ? 'selected' : '' }}>Custom Range</option>
                    </select>

                    @if($filter == 'custom')
                        <input type="date" name="start_date" value="{{ $startDate ? $startDate->toDateString() : '' }}" class="text-[10px] font-black uppercase tracking-widest border-slate-200 rounded-lg focus:ring-emerald-500">
                        <input type="date" name="end_date" value="{{ $endDate ? $endDate->toDateString() : '' }}" class="text-[10px] font-black uppercase tracking-widest border-slate-200 rounded-lg focus:ring-emerald-500">
                        <button type="submit" class="p-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    @endif
                </form>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Total Labours present -->
                    <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-100">
                        <span class="block text-[9px] font-black text-indigo-400 uppercase tracking-[0.15em] mb-4">Active System Workforce</span>
                        <div class="flex items-end gap-2">
                            <span class="text-3xl font-black text-indigo-700 tracking-tighter">{{ $totalWorkingLabours }}</span>
                            <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1.5">Unique Labours Present</span>
                        </div>
                    </div>

                    <!-- Date Range Info -->
                    <div class="bg-emerald-50 p-6 rounded-2xl border border-emerald-100">
                        <span class="block text-[9px] font-black text-emerald-400 uppercase tracking-[0.15em] mb-4">Reporting Window</span>
                        <div class="flex flex-col">
                            <span class="text-xs font-black text-emerald-700 uppercase tracking-widest">
                                {{ $startDate ? $startDate->format('d M Y') : 'N/A' }}
                                @if($startDate != $endDate)
                                    - {{ $endDate ? $endDate->format('d M Y') : 'N/A' }}
                                @endif
                            </span>
                            <span class="text-[10px] font-bold text-emerald-500 uppercase tracking-[0.1em] mt-1 italic">Filtered View: {{ ucfirst($filter) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Global Labour List Table -->
                <div class="mt-8">
                    <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-4">System-Wide Workforce Logs</span>
                    <div class="border border-slate-100 rounded-2xl overflow-hidden shadow-sm">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Labour Name</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Assigned Project</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Site Supervisor</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($attendances as $attendance)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400 text-[10px] font-black">
                                                    {{ substr($attendance->labour->name, 0, 1) }}
                                                </div>
                                                <span class="text-xs font-bold text-slate-900">{{ $attendance->labour->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">{{ $attendance->project->name }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($attendance->project->siteManager)
                                                <span class="text-xs font-bold text-slate-600">{{ $attendance->project->siteManager->name }}</span>
                                                <div class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Project Supervisor</div>
                                            @else
                                                <span class="text-xs font-bold text-slate-500">{{ $attendance->recorder->name ?? 'System' }}</span>
                                                <div class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Recorded By</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-xs font-bold text-slate-600">
                                            {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-widest 
                                                {{ strtolower($attendance->status) == 'present' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $attendance->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-slate-400 font-bold uppercase tracking-widest text-xs">No global workforce data found for this period</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-8 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900">{{ __('Recent Projects') }}</h3>
                <a href="{{ route('projects.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
                    {{ __('View All') }}
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">{{ __('Project Name') }}</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">{{ __('Location') }}</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">{{ __('Status') }}</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">{{ __('Timeline') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($recentProjects as $project)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-slate-900">{{ $project->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-medium text-slate-600">{{ $project->location }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 {{ $project->status === 'Ongoing' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }} text-[10px] font-bold uppercase tracking-wider rounded-lg">
                                    {{ $project->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-tight">
                                    {{ $project->start_date ? $project->start_date->format('M Y') : 'N/A' }} - 
                                    {{ $project->end_date ? $project->end_date->format('M Y') : 'TBD' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

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
