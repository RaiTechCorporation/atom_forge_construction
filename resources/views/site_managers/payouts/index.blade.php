<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Supervisor Payment Dashboard') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Manage salary distributions, attendance summary, and payouts.') }}
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('site-managers.export-payroll.pdf', ['month' => $month]) }}" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-rose-600 text-white font-bold rounded-xl hover:bg-rose-700 transition-all shadow-lg shadow-rose-600/20 text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    PDF
                </a>
                <a href="{{ route('site-managers.export-payroll.excel', ['month' => $month]) }}" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20 text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Excel
                </a>
                <form action="{{ route('site-managers.generate-payroll') }}" method="POST">
                    @csrf
                    <input type="hidden" name="month" value="{{ $month }}">
                    <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Generate Payroll
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-xl flex items-center gap-3 animate-fade-in" role="alert">
                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-semibold text-emerald-800 text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Salary Due</p>
                <p class="text-xl font-black text-slate-900 italic">₹{{ number_format($stats['total_salary_due'], 2) }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Paid This Month</p>
                <p class="text-xl font-black text-emerald-600 italic">₹{{ number_format($stats['paid_this_month'], 2) }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Pending Payments</p>
                <p class="text-xl font-black text-rose-600 italic">{{ $stats['pending_payments'] }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Month</p>
                <p class="text-xl font-black text-indigo-600 italic">{{ \Carbon\Carbon::parse($month)->format('M Y') }}</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <form action="{{ route('site-managers.payouts.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Select Month</label>
                    <input type="month" name="month" value="{{ $month }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Project</label>
                    <select name="project_id" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="">All Projects</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $projectId == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-slate-900 text-white font-bold py-2.5 rounded-xl hover:bg-slate-800 transition-all text-sm">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Supervisor</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Base Salary</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Deductions</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Net Payable</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Paid</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Status</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($payouts as $payout)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-bold uppercase text-base shrink-0">
                                            {{ substr($payout->siteManager->name, 0, 1) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-slate-900 tracking-tight">{{ $payout->siteManager->name }}</span>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $payout->siteManager->project->name ?? 'No Project' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-sm font-bold text-slate-700 italic">
                                    ₹{{ number_format($payout->base_salary, 2) }}
                                </td>
                                <td class="px-6 py-6">
                                    <span class="text-sm font-black text-rose-500 italic">
                                        ₹{{ number_format($payout->absence_deduction + $payout->late_arrival_deduction + $payout->penalty_deduction + $payout->advance_salary_recovery, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="text-sm font-black text-indigo-600 italic">
                                        ₹{{ number_format($payout->net_amount, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="text-sm font-black text-emerald-600 italic">
                                        ₹{{ number_format($payout->paid_amount, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-6">
                                    @php
                                        $statusClasses = [
                                            'Paid' => 'bg-emerald-50 text-emerald-600',
                                            'Pending' => 'bg-amber-50 text-amber-600',
                                            'Partial Paid' => 'bg-blue-50 text-blue-600',
                                            'Hold' => 'bg-rose-50 text-rose-600',
                                        ];
                                    @endphp
                                    <span class="inline-flex px-2.5 py-1 text-[9px] font-black uppercase tracking-widest rounded-lg {{ $statusClasses[$payout->status] ?? 'bg-slate-50 text-slate-600' }}">
                                        {{ $payout->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <div class="flex justify-center gap-2">
                                        <button onclick="openPayModal({{ json_encode($payout) }})" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Update Payment">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </button>
                                        <a href="{{ route('site-managers.download-payslip', $payout) }}" target="_blank" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="View Payslip">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <p class="text-base font-bold text-slate-900">No Management Payouts Found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($payouts->hasPages())
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                    {{ $payouts->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="payModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden z-[100] overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden animate-slide-up">
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h3 class="text-lg font-black text-slate-900 italic uppercase tracking-tight">Update Payment</h3>
                        <p class="text-[10px] font-bold text-slate-500 mt-1 uppercase tracking-widest" id="modalManagerName"></p>
                    </div>
                    <button onclick="closePayModal()" class="text-slate-400 hover:text-slate-600 transition-colors p-2 hover:bg-slate-100 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <form id="payForm" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-indigo-50 p-3 rounded-xl border border-indigo-100">
                            <p class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest mb-1">Net Payable</p>
                            <p class="text-base font-black text-indigo-600 italic" id="modalNetPayable"></p>
                        </div>
                        <div class="bg-emerald-50 p-3 rounded-xl border border-emerald-100">
                            <p class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest mb-1">Paid Already</p>
                            <p class="text-base font-black text-emerald-600 italic" id="modalPaidAlready"></p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Payment Status</label>
                            <select name="status" id="modalStatus" onchange="togglePaidAmount()" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                <option value="Pending">Pending</option>
                                <option value="Paid">Paid (Full)</option>
                                <option value="Partial Paid">Partial Paid</option>
                                <option value="Hold">Hold</option>
                            </select>
                        </div>

                        <div id="paidAmountContainer" class="hidden">
                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Amount to Pay</label>
                            <input type="number" step="0.01" name="paid_amount" id="modalPaidAmount" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Method</label>
                                <select name="payment_method" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                    <option value="Cash">Cash</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="UPI">UPI</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Trans. ID</label>
                                <input type="text" name="transaction_id" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="Optional">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Remarks</label>
                            <textarea name="remarks" rows="2" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="Payment details..."></textarea>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-slate-900 text-white font-black py-3 rounded-xl hover:bg-slate-800 transition-all shadow-xl shadow-slate-900/20 uppercase tracking-widest text-xs">
                            Update Payment Details
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openPayModal(payout) {
            document.getElementById('modalManagerName').innerText = payout.site_manager.name;
            document.getElementById('modalNetPayable').innerText = '₹' + parseFloat(payout.net_amount).toLocaleString();
            document.getElementById('modalPaidAlready').innerText = '₹' + parseFloat(payout.paid_amount).toLocaleString();
            document.getElementById('modalStatus').value = payout.status;
            document.getElementById('modalPaidAmount').value = payout.paid_amount;
            
            document.getElementById('payForm').action = `/site-managers/payouts/${payout.id}/status`;
            
            togglePaidAmount();
            document.getElementById('payModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePayModal() {
            document.getElementById('payModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function togglePaidAmount() {
            const status = document.getElementById('modalStatus').value;
            const container = document.getElementById('paidAmountContainer');
            if (status === 'Partial Paid') {
                container.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
            }
        }

        // Close on escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closePayModal();
        });
    </script>
</x-app-layout>
