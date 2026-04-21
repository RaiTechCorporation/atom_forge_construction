<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 py-2">
            <div>
                <h2 class="font-black text-3xl text-black leading-tight tracking-tighter uppercase">
                    {{ __('Transaction Log') }}
                </h2>
                <p class="mt-1 text-base font-bold text-slate-800">
                    {{ __('Chronological record of all material movements.') }}
                </p>
            </div>
            <a href="{{ route('material_transactions.create') }}" class="w-full md:w-auto inline-flex items-center justify-center px-8 py-4 bg-yellow-400 border-4 border-black text-black font-black rounded-xl hover:bg-yellow-500 transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-sm uppercase tracking-widest">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                Record Movement
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            @if(session('success'))
                <div class="bg-emerald-100 border-4 border-black p-6 rounded-2xl flex items-center gap-4 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] animate-fade-in" role="alert">
                    <div class="w-10 h-10 bg-emerald-600 border-2 border-black rounded-full flex items-center justify-center text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="font-black text-black uppercase tracking-tight">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Filters -->
            <div class="bg-white p-8 rounded-2xl border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <form action="{{ route('material_transactions.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                    <div>
                        <label for="project_id" class="block text-xs font-black text-black uppercase tracking-[0.2em] mb-2">{{ __('Project') }}</label>
                        <select id="project_id" name="project_id" class="block w-full border-4 border-black bg-white px-4 py-3 text-black font-black uppercase tracking-tight focus:ring-0 focus:border-black rounded-xl shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-sm">
                            <option value="">{{ __('All Projects') }}</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="material_id" class="block text-xs font-black text-black uppercase tracking-[0.2em] mb-2">{{ __('Material') }}</label>
                        <select id="material_id" name="material_id" class="block w-full border-4 border-black bg-white px-4 py-3 text-black font-black uppercase tracking-tight focus:ring-0 focus:border-black rounded-xl shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-sm">
                            <option value="">{{ __('All Materials') }}</option>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}" {{ request('material_id') == $material->id ? 'selected' : '' }}>
                                    {{ $material->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 px-8 py-3.5 bg-black text-white font-black rounded-xl hover:bg-slate-800 transition-all uppercase tracking-widest text-xs shadow-[4px_4px_0px_0px_rgba(0,0,0,0.3)]">
                            Filter
                        </button>
                        @if(request()->hasAny(['project_id', 'material_id']) && (request('project_id') || request('material_id')))
                            <a href="{{ route('material_transactions.index') }}" class="flex-1 inline-flex items-center justify-center px-8 py-3.5 bg-white border-2 border-black text-black font-black rounded-xl hover:bg-slate-50 transition-all uppercase tracking-widest text-xs">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-2xl border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y-4 divide-black">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-8 py-6 text-left text-xs font-black text-black uppercase tracking-[0.2em] border-r-2 border-black whitespace-nowrap">Date</th>
                                <th class="px-8 py-6 text-left text-xs font-black text-black uppercase tracking-[0.2em] border-r-2 border-black whitespace-nowrap">Allocation</th>
                                <th class="px-8 py-6 text-left text-xs font-black text-black uppercase tracking-[0.2em] border-r-2 border-black whitespace-nowrap">Resource</th>
                                <th class="px-8 py-6 text-left text-xs font-black text-black uppercase tracking-[0.2em] border-r-2 border-black whitespace-nowrap">Type</th>
                                <th class="px-8 py-6 text-left text-xs font-black text-black uppercase tracking-[0.2em] border-r-2 border-black whitespace-nowrap">Qty</th>
                                <th class="px-8 py-6 text-left text-xs font-black text-black uppercase tracking-[0.2em] border-r-2 border-black whitespace-nowrap">Source</th>
                                <th class="px-8 py-6 text-center text-xs font-black text-black uppercase tracking-[0.2em] border-r-2 border-black whitespace-nowrap">Doc</th>
                                <th class="px-8 py-6 text-right text-xs font-black text-black uppercase tracking-[0.2em] whitespace-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-2 divide-slate-200 bg-white">
                            @forelse ($transactions as $transaction)
                                <tr class="hover:bg-slate-50 transition-colors group">
                                    <td class="px-8 py-8 border-r-2 border-slate-100 whitespace-nowrap font-black text-slate-500 uppercase tracking-tighter">
                                        {{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}
                                    </td>
                                    <td class="px-8 py-8 border-r-2 border-slate-100">
                                        <span class="text-sm font-black text-black uppercase tracking-tight leading-tight">
                                            {{ $transaction->project->name }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-8 border-r-2 border-slate-100">
                                        <div class="flex flex-col">
                                            <span class="text-base font-black text-black uppercase tracking-tight">{{ $transaction->material->name }}</span>
                                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Unit: {{ $transaction->material->unit }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-8 border-r-2 border-slate-100">
                                        @php
                                            $typeMeta = [
                                                'purchase' => ['bg' => 'bg-emerald-400', 'text' => 'text-black', 'label' => 'PURCHASE'],
                                                'transfer_in' => ['bg' => 'bg-indigo-400', 'text' => 'text-black', 'label' => 'INWARD'],
                                                'transfer_out' => ['bg' => 'bg-amber-400', 'text' => 'text-black', 'label' => 'OUTWARD'],
                                                'consumption' => ['bg' => 'bg-red-400', 'text' => 'text-black', 'label' => 'USED'],
                                            ];
                                            $meta = $typeMeta[$transaction->type] ?? ['bg' => 'bg-slate-400', 'text' => 'text-black', 'label' => 'OTHER'];
                                        @endphp
                                        <span class="inline-flex px-3 py-1 {{ $meta['bg'] }} {{ $meta['text'] }} border-2 border-black rounded-lg text-[10px] font-black uppercase tracking-widest shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                            {{ $meta['label'] }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-8 border-r-2 border-slate-100 whitespace-nowrap">
                                        <span class="text-lg font-black text-black tracking-tighter">
                                            {{ number_format($transaction->quantity, 1) }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-8 border-r-2 border-slate-100">
                                        <span class="text-sm font-bold text-slate-600 italic">
                                            {{ $transaction->vendor->name ?? 'Internal / Misc' }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-8 border-r-2 border-slate-100 text-center">
                                        @if($transaction->bill_path)
                                            <a href="{{ Storage::url($transaction->bill_path) }}" target="_blank" class="inline-flex items-center justify-center w-10 h-10 bg-white border-2 border-black rounded-lg hover:bg-slate-900 hover:text-white transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]" title="View Document">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            </a>
                                        @else
                                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">---</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-8 text-right whitespace-nowrap">
                                        <div class="flex justify-end items-center gap-3">
                                            <a href="{{ route('material_transactions.edit', $transaction) }}" class="p-2 bg-white border-2 border-black rounded-lg hover:bg-amber-100 transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]" title="Edit Log">
                                                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('material_transactions.destroy', $transaction) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirm removal of this transaction record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-white border-2 border-black rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]" title="Delete Log">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center gap-6">
                                            <div class="w-24 h-24 bg-slate-50 border-4 border-dashed border-slate-300 rounded-full flex items-center justify-center text-slate-300">
                                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                            </div>
                                            <div class="space-y-2">
                                                <p class="text-2xl font-black text-black uppercase tracking-tight">No Transactions Logged</p>
                                                <p class="text-slate-500 font-bold">The material audit trail is currently empty.</p>
                                            </div>
                                            <a href="{{ route('material_transactions.create') }}" class="inline-flex items-center px-8 py-4 bg-black text-white font-black rounded-xl hover:bg-slate-800 transition-all uppercase tracking-widest text-sm">
                                                Log Movement
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($transactions->hasPages())
                    <div class="px-8 py-8 bg-slate-50 border-t-4 border-black">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
