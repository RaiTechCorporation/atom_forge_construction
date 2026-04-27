<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Portfolio Overview') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Dashboard Stats logic already in index, so I'll reuse dashboard.blade.php structure or link to it -->
        <div class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm relative overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Total Invested</span>
                    <span class="text-3xl font-black text-slate-900">₹{{ number_format($stats['total_invested'], 2) }}</span>
                    <span class="text-[10px] font-bold text-emerald-500 mt-2 uppercase">Verified Capital</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Total Returns</span>
                    <span class="text-3xl font-black text-emerald-600">₹{{ number_format($stats['total_payouts'], 2) }}</span>
                    <span class="text-[10px] font-bold text-slate-400 mt-2 uppercase">Cash Distributed</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Active Projects</span>
                    <span class="text-3xl font-black text-slate-900">{{ $stats['project_count'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 mt-2 uppercase">Running Assets</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Average ROI</span>
                    <span class="text-3xl font-black text-indigo-600">
                        @php
                            $avgRoi = $stats['total_invested'] > 0 ? ($stats['total_payouts'] / $stats['total_invested']) * 100 : 0;
                        @endphp
                        {{ number_format($avgRoi, 2) }}%
                    </span>
                    <span class="text-[10px] font-bold text-slate-400 mt-2 uppercase">Portfolio Yield</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden p-8">
            <h3 class="text-xl font-bold text-slate-900 tracking-tight mb-8">Asset Allocation</h3>
            <div class="h-64 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 font-bold uppercase tracking-widest text-xs border-2 border-dashed border-slate-200">
                Asset Allocation Chart Placeholder
            </div>
        </div>
    </div>
</x-app-layout>
