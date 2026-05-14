<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Transaction Log') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Monitor and manage material movements across projects.') }}
                </p>
            </div>
            <a href="{{ route('material_transactions.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                {{ __('Record Movement') }}
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <p class="text-sm font-bold text-emerald-900">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <form action="{{ route('material_transactions.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                <div class="space-y-2">
                    <label for="project_id" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Project') }}</label>
                    <select id="project_id" name="project_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm font-medium">
                        <option value="">{{ __('All Projects') }}</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="material_id" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Material') }}</label>
                    <select id="material_id" name="material_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm font-medium">
                        <option value="">{{ __('All Materials') }}</option>
                        @foreach($materials as $material)
                            <option value="{{ $material->id }}" {{ request('material_id') == $material->id ? 'selected' : '' }}>
                                {{ $material->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 px-6 py-2.5 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition-all shadow-sm text-sm">
                        {{ __('Filter') }}
                    </button>
                    @if(request()->hasAny(['project_id', 'material_id']) && (request('project_id') || request('material_id')))
                        <a href="{{ route('material_transactions.index') }}" class="flex-1 inline-flex items-center justify-center px-6 py-2.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition-all text-sm">
                            {{ __('Reset') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Date</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Allocation</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Resource</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Type</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest text-center">Qty</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest text-center">Doc</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($transactions as $transaction)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-500">
                                    {{ \Carbon\Carbon::parse($transaction->date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-slate-900 uppercase tracking-tight">{{ $transaction->project->name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-slate-900 uppercase tracking-tight">{{ $transaction->material->name }}</span>
                                        <span class="text-[10px] font-medium text-slate-400 uppercase tracking-widest">{{ $transaction->material->unit }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $typeMeta = [
                                            'purchase' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'label' => 'PURCHASE'],
                                            'transfer_in' => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-700', 'label' => 'INWARD'],
                                            'transfer_out' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700', 'label' => 'OUTWARD'],
                                            'consumption' => ['bg' => 'bg-rose-100', 'text' => 'text-rose-700', 'label' => 'CONSUMPTION'],
                                        ];
                                        $meta = $typeMeta[$transaction->type] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-700', 'label' => 'OTHER'];
                                    @endphp
                                    <span class="px-2.5 py-1 {{ $meta['bg'] }} {{ $meta['text'] }} text-[10px] font-bold uppercase tracking-wider rounded-lg">
                                        {{ $meta['label'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-sm font-bold text-slate-900">{{ number_format($transaction->quantity, 1) }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($transaction->bill_path)
                                        <a href="{{ asset('storage/' . $transaction->bill_path) }}" target="_blank" class="w-8 h-8 inline-flex items-center justify-center bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 border border-slate-100 rounded-lg transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </a>
                                    @else
                                        <span class="text-slate-200">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="flex justify-end items-center gap-2">
                                        <a href="{{ route('material_transactions.edit', $transaction) }}" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('material_transactions.destroy', $transaction) }}" method="POST" class="inline-block" onsubmit="return confirm('{{ __('Are you sure you want to delete this record?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-12 h-12 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-500 uppercase tracking-widest">{{ __('No Transactions Logged') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($transactions->hasPages())
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
