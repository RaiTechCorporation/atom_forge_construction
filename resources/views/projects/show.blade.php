<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Project Portfolio') }}
                </h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">{{ __('ID:') }} {{ $project->project_code }}</span>
                    <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-2.5 py-0.5 rounded-lg border border-indigo-100 uppercase tracking-wider">{{ $project->name }}</span>
                </div>
            </div>
            <div class="flex flex-wrap gap-3 w-full md:w-auto">
                <a href="{{ route('projects.index') }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition-all shadow-sm text-xs uppercase tracking-widest">
                    Back to Portfolio
                </a>
                @php
                    $waMessage = urlencode("Project Update: {$project->name}\nStatus: " . ucfirst($project->status) . "\nBudget: ₹" . number_format($project->total_budget) . "\nSpent: ₹" . number_format($totalExpenses) . "\nRemaining: ₹" . number_format($budgetRemaining));
                @endphp
                <a href="https://wa.me/?text={{ $waMessage }}" target="_blank" class="flex-1 md:flex-none inline-flex items-center justify-center px-6 py-2.5 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-500 transition-all shadow-lg shadow-emerald-600/20 text-xs uppercase tracking-widest">
                    WhatsApp
                </a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('projects.edit', $project) }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 text-xs uppercase tracking-widest">
                        Modify Project
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="space-y-8 pb-12">
        
        <!-- Executive Dashboard Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:border-indigo-200 transition-all group">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-indigo-400"></div> Total Budget
                </span>
                <span class="text-2xl font-black text-slate-900 tracking-tighter">₹{{ number_format($project->total_budget, 0) }}</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:border-emerald-200 transition-all group">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-emerald-400"></div> Client Paid
                </span>
                <span class="text-2xl font-black text-emerald-600 tracking-tighter">₹{{ number_format($project->total_paid, 0) }}</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:border-red-200 transition-all group">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-red-400"></div> Balance Due
                </span>
                <span class="text-2xl font-black text-red-600 tracking-tighter">₹{{ number_format($project->balance_amount, 0) }}</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:border-rose-200 transition-all group">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-rose-400 animate-pulse"></div> Total Expenditure
                </span>
                <span class="text-2xl font-black text-rose-600 tracking-tighter">₹{{ number_format($totalExpenses, 0) }}</span>
            </div>
            <div class="bg-indigo-600 p-6 rounded-2xl shadow-xl shadow-indigo-600/20 flex flex-col justify-between">
                <span class="text-[10px] font-black text-indigo-200 uppercase tracking-widest mb-3">Lifecycle Stage</span>
                <div class="flex items-center gap-3">
                    <span class="text-xl font-black text-white uppercase tracking-tighter">{{ $project->status }}</span>
                </div>
            </div>
        </div>

        <!-- Detail Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left Column: Primary Details (8 Cols) -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- 01. Project Identity & Scope -->
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-600/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Architectural Scope</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Physical Specs & Design</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-slate-900 text-white text-[9px] font-black rounded-lg uppercase tracking-widest">{{ $project->building_type }}</span>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                            <div>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2">Total Area</span>
                                <span class="text-sm font-black text-slate-900 tracking-tight">{{ number_format($project->total_area_sqft) }} SQ.FT</span>
                            </div>
                            <div>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2">Vertical Floors</span>
                                <span class="text-sm font-black text-slate-900 tracking-tight">{{ $project->number_of_floors }} FLOORS</span>
                            </div>
                            <div>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2">Inventory/Units</span>
                                <span class="text-sm font-black text-slate-900 tracking-tight">{{ $project->units_count }} UNITS</span>
                            </div>
                            <div>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2">Methodology</span>
                                <span class="text-sm font-black text-slate-900 tracking-tight">{{ $project->construction_type }}</span>
                            </div>
                        </div>
                        @if($project->description)
                            <div class="mt-8 pt-8 border-t border-slate-50">
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-3">Project Abstract</span>
                                <p class="text-sm font-bold text-slate-600 leading-relaxed">{{ $project->description }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- 02. Timeline & Execution Milestones -->
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-600/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Temporal Roadmap</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Execution Timeline & Milestones</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Duration:</span>
                            <span class="text-xs font-black text-emerald-600 uppercase tracking-widest">{{ $project->estimated_duration ?: 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2">Commencement</span>
                                <span class="text-base font-black text-slate-900 tracking-tight">{{ $project->start_date ? $project->start_date->format('D, d M Y') : 'NOT SET' }}</span>
                            </div>
                            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2">Handover Target</span>
                                <span class="text-base font-black text-slate-900 tracking-tight">{{ $project->end_date ? $project->end_date->format('D, d M Y') : 'ACTIVE CONTINUOUS' }}</span>
                            </div>
                        </div>
                        
                        <!-- Milestone Progress Track -->
                        <div class="space-y-4">
                            <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-5">Milestone Checkpoints</span>
                            @php
                                $milestones = [
                                    ['label' => 'Planning & Approval', 'field' => 'milestone_planning_approval'],
                                    ['label' => 'Foundation Excavation', 'field' => 'milestone_foundation_start'],
                                    ['label' => 'Superstructure Completion', 'field' => 'milestone_structure_completion'],
                                    ['label' => 'Finishing Phase', 'field' => 'milestone_finishing_phase'],
                                    ['label' => 'Final Handover', 'field' => 'milestone_handover'],
                                ];
                            @endphp
                            <div class="space-y-3">
                                @foreach($milestones as $m)
                                    <div class="flex items-center justify-between p-4 rounded-2xl {{ $project->{$m['field']} ? 'bg-emerald-50 border border-emerald-100' : 'bg-slate-50/50 border border-slate-100 opacity-60' }}">
                                        <div class="flex items-center gap-4">
                                            <div class="w-6 h-6 rounded-full flex items-center justify-center {{ $project->{$m['field']} ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-400' }}">
                                                @if($project->{$m['field']})
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                                @else
                                                    <div class="w-1.5 h-1.5 rounded-full bg-slate-400"></div>
                                                @endif
                                            </div>
                                            <span class="text-xs font-black uppercase tracking-widest {{ $project->{$m['field']} ? 'text-emerald-800' : 'text-slate-500' }}">{{ $m['label'] }}</span>
                                        </div>
                                        <span class="text-[10px] font-black uppercase tracking-widest {{ $project->{$m['field']} ? 'text-emerald-600' : 'text-slate-400' }}">
                                            {{ $project->{$m['field']} ? $project->{$m['field']}->format('d M Y') : 'PENDING' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 03. Financial Breakdown & Budgeting -->
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center text-white shadow-lg shadow-slate-900/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Financial Allocation</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Budget Breakdown & Terms</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <!-- Estimates -->
                            <div class="space-y-4">
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-4">Budgetary Estimates</span>
                                @php
                                    $costs = [
                                        ['label' => 'Materials Allocation', 'value' => $project->est_cost_materials, 'color' => 'bg-indigo-600'],
                                        ['label' => 'Labour Workforce', 'value' => $project->est_cost_labor, 'color' => 'bg-emerald-600'],
                                        ['label' => 'Machinery & Tools', 'value' => $project->est_cost_equipment, 'color' => 'bg-amber-600'],
                                        ['label' => 'Operational/Misc', 'value' => $project->est_cost_miscellaneous, 'color' => 'bg-rose-600'],
                                    ];
                                @endphp
                                @foreach($costs as $cost)
                                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                        <div class="flex items-center gap-3">
                                            <div class="w-2 h-2 rounded-full {{ $cost['color'] }}"></div>
                                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-600">{{ $cost['label'] }}</span>
                                        </div>
                                        <span class="text-xs font-black text-slate-900 tracking-tight">₹{{ number_format($cost['value'] ?: 0) }}</span>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Billing Terms -->
                            <div class="space-y-6">
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-4">Contractual Terms</span>
                                <div class="bg-indigo-50/50 p-6 rounded-3xl border border-indigo-100">
                                    <div class="mb-6">
                                        <span class="block text-[9px] font-black text-indigo-400 uppercase tracking-[0.15em] mb-1.5">Billing Cadence</span>
                                        <span class="text-sm font-black text-indigo-900 uppercase tracking-widest">{{ $project->billing_cycle ?: 'AS PER MILESTONES' }}</span>
                                    </div>
                                    <div class="mb-6">
                                        <span class="block text-[9px] font-black text-indigo-400 uppercase tracking-[0.15em] mb-1.5">Advance Retainer</span>
                                        <span class="text-lg font-black text-indigo-900 tracking-tighter">₹{{ number_format($project->advance_payment ?: 0) }}</span>
                                    </div>
                                    @if($project->payment_terms)
                                        <div class="pt-4 border-t border-indigo-100">
                                            <span class="block text-[9px] font-black text-indigo-400 uppercase tracking-[0.15em] mb-2">Detailed Provisions</span>
                                            <p class="text-xs font-bold text-indigo-800/80 leading-relaxed">{{ $project->payment_terms }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Phases Section -->
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-600/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">04. Payment Phases</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Defined Structural Milestones</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-0">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-slate-50/50">
                                    <tr class="border-b border-slate-100">
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-500 uppercase tracking-widest">Phase Name</th>
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-500 uppercase tracking-widest">Due Date</th>
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-500 uppercase tracking-widest">Amount</th>
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-500 uppercase tracking-widest text-right">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($project->paymentPhases as $phase)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-8 py-4 whitespace-nowrap text-[11px] font-bold text-slate-700 uppercase tracking-wider">
                                                {{ $phase->phase_name }}
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-[11px] font-medium text-slate-500">
                                                {{ $phase->due_date ? $phase->due_date->format('d M Y') : 'NOT SET' }}
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-[11px] font-black text-slate-900">
                                                ₹{{ number_format($phase->amount, 2) }}
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-right">
                                                <span class="px-2 py-0.5 
                                                    {{ $phase->status === 'Paid' ? 'bg-emerald-100 text-emerald-700' : 
                                                       ($phase->status === 'Partially Paid' ? 'bg-indigo-100 text-indigo-700' : 
                                                       ($phase->status === 'Overdue' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700')) }} 
                                                    rounded-md text-[9px] font-black uppercase tracking-widest">
                                                    {{ $phase->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-8 py-10 text-center text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                                                No payment phases defined for this project
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- 05. Project Payment History -->
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-600/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">05. Payment Ledger</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Transaction History & Receipts</p>
                            </div>
                        </div>
                        <a href="{{ route('project-payments.create', ['project_id' => $project->id]) }}" class="px-4 py-2 bg-indigo-600 text-white text-[10px] font-black rounded-xl uppercase tracking-widest hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20">
                            Add Payment
                        </a>
                    </div>
                    <div class="p-0">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-slate-50/50">
                                    <tr class="border-b border-slate-100">
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-500 uppercase tracking-widest">Date</th>
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-500 uppercase tracking-widest">Amount</th>
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-500 uppercase tracking-widest">Mode</th>
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-500 uppercase tracking-widest">Ref No</th>
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-500 uppercase tracking-widest text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($project->payments->sortByDesc('payment_date') as $payment)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-8 py-4 whitespace-nowrap text-[11px] font-bold text-slate-700">
                                                {{ $payment->payment_date->format('d-m-Y') }}
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-[11px] font-black text-slate-900">
                                                ₹{{ number_format($payment->amount_paid, 2) }}
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap">
                                                <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md text-[9px] font-black uppercase tracking-widest">
                                                    {{ $payment->payment_mode }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-[11px] font-medium text-slate-500 font-mono">
                                                {{ $payment->reference_no ?: '-' }}
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    @if($payment->proof_image)
                                                        <a href="{{ asset('storage/' . $payment->proof_image) }}" target="_blank" class="p-1.5 text-slate-400 hover:text-amber-600 transition-colors" title="View Proof">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('project-payments.receipt', $payment) }}" class="p-1.5 text-slate-400 hover:text-indigo-600 transition-colors" title="Receipt">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-8 py-10 text-center text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                                                No payment history recorded
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- 06. Resource & Progress Tracking -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Resource Allocation -->
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Team & Assets</h3>
                        </div>
                        <div class="p-8 space-y-6">
                            @php
                                $resources = [
                                    ['label' => 'Assigned Core Team', 'value' => $project->assigned_team, 'icon' => 'users'],
                                    ['label' => 'Labour Requirements', 'value' => $project->labor_requirements, 'icon' => 'hard-hat'],
                                    ['label' => 'Machinery Assets', 'value' => $project->equipment_machinery, 'icon' => 'truck'],
                                ];
                            @endphp
                            @foreach($resources as $r)
                                <div>
                                    <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2">{{ $r['label'] }}</span>
                                    <div class="text-xs font-bold text-slate-700 bg-slate-50 p-3 rounded-xl border border-slate-100 min-h-[40px] flex items-center">
                                        {{ $r['value'] ?: 'RESOURCE POOL NOT DEFINED' }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Progress & Reports -->
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Execution Health</h3>
                            <span class="text-xl font-black text-indigo-600 tracking-tighter">{{ $project->progress_percent }}%</span>
                        </div>
                        <div class="p-8 space-y-6">
                            <div class="relative h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="absolute h-full bg-indigo-600 rounded-full" style="width: {{ $project->progress_percent }}%"></div>
                            </div>
                            <div>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2">Task Assignments</span>
                                <div class="text-xs font-bold text-slate-700 bg-slate-50 p-3 rounded-xl border border-slate-100 min-h-[60px]">
                                    {{ $project->task_assignments ?: 'NO ACTIVE TASKS LOGGED' }}
                                </div>
                            </div>
                            <div>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2">Active Issues</span>
                                <div class="text-[10px] font-black {{ $project->issue_tracking ? 'text-rose-600' : 'text-emerald-600' }} uppercase tracking-widest">
                                    {{ $project->issue_tracking ?: 'SYSTEMS OPTIMIZED / NO ISSUES' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 07. Risk, Issues & Media -->
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">07. Operational Intelligence</h3>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <div class="space-y-6">
                                <div>
                                    <span class="block text-[9px] font-black text-rose-400 uppercase tracking-[0.15em] mb-2">Critical Risks Identified</span>
                                    <p class="text-xs font-bold text-slate-600 leading-relaxed">{{ $project->identified_risks ?: 'NO CRITICAL THREATS LOGGED' }}</p>
                                </div>
                                <div class="pt-6 border-t border-slate-50">
                                    <span class="block text-[9px] font-black text-emerald-400 uppercase tracking-[0.15em] mb-2">Mitigation Strategy</span>
                                    <p class="text-xs font-bold text-slate-600 leading-relaxed">{{ $project->mitigation_plans ?: 'STANDARD OPERATING PROCEDURES' }}</p>
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div>
                                    <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2">Delay Post-Mortem</span>
                                    <p class="text-xs font-bold text-slate-600 leading-relaxed">{{ $project->delay_reasons ?: 'ON-SCHEDULE PERFORMANCE' }}</p>
                                </div>
                                <div class="pt-6 border-t border-slate-50">
                                    <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-3">Compliance Alerts</span>
                                    <div class="flex gap-4">
                                        <span class="px-2 py-1 {{ $project->deadline_alerts ? 'bg-indigo-50 text-indigo-600 border border-indigo-100' : 'bg-slate-50 text-slate-400' }} rounded text-[8px] font-black uppercase tracking-widest">Deadline</span>
                                        <span class="px-2 py-1 {{ $project->budget_alerts ? 'bg-rose-50 text-rose-600 border border-rose-100' : 'bg-slate-50 text-slate-400' }} rounded text-[8px] font-black uppercase tracking-widest">Budget</span>
                                        <span class="px-2 py-1 {{ $project->task_reminders ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-50 text-slate-400' }} rounded text-[8px] font-black uppercase tracking-widest">Tasks</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Media Gallery Section -->
                        @if(($project->site_media && count($project->site_media) > 0) || ($project->progress_photos && count($project->progress_photos) > 0) || $project->labourWorkProgress->count() > 0)
                            <div class="mt-12 pt-8 border-t border-slate-50">
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.15em] mb-5">Visual Media Gallery</span>
                                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
                                    @foreach(array_merge($project->site_media ?? [], $project->progress_photos ?? []) as $media)
                                        <div class="aspect-square bg-slate-100 rounded-2xl overflow-hidden border border-slate-200 group relative">
                                            @if(Str::endsWith($media, ['.mp4', '.mov', '.avi']))
                                                <div class="w-full h-full bg-slate-900 overflow-hidden relative">
                                                    <video class="w-full h-full object-cover">
                                                        <source src="{{ asset('storage/' . $media) }}" type="video/mp4">
                                                    </video>
                                                    <div class="absolute inset-0 flex items-center justify-center">
                                                        <div class="w-8 h-8 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"></path></svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <img src="{{ asset('storage/' . $media) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            @endif
                                            <div class="absolute inset-0 bg-indigo-600/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                <a href="{{ asset('storage/' . $media) }}" target="_blank" class="p-2 bg-white rounded-full text-indigo-600 shadow-xl">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Daily Work Progress Media --}}
                                    @foreach($project->labourWorkProgress as $progress)
                                        <div class="aspect-square bg-slate-100 rounded-2xl overflow-hidden border border-slate-200 group relative">
                                            @php
                                                $fileExists = Storage::disk('public')->exists($progress->file_path);
                                            @endphp

                                            @if(!$fileExists)
                                                <div class="w-full h-full bg-slate-100 flex flex-col items-center justify-center p-4 text-center">
                                                    <svg class="w-6 h-6 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    <span class="text-[7px] font-black text-slate-400 uppercase tracking-widest leading-tight">Media Missing</span>
                                                </div>
                                            @elseif($progress->file_type === 'video')
                                                <div class="w-full h-full bg-slate-900 overflow-hidden relative">
                                                    <video class="w-full h-full object-cover">
                                                        <source src="{{ asset('storage/' . $progress->file_path) }}" type="video/mp4">
                                                    </video>
                                                    <div class="absolute inset-0 flex items-center justify-center">
                                                        <div class="w-8 h-8 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"></path></svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <img src="{{ asset('storage/' . $progress->file_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            @endif
                                            
                                            <!-- Site Manager & Date Overlay -->
                                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-3">
                                                <p class="text-[7px] font-black text-white uppercase tracking-widest mb-0.5 truncate">{{ $progress->siteManager?->name ?? 'Site Manager' }}</p>
                                                <p class="text-[6px] font-bold text-indigo-300 uppercase tracking-[0.2em] mb-2">{{ \Carbon\Carbon::parse($progress->date)->format('d M, Y') }}</p>
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ asset('storage/' . $progress->file_path) }}" target="_blank" class="p-1.5 bg-white/20 hover:bg-white/40 text-white rounded-lg transition-colors backdrop-blur-md">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                    </a>
                                                    @if($progress->latitude && $progress->longitude)
                                                        <a href="https://www.google.com/maps/search/?api=1&query={{ $progress->latitude }},{{ $progress->longitude }}" target="_blank" class="p-1.5 bg-indigo-500/20 hover:bg-indigo-500/40 text-white rounded-lg transition-colors backdrop-blur-md">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- 08. Expense Ledger -->
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-rose-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-rose-600/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Expense Ledger</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Detailed Expenditure Log</p>
                            </div>
                        </div>
                        <a href="{{ route('expenses.create', ['project_id' => $project->id]) }}" class="px-4 py-2 bg-rose-50 text-rose-600 text-[10px] font-black rounded-lg uppercase tracking-widest hover:bg-rose-100 transition-all border border-rose-100">
                            Record Expense
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Date</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Category</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Description</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($project->expenses as $expense)
                                    <tr class="hover:bg-slate-50/50 transition-colors group">
                                        <td class="px-8 py-4 text-xs font-bold text-slate-500">
                                            {{ $expense->date ? \Carbon\Carbon::parse($expense->date)->format('d M, Y') : 'N/A' }}
                                        </td>
                                        <td class="px-8 py-4">
                                            <span class="px-2 py-1 bg-slate-100 text-slate-600 text-[9px] font-black rounded-md uppercase tracking-widest">
                                                {{ str_replace('_', ' ', $expense->category) }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-4 text-xs font-bold text-slate-600 truncate max-w-[200px]" title="{{ $expense->description }}">
                                            {{ $expense->description }}
                                        </td>
                                        <td class="px-8 py-4 text-xs font-black text-slate-900 text-right tracking-tight">
                                            ₹{{ number_format($expense->amount, 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-8 py-12 text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                            No expenses logged for this project scope.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if($project->expenses->count() > 0)
                                <tfoot>
                                    <tr class="bg-rose-50/30">
                                        <td colspan="3" class="px-8 py-4 text-[10px] font-black text-rose-600 uppercase tracking-widest text-right">Cumulative Total:</td>
                                        <td class="px-8 py-4 text-sm font-black text-rose-600 text-right tracking-tighter">
                                            ₹{{ number_format($totalExpenses, 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>

            </div>

            <!-- Right Column: Contextual Data (4 Cols) -->
            <div class="lg:col-span-4 space-y-8">
                
                <!-- Geographical Context -->
                <div class="bg-slate-900 rounded-3xl p-8 text-white shadow-2xl shadow-slate-900/40 relative overflow-hidden group">
                    <div class="absolute -right-12 -top-12 w-40 h-40 bg-indigo-600/20 rounded-full blur-3xl group-hover:bg-indigo-500/30 transition-all duration-700"></div>
                    <div class="relative z-10">
                        <h4 class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-6">Site Geolocation</h4>
                        <div class="space-y-6">
                            <div>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Primary Site Address</span>
                                <p class="text-sm font-black leading-relaxed tracking-tight">{{ $project->site_address }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-6 pt-6 border-t border-white/5">
                                <div>
                                    <span class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">City/Urban Hub</span>
                                    <span class="text-xs font-black uppercase tracking-widest">{{ $project->city }}</span>
                                </div>
                                <div>
                                    <span class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">State/Region</span>
                                    <span class="text-xs font-black uppercase tracking-widest">{{ $project->state }}</span>
                                </div>
                            </div>
                            @if($project->gps_coordinates)
                                <div class="pt-6 border-t border-white/5 flex items-center justify-between">
                                    <div>
                                        <span class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">GPS Coordinates</span>
                                        <span class="text-[10px] font-black text-indigo-400 tracking-widest uppercase">{{ $project->gps_coordinates }}</span>
                                    </div>
                                    <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Stakeholder Matrix -->
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Stakeholder Matrix</h3>
                    </div>
                    <div class="p-8 space-y-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center font-black text-lg">
                                {{ substr($project->client_name, 0, 1) }}
                            </div>
                            <div>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Asset Proprietor</span>
                                <h5 class="text-sm font-black text-slate-900 tracking-tight">{{ $project->client_name }}</h5>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $project->client_email }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-5 pt-8 border-t border-slate-50">
                            @php
                                $stakeholders = [
                                    ['role' => 'Principal Contractor', 'name' => $project->contractor_name, 'icon' => 'building-2'],
                                    ['role' => 'Project Director', 'name' => $project->project_manager, 'icon' => 'user-check'],
                                    ['role' => 'Architectural Lead', 'name' => $project->architect, 'icon' => 'pen-tool'],
                                    ['role' => 'Lead Consultant', 'name' => $project->consultant, 'icon' => 'shield-check'],
                                ];
                            @endphp
                            @foreach($stakeholders as $sh)
                                <div class="flex items-start gap-4">
                                    <div class="w-2 h-2 rounded-full bg-slate-300 mt-1.5"></div>
                                    <div>
                                        <span class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">{{ $sh['role'] }}</span>
                                        <span class="text-xs font-black text-slate-800 uppercase tracking-wider">{{ $sh['name'] ?: 'UNASSIGNED' }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Document Archives -->
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Audit Archives</h3>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div class="p-8 space-y-6">
                        @php
                            $docCategories = [
                                ['label' => 'Design Schemes', 'field' => 'design_documents'],
                                ['label' => 'Legal Accords', 'field' => 'contracts_agreements'],
                                ['label' => 'Statutory Permits', 'field' => 'permits_licenses'],
                                ['label' => 'OHS Documents', 'field' => 'safety_documents'],
                                ['label' => 'Site Blueprints', 'field' => 'blueprints_layouts'],
                            ];
                        @endphp
                        @foreach($docCategories as $cat)
                            <div class="flex items-center justify-between group cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <div class="w-1.5 h-1.5 bg-slate-300 rounded-full group-hover:bg-indigo-500 transition-colors"></div>
                                    <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest group-hover:text-slate-900">{{ $cat['label'] }}</span>
                                </div>
                                <span class="px-2 py-0.5 bg-slate-50 text-[8px] font-black text-slate-400 rounded-md border border-slate-100 group-hover:border-indigo-100 group-hover:text-indigo-600 uppercase tracking-widest transition-all">
                                    {{ is_array($project->{$cat['field']}) ? count($project->{$cat['field']}) : 0 }} Files
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>