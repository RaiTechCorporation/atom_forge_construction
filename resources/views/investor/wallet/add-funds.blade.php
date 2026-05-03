<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Wallet Management') }}
            </h2>
            <div class="px-4 py-2 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center gap-3">
                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest leading-none">Current Balance</span>
                <span class="text-xl font-black text-emerald-700">₹{{ number_format($investor->balance, 2) }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 space-y-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Add Funds Form -->
            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm h-fit">
                    <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Add Funds to Wallet
                    </h3>
                    <form action="{{ route('investor.add-funds') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Amount (₹)</label>
                            <input type="number" name="amount" step="0.01" min="1" required class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-600/5 font-black text-lg text-slate-900 placeholder-slate-300" placeholder="0.00">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Payment Method</label>
                            <select name="payment_method" required class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-600/5 font-bold text-slate-700 appearance-none">
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="cheque">Cheque</option>
                                <option value="cash">Cash</option>
                                <option value="upi">UPI</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Reference / Chq Number</label>
                            <input type="text" name="reference_number" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-600/5 font-bold text-slate-700" placeholder="Optional">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Receipt/Proof (Image)</label>
                            <div class="relative group">
                                <input type="file" name="receipt_proof" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="w-full px-5 py-8 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center gap-3 group-hover:border-indigo-400 transition-colors bg-slate-50/50">
                                    <svg class="w-8 h-8 text-slate-300 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-xs font-bold text-slate-400 group-hover:text-indigo-600">Click to upload receipt</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-full py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-xl shadow-indigo-600/20 transition-all transform hover:-translate-y-1 uppercase tracking-widest text-xs">
                            Submit Fund Request
                        </button>
                    </form>
                </div>
            </div>

            <!-- History Table -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-slate-50">
                        <h3 class="text-xl font-bold text-slate-900 tracking-tight">Fund Request History</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Method</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Amount</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Proof</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($fundRequests as $request)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="text-sm font-bold text-slate-900">{{ $request->created_at->format('M d, Y') }}</div>
                                        <div class="text-[10px] font-bold text-slate-400 uppercase">{{ $request->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="text-xs font-black text-slate-700 uppercase tracking-wider">{{ str_replace('_', ' ', $request->payment_method) }}</div>
                                        @if($request->reference_number)
                                            <div class="text-[10px] font-bold text-slate-400">{{ $request->reference_number }}</div>
                                        @endif
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="text-sm font-black text-slate-900">₹{{ number_format($request->amount, 2) }}</div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="px-3 py-1.5 {{ $request->status === 'approved' ? 'bg-emerald-50 text-emerald-600' : ($request->status === 'rejected' ? 'bg-red-50 text-red-600' : 'bg-amber-50 text-amber-600') }} text-[10px] font-black rounded-lg uppercase tracking-wider border {{ $request->status === 'approved' ? 'border-emerald-100' : ($request->status === 'rejected' ? 'border-red-100' : 'border-amber-100') }}">
                                            {{ $request->status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        @if($request->receipt_proof)
                                            <a href="{{ asset('storage/' . $request->receipt_proof) }}" target="_blank" class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 transition-all border border-slate-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">No fund requests found</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($fundRequests->hasPages())
                        <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                            {{ $fundRequests->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
