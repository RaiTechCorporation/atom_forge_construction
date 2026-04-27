<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Payout History') }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xl font-bold text-slate-900 tracking-tight">Full Ledger of Approved Payouts</h3>
            <button class="text-indigo-600 font-bold text-xs uppercase tracking-widest hover:text-indigo-800 transition-colors">Export CSV</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Transaction ID</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Project</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Date</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Amount</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Method</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($payouts as $payout)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-5 text-xs font-mono text-slate-400">#PY-{{ str_pad($payout->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-8 py-5 font-bold text-slate-900">{{ $payout->project->name }}</td>
                        <td class="px-8 py-5 text-sm text-slate-600 font-bold">{{ \Carbon\Carbon::parse($payout->payment_date)->format('M d, Y') }}</td>
                        <td class="px-8 py-5 text-right font-black text-emerald-600">₹{{ number_format($payout->amount_paid, 2) }}</td>
                        <td class="px-8 py-5 text-xs font-bold text-slate-500 uppercase">Bank Transfer</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-slate-500 font-medium">No payout history available.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
