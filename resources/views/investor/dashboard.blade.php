<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Investor Dashboard') }}
            </h2>
            <div class="flex items-center gap-2">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-lg transition-colors border border-slate-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                        Back to Admin
                    </a>
                @endif
                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-xs font-bold rounded-full uppercase tracking-wider border border-emerald-100">
                    {{ $investor->status }} Profile
                </span>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-slate-500 font-bold text-xs uppercase tracking-widest mb-1">Total Investment</p>
                <h3 class="text-3xl font-black text-slate-900">₹{{ number_format($stats['total_invested'], 2) }}</h3>
            </div>

            <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <p class="text-slate-500 font-bold text-xs uppercase tracking-widest mb-1">Active Projects</p>
                <h3 class="text-3xl font-black text-slate-900">{{ $stats['project_count'] }}</h3>
            </div>

            <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <p class="text-slate-500 font-bold text-xs uppercase tracking-widest mb-1">Total Payouts Received</p>
                <h3 class="text-3xl font-black text-slate-900">₹{{ number_format($stats['total_payouts'], 2) }}</h3>
            </div>
        </div>

        <!-- Available for Funding -->
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-xl font-bold text-slate-900 tracking-tight">Available Projects for Funding</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Project Name</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Budget</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($availableProjects as $project)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5">
                                <div class="font-bold text-slate-900">{{ $project->name }}</div>
                                <div class="text-xs text-slate-500 font-medium">{{ $project->location }}</div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="text-sm font-black text-slate-900">₹{{ number_format($project->total_budget, 2) }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black rounded-lg uppercase tracking-wider">
                                    Seeking Funding
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <a href="{{ route('investor.projects.details', $project->id) }}" class="text-indigo-600 hover:text-indigo-800 font-bold text-xs uppercase tracking-wider">Invest Now</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center text-slate-500 font-medium">
                                No new projects currently seeking funding.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Investment History -->
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-xl font-bold text-slate-900 tracking-tight">Investment Portfolio</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Project Name</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Date</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Amount</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($investments as $investment)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5">
                                <div class="font-bold text-slate-900">{{ $investment->project->name }}</div>
                                <div class="text-xs text-slate-500 font-medium">{{ $investment->project->location }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-sm text-slate-600 font-bold">{{ \Carbon\Carbon::parse($investment->investment_date)->format('M d, Y') }}</div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="text-sm font-black text-slate-900">₹{{ number_format($investment->investment_amount, 2) }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-2.5 py-1 {{ $investment->status === 'approved' ? 'bg-emerald-50 text-emerald-600' : ($investment->status === 'rejected' ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600') }} text-[10px] font-black rounded-lg uppercase tracking-wider">
                                    {{ $investment->status }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <a href="{{ route('investor.projects.details', $investment->project_id) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase tracking-wider">View Details</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center text-slate-500 font-medium">
                                No investments found in your portfolio.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
