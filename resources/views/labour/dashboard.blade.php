<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Labour Intelligence Dashboard') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Strategic oversight of your construction workforce and payroll.') }}
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <a href="{{ route('attendance.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-emerald-600/20 text-xs uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    Mark Attendance
                </a>
                <a href="{{ route('labour.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20 text-xs uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Register Worker
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Filters -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
            <form action="{{ route('labour.dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2 ml-1">Project Site</label>
                    <select name="project_id" class="w-full bg-slate-50 border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="">All Projects</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $projectId == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2 ml-1">Start Date</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2 ml-1">End Date</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-slate-900 text-white font-bold py-2.5 rounded-xl text-xs uppercase tracking-widest hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10">
                        Apply Filters
                    </button>
                    @if($projectId || $startDate || $endDate)
                        <a href="{{ route('labour.dashboard') }}" class="px-4 bg-slate-100 text-slate-600 font-bold py-2.5 rounded-xl text-xs uppercase tracking-widest hover:bg-slate-200 transition-all flex items-center justify-center" title="Clear Filters">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Key Metrics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Workers -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm group hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Labours</span>
                </div>
                <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($totalWorkers) }}</h3>
                <p class="text-xs font-bold text-slate-500 mt-1">{{ $activeWorkers }} Active Registry</p>
            </div>

            <!-- Today's Attendance -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm group hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Today's Deploy</span>
                </div>
                <h3 class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($todayAttendance) }}</h3>
                <p class="text-xs font-bold text-slate-500 mt-1">{{ $monthlyAttendance }} Present This Month</p>
            </div>

            <!-- Total Paid -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm group hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600 group-hover:bg-rose-600 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Payout</span>
                </div>
                <h3 class="text-3xl font-black text-slate-900 tracking-tight">
                    @if($totalPaid >= 100000)
                        ₹{{ number_format($totalPaid / 100000, 2) }}L
                    @else
                        ₹{{ number_format($totalPaid) }}
                    @endif
                </h3>
                <p class="text-xs font-bold text-slate-500 mt-1">₹{{ number_format($totalEarned) }} Gross Earned</p>
            </div>

            <!-- Balance Due -->
            <div class="bg-slate-900 p-6 rounded-3xl shadow-xl shadow-slate-200 group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform text-white">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Outstanding</span>
                    </div>
                    <h3 class="text-3xl font-black text-white tracking-tight italic">
                        @if($totalBalance >= 100000)
                            ₹{{ number_format($totalBalance / 100000, 2) }}L
                        @else
                            ₹{{ number_format($totalBalance) }}
                        @endif
                    </h3>
                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mt-1">Net Liabilities</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Attendance Trends -->
            <div class="lg:col-span-2 bg-white p-8 rounded-3xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h4 class="text-lg font-black text-slate-900 tracking-tight">{{ __('Deployment Trends') }}</h4>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">{{ __('Last 7 Working Days') }}</p>
                    </div>
                </div>
                
                <div class="flex items-end gap-2 h-48">
                    @php $maxCount = max($attendanceTrends->pluck('count')->max(), 1); @endphp
                    @foreach($attendanceTrends as $trend)
                        <div class="flex-1 flex flex-col items-center gap-2 group">
                            <div class="relative w-full flex items-end justify-center h-full">
                                <div class="w-full bg-slate-50 rounded-t-xl group-hover:bg-indigo-50 transition-all border-x border-t border-slate-100" style="height: 100%"></div>
                                <div class="absolute w-[70%] bg-indigo-600 rounded-t-lg group-hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20" 
                                     style="height: {{ ($trend['count'] / $maxCount) * 100 }}%">
                                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] font-black px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                        {{ $trend['count'] }} Present
                                    </div>
                                </div>
                            </div>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">{{ date('D', strtotime($trend['date'])) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Workforce Composition -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm">
                <h4 class="text-lg font-black text-slate-900 tracking-tight mb-6">{{ __('Workforce Mix') }}</h4>
                
                <div class="space-y-6">
                    <div>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">By Skill Level</span>
                        <div class="space-y-3">
                            @foreach($skillDistribution as $skill)
                                <div class="space-y-1">
                                    <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest">
                                        <span class="text-slate-700">{{ $skill->skill_level ?? 'Unspecified' }}</span>
                                        <span class="text-indigo-600">{{ $skill->count }}</span>
                                    </div>
                                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                        <div class="bg-indigo-600 h-full" style="width: {{ $totalWorkers > 0 ? ($skill->count / $totalWorkers) * 100 : 0 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">By Specialization</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($workTypeDistribution as $type)
                                <span class="px-3 py-1 bg-slate-50 text-slate-600 border border-slate-200 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                    {{ $type->work_type }}: {{ $type->count }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Labour Work Records -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-lg font-black text-slate-900 tracking-tight">{{ __('Labour Work Records') }}</h4>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">{{ __('Filtered Individual Performance') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($labourWorkRecords as $record)
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-indigo-600/20 transition-all duration-300 overflow-hidden group">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center font-black text-sm border border-indigo-100 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                        @if($record['photo'])
                                            <img src="{{ Storage::url($record['photo']) }}" alt="{{ $record['name'] }}" class="w-full h-full object-cover rounded-2xl">
                                        @else
                                            {{ substr($record['name'], 0, 1) }}
                                        @endif
                                    </div>
                                    <div>
                                        <h5 class="text-sm font-black text-slate-900 leading-none mb-1">{{ $record['name'] }}</h5>
                                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $record['unique_id'] }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Total Days</span>
                                    <span class="text-lg font-black text-slate-900 italic">{{ $record['total_days'] }}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-4 py-4 border-y border-slate-50">
                                <div>
                                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest block mb-1">Earned</span>
                                    <span class="text-xs font-black text-slate-900 italic">₹{{ number_format($record['total_earned']) }}</span>
                                </div>
                                <div>
                                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest block mb-1">Paid</span>
                                    <span class="text-xs font-black text-emerald-600 italic">₹{{ number_format($record['total_paid']) }}</span>
                                </div>
                                <div>
                                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest block mb-1">Balance</span>
                                    <span class="text-xs font-black {{ $record['balance'] > 0 ? 'text-rose-600' : 'text-slate-900' }} italic">₹{{ number_format($record['balance']) }}</span>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <a href="{{ route('labour.show', $record['id']) }}" class="w-full inline-flex items-center justify-center py-2 bg-slate-50 text-slate-600 font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-indigo-600 hover:text-white transition-all">
                                    Full Worker Report
                                    <svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-12 text-center">
                        <p class="text-slate-500 font-bold text-sm">No work records found for the selected filter.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                <h4 class="text-lg font-black text-slate-900 tracking-tight">{{ __('Recent Deployments') }}</h4>
                <a href="{{ route('attendance.index') }}" class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] hover:text-indigo-500 transition-colors">View All Records</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-8 py-4 text-left text-[10px] font-black text-slate-500 uppercase tracking-widest">Worker</th>
                            <th class="px-8 py-4 text-left text-[10px] font-black text-slate-500 uppercase tracking-widest">Project</th>
                            <th class="px-8 py-4 text-left text-[10px] font-black text-slate-500 uppercase tracking-widest">Date / Shift</th>
                            <th class="px-8 py-4 text-left text-[10px] font-black text-slate-500 uppercase tracking-widest">Recorded By</th>
                            <th class="px-8 py-4 text-left text-[10px] font-black text-slate-500 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-4 text-right text-[10px] font-black text-slate-500 uppercase tracking-widest">Payout</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentAttendances as $attendance)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-[10px] uppercase">
                                            {{ substr(optional($attendance->labour)->name ?? '?', 0, 1) }}
                                        </div>
                                        <span class="text-sm font-bold text-slate-900">{{ optional($attendance->labour)->name ?? 'Unknown Worker' }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-4">
                                    <span class="text-xs font-medium text-slate-600">{{ $attendance->project->name }}</span>
                                </td>
                                <td class="px-8 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-bold text-slate-900">{{ date('d M, Y', strtotime($attendance->date)) }}</span>
                                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $attendance->shift }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-medium text-slate-600 italic">{{ $attendance->recorder->name ?? 'System' }}</span>
                                        @if($attendance->recorded_at)
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $attendance->recorded_at->timezone('Asia/Kolkata')->format('h:i A') }} IST</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-8 py-4">
                                    <span class="px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-widest {{ $attendance->status === 'present' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                        {{ $attendance->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <span class="text-sm font-black text-slate-900 italic">₹{{ number_format($attendance->payment_amount, 2) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-12 text-center text-slate-500 font-medium">No recent activity recorded.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
