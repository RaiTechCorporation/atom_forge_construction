<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Payment Receipts') }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden p-8">
        <h3 class="text-xl font-bold text-slate-900 tracking-tight mb-8">Investment & Payout Receipts</h3>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Type</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Date</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Amount</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <tr>
                        <td class="px-8 py-5">
                            <span class="text-[10px] font-black uppercase text-indigo-600">Investment Receipt</span>
                        </td>
                        <td class="px-8 py-5 text-sm text-slate-600 font-bold">Mar 10, 2026</td>
                        <td class="px-8 py-5 text-right font-black text-slate-900">₹5,00,000.00</td>
                        <td class="px-8 py-5">
                            <button class="text-indigo-600 hover:text-indigo-800 font-bold text-xs uppercase tracking-wider">Download</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
