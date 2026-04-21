<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Project Overview') }}
                </h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-sm font-medium text-slate-500">{{ __('Project:') }}</span>
                    <span class="text-sm font-bold text-indigo-600 bg-indigo-50 px-2.5 py-0.5 rounded-lg border border-indigo-100">{{ $project->name }}</span>
                </div>
            </div>
            <div class="flex flex-wrap gap-3 w-full md:w-auto">
                <a href="{{ route('projects.index') }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition-all shadow-sm text-xs">
                    Back to Portfolio
                </a>
                @php
                    $waMessage = urlencode("Project Update: {$project->name}\nStatus: " . ucfirst($project->status) . "\nBudget: ₹" . number_format($project->total_budget) . "\nSpent: ₹" . number_format($totalExpenses) . "\nRemaining: ₹" . number_format($budgetRemaining));
                @endphp
                <a href="https://wa.me/?text={{ $waMessage }}" target="_blank" class="flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-500 transition-all shadow-lg shadow-emerald-600/20 text-xs">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412 0 6.556-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.29-4.143c1.589.943 3.513 1.441 5.465 1.441 5.176 0 9.385-4.209 9.388-9.386 0-2.509-.977-4.866-2.753-6.642s-4.133-2.752-6.642-2.752c-5.178 0-9.389 4.21-9.391 9.388 0 2.062.539 4.074 1.562 5.834l-.999 3.647 3.734-.98l-.364-.25zm11.367-7.4c-.273-.137-1.617-.798-1.867-.889-.252-.09-.435-.137-.617.137-.182.273-.706.889-.867 1.072-.162.182-.323.205-.597.069-.273-.137-1.154-.425-2.198-1.356-.812-.724-1.36-1.618-1.52-1.892-.162-.273-.017-.421.12-.557.123-.122.273-.32.41-.48.137-.16.183-.273.273-.456.091-.183.046-.343-.023-.48-.069-.137-.617-1.486-.844-2.035-.221-.532-.444-.459-.617-.468-.159-.009-.342-.01-.525-.01s-.48.069-.731.343c-.251.274-.959.937-.959 2.285s.982 2.651 1.12 2.834c.137.183 1.932 2.951 4.68 4.141.654.283 1.165.452 1.564.578.658.209 1.257.179 1.73.109.527-.079 1.617-.662 1.846-1.301.228-.64.228-1.187.16-1.302-.069-.114-.251-.182-.524-.319z"/></svg>
                    WhatsApp
                </a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('projects.edit', $project) }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 text-xs">
                        Edit Project
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        
        <!-- Strategic Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:border-indigo-200 transition-all">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Contract Budget</span>
                <span class="text-xl font-bold text-slate-900 tracking-tight">₹{{ number_format($project->total_budget, 0) }}</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:border-red-200 transition-all">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Total Burn</span>
                <span class="text-xl font-bold text-red-600 tracking-tight">₹{{ number_format($totalExpenses, 0) }}</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:border-emerald-200 transition-all">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Headroom</span>
                <span class="text-xl font-bold text-emerald-600 tracking-tight">₹{{ number_format($budgetRemaining, 0) }}</span>
            </div>
            <div class="bg-slate-900 p-6 rounded-2xl shadow-lg shadow-slate-900/10 flex flex-col justify-between">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Capital Inflow</span>
                <span class="text-xl font-bold text-white tracking-tight">₹{{ number_format($totalInvested, 0) }}</span>
            </div>
            <div class="bg-indigo-600 p-6 rounded-2xl shadow-lg shadow-indigo-600/10 flex flex-col justify-between">
                <span class="text-[10px] font-bold text-indigo-200 uppercase tracking-widest mb-3">Phase Status</span>
                <span class="text-lg font-bold text-white uppercase tracking-wider">{{ $project->status }}</span>
            </div>
        </div>

        <!-- Financial Health Monitor -->
        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">Capital Utilization Monitor</h3>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Monitoring spend against invested capital liquidity</p>
                </div>
                <div class="bg-slate-50 border border-slate-100 px-4 py-2 rounded-xl text-center">
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest block mb-0.5">Coverage Status</span>
                    <span class="text-sm font-bold {{ $totalInvested >= $totalExpenses ? 'text-emerald-600' : 'text-red-600' }} uppercase tracking-wider">
                        {{ $totalInvested >= $totalExpenses ? 'SURPLUS LIQUIDITY' : 'CAPITAL DEFICIT' }}
                    </span>
                </div>
            </div>
            @php
                $utilPercentage = $totalInvested > 0 ? ($totalExpenses / $totalInvested) * 100 : 0;
                $utilBarColor = $utilPercentage > 100 ? 'bg-red-500' : 'bg-indigo-600';
            @endphp
            <div class="relative h-10 bg-slate-50 border border-slate-100 rounded-full overflow-hidden mb-4 p-1">
                <div class="h-full {{ $utilBarColor }} rounded-full transition-all duration-1000 ease-out shadow-sm" style="width: {{ min($utilPercentage, 100) }}%"></div>
                <div class="absolute inset-0 flex items-center justify-center font-bold text-[11px] tracking-widest {{ $utilPercentage > 50 ? 'text-white' : 'text-slate-700' }}">
                    {{ number_format($utilPercentage, 1) }}% UTILIZED
                </div>
            </div>
            <div class="flex justify-between items-center text-[10px] font-bold uppercase tracking-widest text-slate-500 px-2">
                <span>Incurred Costs: ₹{{ number_format($totalExpenses, 0) }}</span>
                <span>Total Inflow: ₹{{ number_format($totalInvested, 0) }}</span>
            </div>
        </div>

        <!-- Detailed Audit Grids -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Asset Info -->
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="text-base font-bold text-slate-900 mb-8 pb-4 border-b border-slate-50 flex items-center gap-3">
                    <span class="w-8 h-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center text-xs font-bold">01</span>
                    Project Metadata
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Stakeholder / Client</span>
                        <span class="text-sm font-bold text-slate-900">{{ $project->client_name }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Geographical Site</span>
                        <span class="text-sm font-bold text-slate-900">{{ $project->location }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Commencement</span>
                        <span class="text-sm font-bold text-slate-900">{{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Scheduled Completion</span>
                        <span class="text-sm font-bold text-slate-900">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : 'ACTIVE CONTINUOUS' }}</span>
                    </div>
                </div>
            </div>

            <!-- Ledger Peek -->
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex justify-between items-center mb-8 pb-4 border-b border-slate-50">
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-3">
                        <span class="w-8 h-8 bg-red-50 text-red-600 rounded-lg flex items-center justify-center text-xs font-bold">02</span>
                        Recent Burn
                    </h3>
                    <a href="{{ route('expenses.create', ['project_id' => $project->id]) }}" class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest hover:text-indigo-500 transition-colors">+ Add Record</a>
                </div>
                <div class="space-y-3">
                    @forelse($project->expenses->sortByDesc('date')->take(5) as $expense)
                        <div class="flex items-center justify-between p-3.5 bg-slate-50/50 border border-slate-100 rounded-xl hover:bg-slate-50 hover:border-indigo-100 transition-all group">
                            <div class="flex items-center gap-4">
                                <span class="text-[11px] font-bold text-slate-400 w-12">{{ \Carbon\Carbon::parse($expense->date)->format('d M') }}</span>
                                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider group-hover:text-indigo-600 transition-colors">{{ str_replace('_', ' ', $expense->category) }}</span>
                            </div>
                            <span class="text-sm font-bold text-slate-900 tracking-tight">₹{{ number_format($expense->amount, 0) }}</span>
                        </div>
                    @empty
                        <div class="py-10 text-center text-slate-400 font-medium text-xs tracking-widest italic">Zero Expenditure Records</div>
                    @endforelse
                </div>
            </div>

            <!-- Workforce Monitor -->
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex justify-between items-center mb-8 pb-4 border-b border-slate-50">
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-3">
                        <span class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center text-xs font-bold">03</span>
                        Labour Force
                    </h3>
                    <a href="{{ route('attendance.create', ['project_id' => $project->id]) }}" class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest hover:text-indigo-500 transition-colors">+ Mark Present</a>
                </div>
                <div class="space-y-3">
                    @forelse($project->attendances->sortByDesc('date')->take(5) as $attendance)
                        <div class="flex items-center justify-between p-3.5 bg-slate-50/50 border border-slate-100 rounded-xl hover:bg-slate-50 transition-all">
                            <div class="flex items-center gap-4">
                                <span class="w-2 h-2 rounded-full {{ $attendance->status === 'present' ? 'bg-emerald-500 shadow-sm shadow-emerald-500/50' : 'bg-red-500' }}"></span>
                                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">{{ $attendance->labour->name }}</span>
                            </div>
                            <span class="text-[11px] font-bold text-slate-400">{{ \Carbon\Carbon::parse($attendance->date)->format('d M') }}</span>
                        </div>
                    @empty
                        <div class="py-10 text-center text-slate-400 font-medium text-xs tracking-widest italic">No Attendance History</div>
                    @endforelse
                </div>
            </div>

            <!-- Inventory Movements -->
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex justify-between items-center mb-8 pb-4 border-b border-slate-50">
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-3">
                        <span class="w-8 h-8 bg-slate-100 text-slate-900 rounded-lg flex items-center justify-center text-xs font-bold">04</span>
                        Resource Audit
                    </h3>
                    <a href="{{ route('material_transactions.create', ['project_id' => $project->id]) }}" class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest hover:text-indigo-500 transition-colors">+ Log Stock</a>
                </div>
                <div class="space-y-3">
                    @forelse($project->materialTransactions->sortByDesc('date')->take(5) as $transaction)
                        <div class="flex items-center justify-between p-3.5 bg-slate-50/50 border border-slate-100 rounded-xl hover:bg-slate-50 transition-all">
                            <div class="flex items-center gap-3">
                                <span class="text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full border {{ $transaction->type === 'purchase' || $transaction->type === 'transfer_in' ? 'bg-emerald-50 border-emerald-100 text-emerald-600' : 'bg-red-50 border-red-100 text-red-600' }}">
                                    {{ $transaction->type === 'purchase' || $transaction->type === 'transfer_in' ? 'IN' : 'OUT' }}
                                </span>
                                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">{{ $transaction->material->name }}</span>
                            </div>
                            <span class="text-sm font-bold text-slate-900 tracking-tight">{{ $transaction->quantity }} {{ $transaction->material->unit }}</span>
                        </div>
                    @empty
                        <div class="py-10 text-center text-slate-400 font-medium text-xs tracking-widest italic">No Material Movement</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
