<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Project Performance') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        @forelse($investments as $investment)
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden p-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">{{ $investment->project->name }}</h3>
                    <p class="text-slate-500 font-bold text-xs uppercase tracking-widest mt-1">Investment Performance Metrics</p>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Total Return</span>
                    <span class="text-xl font-black text-emerald-600">+ ₹{{ number_format($investment->project->payouts()->where('investor_id', $investor->id)->sum('amount_paid'), 2) }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Principal</p>
                    <h4 class="text-lg font-black text-slate-900">₹{{ number_format($investment->investment_amount, 2) }}</h4>
                </div>
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Current ROI</p>
                    <h4 class="text-lg font-black text-indigo-600">
                        @php
                            $received = $investment->project->payouts()->where('investor_id', $investor->id)->sum('amount_paid');
                            $roi = $investment->investment_amount > 0 ? ($received / $investment->investment_amount) * 100 : 0;
                        @endphp
                        {{ number_format($roi, 2) }}%
                    </h4>
                </div>
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Project Status</p>
                    <h4 class="text-lg font-black text-slate-900 capitalize">{{ $investment->project->status }}</h4>
                </div>
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-center">
                    <a href="{{ route('investor.projects.details', $investment->project_id) }}" class="px-6 py-3 bg-white border border-slate-200 text-[10px] font-black rounded-xl uppercase tracking-widest hover:bg-slate-50 transition-all text-slate-600">Deep Analytics</a>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-12 text-center">
            <p class="text-slate-500 font-medium">No performance data available. Start investing to see metrics.</p>
        </div>
        @endforelse
    </div>
</x-app-layout>
