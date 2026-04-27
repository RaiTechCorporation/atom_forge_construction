<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Completed Investments') }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50">
            <h3 class="text-xl font-bold text-slate-900 tracking-tight">Investment History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Project Name</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Budget</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Invested Amount</th>
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
                        <td class="px-8 py-5 text-right">
                            <div class="text-sm font-black text-slate-900">₹{{ number_format($investment->project->total_budget, 2) }}</div>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="text-sm font-black text-slate-900">₹{{ number_format($investment->investment_amount, 2) }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-[10px] font-black rounded-lg uppercase tracking-wider">
                                Completed
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            <a href="{{ route('investor.projects.details', $investment->project_id) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase tracking-wider">View Summary</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-slate-500 font-medium">
                            No completed investments found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
