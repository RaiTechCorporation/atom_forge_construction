<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ $project->name }} - Details
            </h2>
            <div class="flex items-center gap-4">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-lg transition-colors border border-slate-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                        Back to Admin
                    </a>
                @endif
                <a href="{{ route('investor.dashboard') }}" class="text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors uppercase tracking-wider">
                    &larr; Back to Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 space-y-8">
        <!-- Project Summary & ROI -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-slate-500 font-bold text-[10px] uppercase tracking-widest mb-1">Total Project Budget</p>
                <h3 class="text-xl font-black text-slate-900">₹{{ number_format($project->total_budget, 2) }}</h3>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-slate-500 font-bold text-[10px] uppercase tracking-widest mb-1">Your Investment</p>
                <h3 class="text-xl font-black text-slate-900">₹{{ $investment ? number_format($investment->investment_amount, 2) : '0.00' }}</h3>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-slate-500 font-bold text-[10px] uppercase tracking-widest mb-1">Expected Return</p>
                <h3 class="text-xl font-black text-emerald-600">{{ $investment ? $investment->expected_return . '%' : 'N/A' }}</h3>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <p class="text-slate-500 font-bold text-[10px] uppercase tracking-widest mb-1">Total Payouts Received</p>
                <h3 class="text-xl font-black text-purple-600">₹{{ number_format($totalReceived, 2) }}</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Financial Tracking -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Fund Utilization</h3>
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between text-sm font-bold mb-2">
                                <span class="text-slate-500 uppercase tracking-wider">Spend vs Budget</span>
                                <span class="text-slate-900">{{ number_format(($totalExpenses / $project->total_budget) * 100, 1) }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 h-4 rounded-full overflow-hidden">
                                <div class="bg-blue-600 h-full rounded-full" style="width: {{ ($totalExpenses / $project->total_budget) * 100 }}%"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-8 pt-4">
                            <div>
                                <p class="text-slate-500 font-bold text-xs uppercase tracking-widest mb-1">Total Expenses</p>
                                <p class="text-2xl font-black text-slate-900">₹{{ number_format($totalExpenses, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-slate-500 font-bold text-xs uppercase tracking-widest mb-1">Remaining Funds</p>
                                <p class="text-2xl font-black text-slate-900">₹{{ number_format($totalInvestedInProject - $totalExpenses, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress Updates -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Recent Site Updates</h3>
                    <div class="space-y-8">
                        @forelse($project->projectUpdates as $update)
                        <div class="relative pl-8 border-l-2 border-slate-100 pb-8 last:pb-0">
                            <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-blue-600 border-4 border-white"></div>
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-bold text-slate-900">{{ $update->date->format('M d, Y') }}</h4>
                                <span class="px-2 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-lg uppercase tracking-wider">
                                    {{ $update->progress_percent }}% Complete
                                </span>
                            </div>
                            <p class="text-slate-600 text-sm leading-relaxed mb-4">{{ $update->description }}</p>
                            @if($update->images)
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($update->images as $image)
                                <img src="{{ asset('storage/' . $image) }}" class="w-full h-24 object-cover rounded-xl border border-slate-100">
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @empty
                        <p class="text-slate-500 text-center py-8 font-medium">No updates available for this project.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Expense Ledger (Investor View) -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Fund Utilization Detail</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-slate-50">
                                    <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                                    <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Category</th>
                                    <th class="pb-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($project->expenses->sortByDesc('date')->take(10) as $expense)
                                    <tr>
                                        <td class="py-4 text-xs font-bold text-slate-500">
                                            {{ $expense->date ? \Carbon\Carbon::parse($expense->date)->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td class="py-4">
                                            <span class="text-[10px] font-black text-slate-700 uppercase tracking-wider">{{ str_replace('_', ' ', $expense->category) }}</span>
                                        </td>
                                        <td class="py-4 text-xs font-black text-slate-900 text-right">
                                            ₹{{ number_format($expense->amount, 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-8 text-center text-xs font-bold text-slate-400 uppercase tracking-widest">
                                            No recent expenditures logged.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($project->expenses->count() > 10)
                        <p class="mt-4 text-[10px] font-bold text-slate-400 uppercase text-center tracking-widest italic">
                            Showing latest 10 transactions
                        </p>
                    @endif
                </div>
            </div>

            <!-- Payouts & Documents -->
            <div class="space-y-8">
                <!-- Add Fund Section -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Add Funds</h3>
                    <form action="{{ route('investor.projects.invest', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Amount (₹)</label>
                            <input type="number" name="investment_amount" step="0.01" min="1" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 font-bold text-slate-900" placeholder="Enter amount">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Investment Date</label>
                            <input type="date" name="investment_date" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 font-bold text-slate-900" value="{{ date('Y-m-d') }}">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Payment Proof (Image)</label>
                            <input type="file" name="payment_proof" accept="image/*" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Notes</label>
                            <textarea name="notes" rows="2" class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 font-medium text-slate-900" placeholder="Optional notes"></textarea>
                        </div>
                        <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-0.5">
                            Submit Investment
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Payout History</h3>
                    <div class="space-y-4">
                        @forelse($payouts as $payout)
                        <div class="flex justify-between items-center p-4 bg-slate-50 rounded-2xl">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $payout->payment_date->format('M d, Y') }}</p>
                                <p class="font-bold text-slate-900">₹{{ number_format($payout->amount_paid, 2) }}</p>
                            </div>
                            <span class="px-2 py-1 {{ $payout->status === 'approved' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700' }} text-[10px] font-black rounded-lg uppercase tracking-wider">
                                {{ $payout->status }}
                            </span>
                        </div>
                        @empty
                        <p class="text-slate-500 text-center py-4 text-sm">No payouts recorded yet.</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Project Documents</h3>
                    <div class="space-y-4">
                        @if($investment && $investment->agreement_file)
                        <a href="{{ asset('storage/' . $investment->agreement_file) }}" target="_blank" class="flex items-center gap-4 p-4 border border-slate-100 rounded-2xl hover:bg-slate-50 transition-colors group">
                            <div class="w-10 h-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900 uppercase tracking-tight">Investment Agreement</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">PDF Document</p>
                            </div>
                        </a>
                        @else
                        <p class="text-slate-500 text-center py-4 text-sm font-medium border border-dashed border-slate-200 rounded-2xl">No agreement file uploaded.</p>
                        @endif
                    </div>
                </div>

                <!-- Payment Proofs Section -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Payment Proofs</h3>
                    <div class="space-y-4">
                        @forelse($allInvestments->whereNotNull('payment_proof') as $proof)
                        <div class="p-4 border border-slate-100 rounded-2xl">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $proof->investment_date->format('M d, Y') }}</p>
                                    <p class="font-bold text-slate-900 text-sm">₹{{ number_format($proof->investment_amount, 2) }}</p>
                                </div>
                                <span class="px-2 py-1 {{ $proof->status === 'approved' ? 'bg-emerald-50 text-emerald-600' : ($proof->status === 'rejected' ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600') }} text-[10px] font-black rounded-lg uppercase tracking-wider">
                                    {{ $proof->status }}
                                </span>
                            </div>
                            <a href="{{ asset('storage/' . $proof->payment_proof) }}" target="_blank" class="block">
                                <img src="{{ asset('storage/' . $proof->payment_proof) }}" class="w-full h-32 object-cover rounded-xl border border-slate-50 hover:opacity-90 transition-opacity">
                            </a>
                        </div>
                        @empty
                        <p class="text-slate-500 text-center py-4 text-sm font-medium border border-dashed border-slate-200 rounded-2xl">No payment proofs uploaded.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
