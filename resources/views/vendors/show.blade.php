<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Vendor Intelligence') }}
                </h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-sm font-medium text-slate-500">{{ __('Profile for:') }}</span>
                    <span class="text-sm font-bold text-indigo-600 bg-indigo-50 px-2.5 py-0.5 rounded-lg border border-indigo-100">{{ $vendor->name }}</span>
                </div>
            </div>
            <div class="flex flex-wrap gap-3 w-full md:w-auto">
                <a href="{{ route('vendors.index') }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition-all shadow-sm text-xs">
                    Back to Registry
                </a>
                <a href="{{ route('vendors.edit', $vendor) }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 text-xs">
                    Update Profile
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        
        <!-- Vendor Identity Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="bg-slate-900 p-8 flex flex-col items-center justify-center text-center">
                    <div class="w-24 h-24 bg-indigo-600 text-white rounded-2xl flex items-center justify-center text-4xl font-bold uppercase shadow-lg shadow-indigo-500/20 mb-4 border-2 border-slate-800">
                        {{ substr($vendor->name, 0, 1) }}
                    </div>
                    <h3 class="text-xl font-bold text-white tracking-tight leading-tight">{{ $vendor->name }}</h3>
                    <span class="mt-3 inline-flex px-3 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-full text-[10px] font-bold uppercase tracking-widest">Verified Supplier</span>
                </div>
                
                <div class="md:col-span-2 p-8">
                    <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6 pb-2 border-b border-slate-50">Communication & Logistics</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Primary Liaison</dt>
                                <dd class="text-base font-bold text-slate-900">{{ $vendor->contact_person ?? 'Not Specified' }}</dd>
                            </div>
                            <div>
                                <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Direct Dial</dt>
                                <dd class="text-base font-bold text-indigo-600">{{ $vendor->phone }}</dd>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Digital Correspondence</dt>
                                <dd class="text-base font-bold text-slate-900 lowercase truncate">{{ $vendor->email ?? 'Not Specified' }}</dd>
                            </div>
                            <div>
                                <dt class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Operational Base</dt>
                                <dd class="text-sm font-medium text-slate-600 leading-relaxed">{{ $vendor->address ?? 'No physical address on file' }}</dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Grids -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-6 pb-3 border-b border-slate-50 flex items-center gap-2">
                    <span class="w-6 h-6 bg-slate-100 text-slate-900 rounded flex items-center justify-center text-[10px] font-bold">01</span>
                    Material Supply history
                </h3>
                <div class="py-12 text-center">
                    <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">Inventory log integration pending</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-6 pb-3 border-b border-slate-50 flex items-center gap-2">
                    <span class="w-6 h-6 bg-slate-100 text-slate-900 rounded flex items-center justify-center text-[10px] font-bold">02</span>
                    Financial Transactions
                </h3>
                <div class="py-12 text-center">
                    <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">Payment ledger integration pending</p>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="pt-8 flex justify-center">
            <form action="{{ route('vendors.destroy', $vendor) }}" method="POST" onsubmit="return confirm('Permanent deletion of vendor entity. Proceed?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 bg-white border border-rose-200 text-rose-600 font-bold rounded-xl hover:bg-rose-50 transition-all uppercase tracking-widest text-[10px]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Terminate Partnership
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
