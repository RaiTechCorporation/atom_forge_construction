<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 py-2">
            <div>
                <h2 class="font-black text-3xl text-black leading-tight tracking-tighter uppercase">
                    {{ __('Transaction Audit') }}
                </h2>
                <p class="mt-1 text-base font-bold text-slate-800 uppercase tracking-widest text-[11px]">
                    {{ __('Detailed verification of material movement') }}
                </p>
            </div>
            <div class="flex gap-4 w-full md:w-auto">
                <a href="{{ route('material_transactions.index') }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-6 py-3 bg-white border-4 border-black text-black font-black rounded-xl hover:bg-slate-50 transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-xs uppercase tracking-widest">
                    Back to Log
                </a>
                <a href="{{ route('material_transactions.edit', $materialTransaction) }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-6 py-3 bg-yellow-400 border-4 border-black text-black font-black rounded-xl hover:bg-yellow-500 transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-xs uppercase tracking-widest">
                    Edit Log
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border-4 border-black shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                <div class="bg-black p-6 flex items-center justify-between">
                    <span class="text-white font-black uppercase tracking-[0.3em] text-xs">Transaction Voucher</span>
                    <span class="text-yellow-400 font-black uppercase tracking-widest text-xs">ID: #{{ $materialTransaction->id }}</span>
                </div>
                
                <div class="p-10 space-y-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Primary Info -->
                        <div class="space-y-8">
                            <h3 class="text-lg font-black text-black uppercase tracking-tight pb-2 border-b-4 border-slate-100">Resource Info</h3>
                            <dl class="space-y-6">
                                <div>
                                    <dt class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Execution Date</dt>
                                    <dd class="text-lg font-black text-black uppercase">{{ \Carbon\Carbon::parse($materialTransaction->date)->format('d F Y') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Active Project</dt>
                                    <dd class="text-lg font-black text-black uppercase">{{ $materialTransaction->project->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Material Resource</dt>
                                    <dd class="text-lg font-black text-indigo-700 uppercase">{{ $materialTransaction->material->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Movement Type</dt>
                                    <dd class="mt-2">
                                        @php
                                            $typeMeta = [
                                                'purchase' => ['bg' => 'bg-emerald-400', 'label' => 'EXTERNAL PURCHASE'],
                                                'transfer_in' => ['bg' => 'bg-indigo-400', 'label' => 'SITE INWARD'],
                                                'transfer_out' => ['bg' => 'bg-amber-400', 'label' => 'SITE OUTWARD'],
                                                'consumption' => ['bg' => 'bg-red-400', 'label' => 'PROJECT CONSUMPTION'],
                                            ];
                                            $meta = $typeMeta[$materialTransaction->type] ?? ['bg' => 'bg-slate-400', 'label' => 'OTHER'];
                                        @endphp
                                        <span class="inline-flex px-4 py-2 {{ $meta['bg'] }} border-2 border-black rounded-xl text-xs font-black uppercase tracking-widest shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                                            {{ $meta['label'] }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Quantitative Info -->
                        <div class="space-y-8">
                            <h3 class="text-lg font-black text-black uppercase tracking-tight pb-2 border-b-4 border-slate-100">Audit Metrics</h3>
                            <dl class="space-y-6">
                                <div>
                                    <dt class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Quantity Handled</dt>
                                    <dd class="text-3xl font-black text-black tracking-tighter">{{ $materialTransaction->quantity }} <span class="text-sm uppercase tracking-widest text-slate-400">{{ $materialTransaction->material->unit }}</span></dd>
                                </div>
                                <div>
                                    <dt class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Valuation Rate</dt>
                                    <dd class="text-xl font-black text-black tracking-tighter">{{ $materialTransaction->rate ? '₹' . number_format($materialTransaction->rate, 2) : '---' }} <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">per unit</span></dd>
                                </div>
                                <div>
                                    <dt class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Supply Source / Vendor</dt>
                                    <dd class="text-lg font-black text-slate-700 uppercase italic">"{{ $materialTransaction->vendor->name ?? 'Internal Distribution' }}"</dd>
                                </div>
                                <div>
                                    <dt class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Verification Document</dt>
                                    <dd>
                                        @if($materialTransaction->bill_path)
                                            <a href="{{ Storage::url($materialTransaction->bill_path) }}" target="_blank" class="inline-flex items-center gap-3 px-6 py-3 bg-black text-white rounded-xl font-black uppercase tracking-widest text-xs hover:bg-slate-800 transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,0.3)]">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                View Source Bill
                                            </a>
                                        @else
                                            <div class="px-6 py-4 border-2 border-dashed border-slate-200 rounded-xl text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] text-center">
                                                No Digital Proof Uploaded
                                            </div>
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="pt-10 border-t-4 border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-6">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Authorized Entry System Audit</p>
                        <form action="{{ route('material_transactions.destroy', $materialTransaction) }}" method="POST" onsubmit="return confirm('CRITICAL: Permanent deletion of this transaction log cannot be undone. Proceed?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 text-red-600 font-black uppercase tracking-widest text-[11px] hover:bg-red-50 px-4 py-2 rounded-lg transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Void Transaction Record
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
