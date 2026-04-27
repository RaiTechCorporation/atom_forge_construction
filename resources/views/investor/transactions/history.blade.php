<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Investment History') }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xl font-bold text-slate-900 tracking-tight">Record of Capital Deployed</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Date</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Project</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Amount</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($investments as $inv)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-5 text-sm text-slate-600 font-bold">{{ \Carbon\Carbon::parse($inv->investment_date)->format('M d, Y') }}</td>
                        <td class="px-8 py-5 font-bold text-slate-900">{{ $inv->project->name }}</td>
                        <td class="px-8 py-5 text-right font-black text-slate-900">₹{{ number_format($inv->investment_amount, 2) }}</td>
                        <td class="px-8 py-5">
                            <span class="px-2.5 py-1 {{ $inv->status === 'approved' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-50 text-slate-500' }} text-[10px] font-black rounded-lg uppercase tracking-wider">
                                {{ $inv->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-12 text-center text-slate-500 font-medium">No investment history found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
