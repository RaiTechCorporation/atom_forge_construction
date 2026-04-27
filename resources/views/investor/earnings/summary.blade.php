<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Earnings Summary') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Totals Card -->
        <div class="bg-indigo-600 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-indigo-600/30">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div>
                    <p class="text-indigo-200 text-xs font-black uppercase tracking-[0.2em] mb-3">Total Earnings Paid</p>
                    <h3 class="text-4xl font-black">₹{{ number_format($investor->payouts()->where('status', 'approved')->sum('amount_paid'), 2) }}</h3>
                </div>
                <div>
                    <p class="text-indigo-200 text-xs font-black uppercase tracking-[0.2em] mb-3">Pending Payouts</p>
                    <h3 class="text-4xl font-black">₹{{ number_format($investor->payouts()->where('status', 'pending')->sum('amount_paid'), 2) }}</h3>
                </div>
                <div>
                    <p class="text-indigo-200 text-xs font-black uppercase tracking-[0.2em] mb-3">Active Projects</p>
                    <h3 class="text-4xl font-black">{{ $investor->investments()->where('status', 'approved')->count() }}</h3>
                </div>
            </div>
        </div>

        <!-- Recent Payouts -->
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50">
                <h3 class="text-xl font-bold text-slate-900 tracking-tight">Recent Payouts</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Project</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Date</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Amount</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($payouts as $payout)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5 font-bold text-slate-900">{{ $payout->project->name }}</td>
                            <td class="px-8 py-5 text-sm text-slate-600 font-bold">{{ \Carbon\Carbon::parse($payout->payment_date)->format('M d, Y') }}</td>
                            <td class="px-8 py-5 text-right font-black text-slate-900">₹{{ number_format($payout->amount_paid, 2) }}</td>
                            <td class="px-8 py-5">
                                <span class="px-2.5 py-1 {{ $payout->status === 'approved' ? 'bg-emerald-50 text-emerald-600' : 'bg-blue-50 text-blue-600' }} text-[10px] font-black rounded-lg uppercase tracking-wider">
                                    {{ $payout->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center text-slate-500 font-medium">No earnings recorded yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
