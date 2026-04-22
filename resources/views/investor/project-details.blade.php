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
            </div>

            <!-- Payouts & Documents -->
            <div class="space-y-8">
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
            </div>
        </div>
    </div>
</x-app-layout>
