<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Investor Dashboard') }}
            </h2>
            <div class="flex items-center gap-2">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-lg transition-colors border border-slate-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                        Back to Admin
                    </a>
                @endif
                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-xs font-bold rounded-full uppercase tracking-wider border border-emerald-100">
                    {{ $investor->status }} Profile
                </span>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm relative group" x-data="{ open: false }">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <button @click="open = !open" class="p-2 hover:bg-slate-50 rounded-lg transition-colors text-slate-400 hover:text-indigo-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                </div>
                <p class="text-slate-500 font-bold text-[10px] uppercase tracking-widest mb-1">Wallet Balance</p>
                <h3 class="text-xl font-black text-indigo-600">₹{{ number_format($investor->balance, 2) }}</h3>

                <!-- Transaction History Dropdown -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="absolute left-0 right-0 top-full mt-2 bg-white rounded-2xl border border-slate-100 shadow-xl z-[80] overflow-hidden min-w-[320px]">
                    <div class="p-3 border-b border-slate-50 bg-slate-50/50">
                        <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Recent Activity</h4>
                    </div>
                    <div class="max-h-[300px] overflow-y-auto">
                        @forelse($transactions as $transaction)
                        <div class="p-3 border-b border-slate-50 hover:bg-slate-50 transition-colors">
                            <div class="flex justify-between items-start mb-1">
                                <span class="text-[9px] font-black uppercase tracking-wider {{ $transaction->type === 'credit' ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $transaction->type }}
                                </span>
                                <span class="text-[9px] font-bold text-slate-400">
                                    {{ \Carbon\Carbon::parse($transaction->date)->format('M d, Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-[11px] font-bold text-slate-700 truncate mr-2">{{ $transaction->description }}</p>
                                <p class="text-[11px] font-black {{ $transaction->type === 'credit' ? 'text-emerald-600' : 'text-slate-900' }}">
                                    {{ $transaction->type === 'credit' ? '+' : '-' }}₹{{ number_format($transaction->amount, 2) }}
                                </p>
                            </div>
                        </div>
                        @empty
                        <div class="p-6 text-center">
                            <p class="text-[10px] font-bold text-slate-400">No recent transactions</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-slate-500 font-bold text-[10px] uppercase tracking-widest mb-1">Total Invested</p>
                <h3 class="text-xl font-black text-slate-900">₹{{ number_format($stats['total_invested'], 2) }}</h3>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <p class="text-slate-500 font-bold text-[10px] uppercase tracking-widest mb-1">Active Projects</p>
                <h3 class="text-xl font-black text-slate-900">{{ $stats['project_count'] }}</h3>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
                <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <p class="text-slate-500 font-bold text-[10px] uppercase tracking-widest mb-1">Total Payouts</p>
                <h3 class="text-xl font-black text-slate-900">₹{{ number_format($stats['total_payouts'], 2) }}</h3>
            </div>
        </div>

        <!-- Available for Funding -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-slate-900 tracking-tight">Available Projects for Funding</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Project Name</th>
                                <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Budget</th>
                                <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($availableProjects as $project)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="font-bold text-slate-900">{{ $project->name }}</div>
                                    <div class="text-xs text-slate-500 font-medium">{{ $project->location }}</div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="text-sm font-black text-slate-900">₹{{ number_format($project->total_budget, 2) }}</div>
                                </td>
                                <td class="px-8 py-5">
                                    <a href="{{ route('investor.projects.details', $project->id) }}" class="text-indigo-600 hover:text-indigo-800 font-bold text-xs uppercase tracking-wider">Invest Now</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-8 py-12 text-center text-slate-500 font-medium">
                                    No new projects currently seeking funding.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add Funds Form -->
            <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm h-fit">
                <h3 class="text-xl font-bold text-slate-900 mb-6">Add Funds to Wallet</h3>
                <form action="{{ route('investor.add-funds') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Amount (₹)</label>
                        <input type="number" name="amount" step="0.01" min="1" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 font-bold text-slate-900" placeholder="Enter amount">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Payment Method</label>
                        <select name="payment_method" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 font-bold text-slate-900">
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cheque">Cheque</option>
                            <option value="cash">Cash</option>
                            <option value="upi">UPI</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Reference / Chq Number</label>
                        <input type="text" name="reference_number" class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 font-bold text-slate-900" placeholder="Optional">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Receipt/Proof (Image)</label>
                        <input type="file" name="receipt_proof" accept="image/*" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                    <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-0.5 uppercase tracking-widest text-xs">
                        Submit Fund Request
                    </button>
                </form>
            </div>
        </div>

        <!-- Fund Requests Status -->
        @php
            $fundRequests = $investor->fundRequests()->latest()->take(5)->get();
        @endphp
        @if($fundRequests->count() > 0)
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50">
                <h3 class="text-xl font-bold text-slate-900 tracking-tight">Recent Fund Requests</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Date</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Method</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Amount</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($fundRequests as $request)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5 text-sm font-bold text-slate-700">{{ $request->created_at->format('M d, Y') }}</td>
                            <td class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-wider">{{ str_replace('_', ' ', $request->payment_method) }}</td>
                            <td class="px-8 py-5 text-right font-black text-slate-900">₹{{ number_format($request->amount, 2) }}</td>
                            <td class="px-8 py-5">
                                <span class="px-2.5 py-1 {{ $request->status === 'approved' ? 'bg-emerald-50 text-emerald-600' : ($request->status === 'rejected' ? 'bg-red-50 text-red-600' : 'bg-amber-50 text-amber-600') }} text-[10px] font-black rounded-lg uppercase tracking-wider">
                                    {{ $request->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Investment History -->
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-xl font-bold text-slate-900 tracking-tight">Investment Portfolio</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Project Name</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Date</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Amount</th>
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
                            <td class="px-8 py-5">
                                <div class="text-sm text-slate-600 font-bold">{{ \Carbon\Carbon::parse($investment->investment_date)->format('M d, Y') }}</div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="text-sm font-black text-slate-900">₹{{ number_format($investment->investment_amount, 2) }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-2.5 py-1 {{ $investment->status === 'approved' ? 'bg-emerald-50 text-emerald-600' : ($investment->status === 'rejected' ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600') }} text-[10px] font-black rounded-lg uppercase tracking-wider">
                                    {{ $investment->status }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <a href="{{ route('investor.projects.details', $investment->project_id) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase tracking-wider">View Details</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center text-slate-500 font-medium">
                                No investments found in your portfolio.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
