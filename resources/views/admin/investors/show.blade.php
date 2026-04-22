<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-5">
                <a href="{{ route('investors.index') }}" class="group p-3 bg-white border border-slate-200 rounded-2xl text-slate-400 hover:text-indigo-600 hover:border-indigo-100 hover:shadow-sm transition-all">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                            {{ $investor->name }}
                        </h2>
                        <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-lg uppercase tracking-wider border border-emerald-100">
                            {{ $investor->status }}
                        </span>
                    </div>
                    <p class="text-sm text-slate-500 font-bold flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        {{ $investor->email }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('investors.edit', $investor->id) }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-700 text-xs font-black rounded-2xl hover:bg-slate-50 hover:border-slate-300 transition-all flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Profile
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 space-y-10">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="relative overflow-hidden bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm group hover:shadow-md transition-all">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-slate-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                <div class="relative">
                    <p class="text-slate-400 font-black text-[11px] uppercase tracking-[0.2em] mb-4">Total Invested</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-slate-400 font-bold text-lg">₹</span>
                        <h3 class="text-4xl font-black text-slate-900 tracking-tight">{{ number_format($investor->total_invested ?? 0, 0) }}<span class="text-lg text-slate-400">.{{ substr(number_format($investor->total_invested ?? 0, 2), -2) }}</span></h3>
                    </div>
                </div>
            </div>
            
            <div class="relative overflow-hidden bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm group hover:shadow-md transition-all">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                <div class="relative">
                    <p class="text-slate-400 font-black text-[11px] uppercase tracking-[0.2em] mb-4">Payouts Received</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-emerald-500 font-bold text-lg">₹</span>
                        <h3 class="text-4xl font-black text-emerald-600 tracking-tight">{{ number_format($investor->payouts->sum('amount_paid'), 0) }}<span class="text-lg text-emerald-400">.{{ substr(number_format($investor->payouts->sum('amount_paid'), 2), -2) }}</span></h3>
                    </div>
                </div>
            </div>

            <div class="relative overflow-hidden bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm group hover:shadow-md transition-all">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                <div class="relative">
                    <p class="text-slate-400 font-black text-[11px] uppercase tracking-[0.2em] mb-4">Active Projects</p>
                    <h3 class="text-4xl font-black text-indigo-600 tracking-tight">{{ $investor->investments_count }}</h3>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Profile Details -->
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-10">
                        <h4 class="font-black text-slate-900 uppercase tracking-tighter text-xl mb-8 flex items-center gap-3">
                            <span class="w-2 h-8 bg-indigo-600 rounded-full"></span>
                            Details
                        </h4>
                        <div class="space-y-8">
                            <div class="group">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 group-hover:text-indigo-600 transition-colors">Phone Number</p>
                                <p class="text-base font-bold text-slate-900">{{ $investor->phone }}</p>
                            </div>
                            <div class="group">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 group-hover:text-indigo-600 transition-colors">Residential Address</p>
                                <p class="text-base font-bold text-slate-900 leading-relaxed">{{ $investor->address ?? 'Not provided' }}</p>
                            </div>
                            <div class="group pt-6 border-t border-slate-50">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Member Since</p>
                                <p class="text-base font-bold text-slate-900">{{ $investor->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Investment History -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-10">
                        <div class="flex items-center justify-between mb-8">
                            <h4 class="font-black text-slate-900 uppercase tracking-tighter text-xl flex items-center gap-3">
                                <span class="w-2 h-8 bg-slate-900 rounded-full"></span>
                                Portfolio
                            </h4>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b border-slate-100">
                                        <th class="pb-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Project</th>
                                        <th class="pb-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Investment</th>
                                        <th class="pb-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">Status</th>
                                        <th class="pb-5 text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($investor->investments as $investment)
                                    <tr class="group hover:bg-slate-50/50 transition-colors">
                                        <td class="py-6">
                                            <p class="text-sm font-black text-slate-900 group-hover:text-indigo-600 transition-colors">Project #{{ $investment->id }}</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">REF: {{ $investment->transaction_id ?? 'N/A' }}</p>
                                        </td>
                                        <td class="py-6 text-right">
                                            <p class="text-sm font-black text-slate-900">₹{{ number_format($investment->investment_amount, 2) }}</p>
                                        </td>
                                        <td class="py-6 text-center">
                                            <span class="px-3 py-1 bg-white border border-slate-100 text-slate-500 text-[10px] font-black rounded-lg uppercase shadow-sm">
                                                {{ $investment->status }}
                                            </span>
                                        </td>
                                        <td class="py-6 text-right text-xs font-bold text-slate-500">
                                            {{ $investment->created_at->format('M d, Y') }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="py-12 text-center">
                                            <div class="flex flex-col items-center gap-2">
                                                <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-300">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                                </div>
                                                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Empty Portfolio</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent Payouts -->
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-10">
                        <h4 class="font-black text-slate-900 uppercase tracking-tighter text-xl mb-8 flex items-center gap-3">
                            <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                            Recent Returns
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($investor->payouts->take(6) as $payout)
                            <div class="group flex items-center justify-between p-5 bg-white border border-slate-100 rounded-3xl hover:border-emerald-100 hover:shadow-sm transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-900">₹{{ number_format($payout->amount_paid, 2) }}</p>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $payout->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-lg uppercase">
                                    {{ $payout->status }}
                                </span>
                            </div>
                            @empty
                            <div class="col-span-2 py-10 text-center">
                                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">No returns recorded yet</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
