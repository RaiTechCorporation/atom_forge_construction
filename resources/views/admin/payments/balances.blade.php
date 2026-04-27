<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Project Balance Analysis') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Automated calculation of budgets, payments, and outstanding balances.') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ __('Project Details') }}</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ __('Client') }}</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">{{ __('Total Budget') }}</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">{{ __('Total Paid') }}</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">{{ __('Balance Due') }}</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest text-center">{{ __('Payment Progress') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($projects as $project)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-slate-900 leading-tight mb-0.5">{{ $project->name }}</span>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $project->project_code }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6 whitespace-nowrap text-xs font-bold text-slate-600">
                                    {{ $project->client_name ?? ($project->client->name ?? 'N/A') }}
                                </td>
                                <td class="px-6 py-6 whitespace-nowrap text-sm font-black text-slate-900 text-right">
                                    ₹{{ number_format($project->total_budget, 2) }}
                                </td>
                                <td class="px-6 py-6 whitespace-nowrap text-sm font-black text-emerald-600 text-right">
                                    ₹{{ number_format($project->total_paid, 2) }}
                                </td>
                                <td class="px-6 py-6 whitespace-nowrap text-sm font-black text-red-600 text-right">
                                    ₹{{ number_format($project->balance_amount, 2) }}
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex flex-col items-center gap-2">
                                        @php
                                            $percentage = $project->total_budget > 0 ? ($project->total_paid / $project->total_budget) * 100 : 0;
                                            $percentage = min(100, max(0, $percentage));
                                        @endphp
                                        <div class="w-full max-w-[100px] h-2 bg-slate-100 rounded-full overflow-hidden">
                                            <div class="h-full bg-indigo-500 rounded-full" style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <span class="text-[10px] font-black text-slate-500">{{ number_format($percentage, 1) }}%</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
