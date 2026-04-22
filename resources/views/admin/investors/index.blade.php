<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tight">
                {{ __('Investor Registry') }}
            </h2>
            <a href="{{ route('investors.create') }}" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-black rounded-2xl transition-all shadow-lg shadow-indigo-600/20 flex items-center gap-2 group">
                <svg class="w-4 h-4 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add New Investor
            </a>
        </div>
    </x-slot>

    <div class="py-12 space-y-10">
        <!-- Summary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-slate-400 font-black text-[10px] uppercase tracking-[0.2em] mb-2">Total Investors</p>
                <h3 class="text-3xl font-black text-slate-900">{{ $investors->total() }}</h3>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-slate-400 font-black text-[10px] uppercase tracking-[0.2em] mb-2">Funds Raised</p>
                <h3 class="text-3xl font-black text-emerald-600">₹{{ number_format(\App\Models\Investment::where('status', 'approved')->sum('investment_amount') / 1000000, 1) }}M</h3>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-slate-400 font-black text-[10px] uppercase tracking-[0.2em] mb-2">Pending Returns</p>
                <h3 class="text-3xl font-black text-amber-600">₹{{ number_format(\App\Models\Payout::where('status', 'pending')->sum('amount_paid') / 1000, 1) }}K</h3>
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-slate-400 font-black text-[10px] uppercase tracking-[0.2em] mb-2">Active Stakes</p>
                <h3 class="text-3xl font-black text-indigo-600">{{ \App\Models\Investment::where('status', 'approved')->count() }}</h3>
            </div>
        </div>

        <!-- Investor Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($investors as $investor)
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden group">
                <div class="p-10">
                    <div class="flex items-start justify-between mb-8">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 font-black text-xl border border-slate-100 group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-all duration-500">
                                {{ substr($investor->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-black text-slate-900 text-lg group-hover:text-indigo-600 transition-colors">{{ $investor->name }}</h4>
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">{{ $investor->status }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 py-6 border-y border-slate-50 mb-8">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Invested</p>
                            <p class="text-base font-black text-slate-900">₹{{ number_format($investor->total_invested ?? 0, 0) }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Portfolio</p>
                            <p class="text-base font-black text-slate-900">{{ $investor->investments_count }} Assets</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <a href="tel:{{ $investor->phone }}" class="p-2.5 text-slate-400 hover:text-indigo-600 transition-all rounded-xl hover:bg-indigo-50 border border-transparent hover:border-indigo-100" title="Call Investor">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </a>
                            <a href="{{ route('investors.edit', $investor->id) }}" class="p-2.5 text-slate-400 hover:text-amber-600 transition-all rounded-xl hover:bg-amber-50 border border-transparent hover:border-amber-100" title="Edit Profile">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                        </div>
                        <a href="{{ route('investors.show', $investor->id) }}" class="px-5 py-2.5 bg-slate-900 text-white text-[10px] font-black rounded-xl hover:bg-indigo-600 transition-all uppercase tracking-widest flex items-center gap-2">
                            View Profile
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $investors->links() }}
        </div>
    </div>
</x-app-layout>
