<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('ROI Analytics') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
                <h3 class="text-xl font-bold text-slate-900 tracking-tight mb-6">Cumulative Returns</h3>
                <div class="h-64 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 font-bold uppercase tracking-widest text-xs border-2 border-dashed border-slate-200">
                    Interactive ROI Chart Placeholder
                </div>
            </div>
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
                <h3 class="text-xl font-bold text-slate-900 tracking-tight mb-6">Distribution by Project Type</h3>
                <div class="h-64 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 font-bold uppercase tracking-widest text-xs border-2 border-dashed border-slate-200">
                    Portfolio Allocation Chart Placeholder
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
            <h3 class="text-xl font-bold text-slate-900 tracking-tight mb-8">Performance Breakdown</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Average Project ROI</p>
                    <p class="text-3xl font-black text-indigo-600">12.4%</p>
                </div>
                <div class="text-center">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Annualized Yield</p>
                    <p class="text-3xl font-black text-emerald-600">8.2%</p>
                </div>
                <div class="text-center">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Payout Frequency</p>
                    <p class="text-3xl font-black text-slate-900">Quarterly</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
