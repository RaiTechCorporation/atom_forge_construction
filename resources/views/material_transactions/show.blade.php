<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Transaction Audit') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Detailed verification of material movement and resource allocation.') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('material_transactions.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-slate-50 transition-all shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    {{ __('Back to Log') }}
                </a>
                <a href="{{ route('material_transactions.edit', $materialTransaction) }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    {{ __('Edit Log') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-slate-900 px-8 py-4 flex items-center justify-between">
                <span class="text-white text-[10px] font-bold uppercase tracking-[0.2em]">{{ __('Transaction Voucher') }}</span>
                <span class="text-indigo-400 text-[10px] font-bold uppercase tracking-widest">ID: #{{ str_pad($materialTransaction->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            
            <div class="p-8 space-y-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Primary Info -->
                    <div class="space-y-6">
                        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest pb-2 border-b border-slate-100">{{ __('Resource Info') }}</h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">{{ __('Execution Date') }}</dt>
                                <dd class="text-sm font-bold text-slate-900">{{ \Carbon\Carbon::parse($materialTransaction->date)->format('F d, Y') }}</dd>
                            </div>
                            <div>
                                <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">{{ __('Active Project') }}</dt>
                                <dd class="text-sm font-bold text-slate-900 uppercase tracking-tight">{{ $materialTransaction->project->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">{{ __('Material Resource') }}</dt>
                                <dd class="text-sm font-bold text-indigo-600 uppercase tracking-tight">{{ $materialTransaction->material->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">{{ __('Movement Type') }}</dt>
                                <dd class="mt-2">
                                    @php
                                        $typeMeta = [
                                            'purchase' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'label' => 'PURCHASE'],
                                            'transfer_in' => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-700', 'label' => 'SITE INWARD'],
                                            'transfer_out' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700', 'label' => 'SITE OUTWARD'],
                                            'consumption' => ['bg' => 'bg-rose-100', 'text' => 'text-rose-700', 'label' => 'CONSUMPTION'],
                                        ];
                                        $meta = $typeMeta[$materialTransaction->type] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-700', 'label' => 'OTHER'];
                                    @endphp
                                    <span class="inline-flex px-3 py-1 {{ $meta['bg'] }} {{ $meta['text'] }} text-[10px] font-bold uppercase tracking-wider rounded-lg">
                                        {{ $meta['label'] }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Quantitative Info -->
                    <div class="space-y-6">
                        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest pb-2 border-b border-slate-100">{{ __('Audit Metrics') }}</h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">{{ __('Quantity Handled') }}</dt>
                                <dd class="text-2xl font-bold text-slate-900 tracking-tight">{{ number_format($materialTransaction->quantity, 2) }} <span class="text-xs uppercase tracking-widest text-slate-400 font-medium">{{ $materialTransaction->material->unit }}</span></dd>
                            </div>
                            <div>
                                <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">{{ __('Valuation Rate') }}</dt>
                                <dd class="text-lg font-bold text-slate-900 tracking-tight">{{ $materialTransaction->rate ? '₹' . number_format($materialTransaction->rate, 2) : '—' }} <span class="text-[10px] text-slate-400 font-medium uppercase tracking-widest">per unit</span></dd>
                            </div>
                            <div>
                                <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">{{ __('Supply Source / Vendor') }}</dt>
                                <dd class="text-sm font-bold text-slate-700 uppercase italic">{{ $materialTransaction->vendor->name ?? __('Internal Distribution') }}</dd>
                            </div>
                            <div>
                                <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">{{ __('Verification Document') }}</dt>
                                <dd>
                                    @if($materialTransaction->bill_path)
                                        <a href="{{ asset('storage/' . $materialTransaction->bill_path) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-xl text-[10px] font-bold uppercase tracking-widest hover:bg-slate-800 transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            {{ __('View Source Bill') }}
                                        </a>
                                    @else
                                        <div class="px-4 py-3 border border-dashed border-slate-200 rounded-xl text-[10px] font-bold text-slate-300 uppercase tracking-widest text-center">
                                            {{ __('No Digital Proof Uploaded') }}
                                        </div>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-6">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">{{ __('Authorized Entry System Audit') }}</p>
                    <form action="{{ route('material_transactions.destroy', $materialTransaction) }}" method="POST" onsubmit="return confirm('{{ __('CRITICAL: Permanent deletion of this transaction log cannot be undone. Proceed?') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 text-rose-600 font-bold uppercase tracking-widest text-[10px] hover:bg-rose-50 px-4 py-2 rounded-xl transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            {{ __('Void Transaction Record') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
