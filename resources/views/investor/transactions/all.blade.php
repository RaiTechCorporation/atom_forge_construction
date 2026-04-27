<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('All Transactions') }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xl font-bold text-slate-900 tracking-tight">Financial Timeline</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Type</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Date</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Reference</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Amount</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($investments as $inv)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-5">
                            <span class="flex items-center gap-2 text-[10px] font-black uppercase text-indigo-600">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>
                                Investment
                            </span>
                        </td>
                        <td class="px-8 py-5 text-sm text-slate-600 font-bold">{{ \Carbon\Carbon::parse($inv->investment_date)->format('M d, Y') }}</td>
                        <td class="px-8 py-5 text-sm text-slate-900 font-bold">{{ $inv->project->name }}</td>
                        <td class="px-8 py-5 text-right font-black text-slate-900">- ₹{{ number_format($inv->investment_amount, 2) }}</td>
                        <td class="px-8 py-5">
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-[10px] font-black rounded-lg uppercase tracking-wider">{{ $inv->status }}</span>
                        </td>
                    </tr>
                    @endforeach

                    @foreach($payouts as $pay)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-5">
                            <span class="flex items-center gap-2 text-[10px] font-black uppercase text-emerald-600">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                Payout
                            </span>
                        </td>
                        <td class="px-8 py-5 text-sm text-slate-600 font-bold">{{ \Carbon\Carbon::parse($pay->payment_date)->format('M d, Y') }}</td>
                        <td class="px-8 py-5 text-sm text-slate-900 font-bold">{{ $pay->project->name }}</td>
                        <td class="px-8 py-5 text-right font-black text-emerald-600">+ ₹{{ number_format($pay->amount_paid, 2) }}</td>
                        <td class="px-8 py-5">
                            <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-lg uppercase tracking-wider">{{ $pay->status }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
