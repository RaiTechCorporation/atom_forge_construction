<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Executive Intelligence') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('High-level audit of company-wide construction operations.') }}
                </p>
            </div>
            <div class="flex gap-4 w-full md:w-auto">
                <button onclick="window.print()" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition-all shadow-sm text-xs">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Print Report
                </button>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Overall Mission Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Total Portfolio</span>
                <span class="text-3xl font-bold text-slate-900 tracking-tight block">{{ $stats['total_projects'] }}</span>
                <span class="text-[10px] font-semibold text-slate-500 mt-1 uppercase tracking-wider block">Active & Closed</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Live Operations</span>
                <span class="text-3xl font-bold text-emerald-600 tracking-tight block">{{ $stats['active_projects'] }}</span>
                <span class="text-[10px] font-semibold text-slate-500 mt-1 uppercase tracking-wider block">Ongoing Sites</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-12 h-12 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Aggregate Burn</span>
                <span class="text-3xl font-bold text-rose-600 tracking-tight block">₹{{ number_format($stats['total_spend'] / 1000, 1) }}k</span>
                <span class="text-[10px] font-semibold text-slate-500 mt-1 uppercase tracking-wider block">Actual Expenditure</span>
            </div>
            <div class="bg-slate-900 p-6 rounded-2xl shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-3 opacity-20">
                    <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Value Committed</span>
                <span class="text-3xl font-bold text-white tracking-tight block">₹{{ number_format($stats['total_budget'] / 1000, 1) }}k</span>
                <span class="text-[10px] font-semibold text-slate-400 mt-1 uppercase tracking-wider block">Pipeline Valuation</span>
            </div>
        </div>

        <!-- Project Financial Integrity Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">{{ __('Project Financial Summary') }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/30">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Project Entity</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Status</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Contract Value</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Actual Burn</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Delta / Margin</th>
                            <th class="px-6 py-4 text-right text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Utilization</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach($projects as $p)
                            @php
                                $percent = $p['budget'] > 0 ? ($p['actual'] / $p['budget']) * 100 : 0;
                                $statusColor = $percent > 100 ? 'bg-rose-500' : ($percent > 90 ? 'bg-amber-500' : 'bg-emerald-500');
                                $textColor = $percent > 100 ? 'text-rose-600' : 'text-slate-900';
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-slate-900 text-sm tracking-tight">{{ $p['name'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-[9px] font-bold uppercase tracking-widest">
                                        {{ $p['status'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-500 tracking-tight">₹{{ number_format($p['budget'], 0) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-900 tracking-tight">₹{{ number_format($p['actual'], 0) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $p['remaining'] < 0 ? 'text-rose-600' : 'text-emerald-600' }} tracking-tight">
                                    {{ $p['remaining'] < 0 ? '-' : '+' }}₹{{ number_format(abs($p['remaining']), 0) }}
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-3">
                                        <span class="text-sm font-bold {{ $textColor }} tracking-tighter">{{ number_format($percent, 0) }}%</span>
                                        <div class="w-16 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                            <div class="h-full {{ $statusColor }} transition-all duration-500" style="width: {{ min($percent, 100) }}%"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Cross-Project Ledger -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-6 pb-3 border-b border-slate-50 flex items-center justify-between">
                    Audit Trail (30D)
                    <span class="text-[9px] font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded uppercase tracking-widest">Real-time</span>
                </h3>
                <div class="space-y-3">
                    @forelse($recentExpenses->take(8) as $e)
                        <div class="flex items-center justify-between p-3 bg-slate-50/50 hover:bg-slate-50 border border-transparent hover:border-slate-200 rounded-xl transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="flex flex-col items-center justify-center w-10 h-10 bg-white border border-slate-200 rounded-lg shadow-sm">
                                    <span class="text-[8px] font-bold text-slate-400 uppercase leading-none mb-0.5">{{ \Carbon\Carbon::parse($e->date)->format('M') }}</span>
                                    <span class="text-sm font-bold text-slate-900 leading-none">{{ \Carbon\Carbon::parse($e->date)->format('d') }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-slate-900 tracking-tight group-hover:text-indigo-600 transition-colors">{{ $e->project->name }}</span>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $e->category }}</span>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-slate-900 tracking-tight">₹{{ number_format($e->amount, 0) }}</span>
                        </div>
                    @empty
                        <div class="py-12 text-center text-slate-300 text-xs font-bold uppercase tracking-widest italic">No Recent Transactions</div>
                    @endforelse
                </div>
            </div>

            <!-- Workforce Obligations -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-6 pb-3 border-b border-slate-50 flex items-center justify-between">
                    Estimated Payouts
                    <span class="text-[9px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded uppercase tracking-widest">Accrued</span>
                </h3>
                <div class="space-y-3">
                    @forelse($labourSummary as $l)
                        <div class="flex items-center justify-between p-3 bg-slate-50/50 hover:bg-slate-50 border border-transparent hover:border-slate-200 rounded-xl transition-all">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center font-bold text-sm shadow-sm border border-indigo-100 uppercase">
                                    {{ substr($l['name'], 0, 1) }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-slate-900 tracking-tight">{{ $l['name'] }}</span>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $l['days_present'] }} Shifts Logged</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="text-sm font-bold text-slate-900 tracking-tight">₹{{ number_format($l['total_pay'], 0) }}</span>
                                <span class="text-[8px] font-bold text-emerald-600 uppercase tracking-widest">Payable</span>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center text-slate-300 text-xs font-bold uppercase tracking-widest italic">No Attendance Data</div>
                    @endforelse
                </div>
            </div>

            <!-- Global Material Consumption -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm lg:col-span-2">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-6 pb-3 border-b border-slate-50 flex items-center justify-between">
                    Global Resource Consumption
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Aggregate Feed</span>
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @forelse($materialConsumption as $m)
                        <div class="bg-slate-50/50 p-4 rounded-xl border border-slate-100 hover:border-slate-300 hover:bg-white transition-all group flex flex-col justify-between h-28 shadow-sm">
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-slate-900 transition-colors">{{ $m['name'] }}</span>
                            <div>
                                <span class="text-xl font-bold text-slate-900 tracking-tighter">{{ number_format($m['total_consumed'], 0) }}</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase ml-0.5">{{ $m['unit'] }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-slate-300 text-xs font-bold uppercase tracking-widest italic">No Resource Data</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
