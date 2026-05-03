<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-slate-100 print:shadow-none print:border-none">
            <!-- Header -->
            <div class="bg-slate-900 px-10 py-12 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                    <div>
                        <h1 class="text-3xl font-black italic tracking-tighter uppercase">Payslip</h1>
                        <p class="text-indigo-400 font-bold uppercase tracking-widest text-xs mt-1">{{ \Carbon\Carbon::parse($payout->month)->format('F Y') }}</p>
                    </div>
                    <div class="text-left md:text-right">
                        <h2 class="text-xl font-bold italic tracking-tight uppercase">Atom Forge Construction</h2>
                        <p class="text-slate-400 text-xs font-medium mt-1">Industrial Estate, Site No. 42</p>
                        <p class="text-slate-400 text-xs font-medium">Bangalore, Karnataka - 560001</p>
                    </div>
                </div>
            </div>

            <!-- Employee Info -->
            <div class="px-10 py-8 border-b border-slate-100 bg-slate-50/50">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Supervisor Name</p>
                        <p class="text-base font-black text-slate-900 italic uppercase">{{ $siteManager->name }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Employee ID</p>
                        <p class="text-base font-black text-slate-900 italic uppercase">{{ $siteManager->manager_unique_id }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Assigned Site</p>
                        <p class="text-base font-black text-slate-900 italic uppercase">{{ $siteManager->project->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Attendance & Salary Breakdown -->
            <div class="px-10 py-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Earnings -->
                    <div class="space-y-6">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
                            Earnings Breakdown
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center text-sm">
                                <span class="font-bold text-slate-500 uppercase tracking-tight">Base Salary</span>
                                <span class="font-black text-slate-900 italic">₹{{ number_format($payout->base_salary, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="font-bold text-slate-500 uppercase tracking-tight">Bonus</span>
                                <span class="font-black text-emerald-600 italic">₹{{ number_format($payout->bonus, 2) }}</span>
                            </div>
                            <div class="pt-4 border-t border-slate-100 flex justify-between items-center">
                                <span class="text-xs font-black text-slate-900 uppercase tracking-widest">Gross Total</span>
                                <span class="text-lg font-black text-slate-900 italic">₹{{ number_format($payout->base_salary + $payout->bonus, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Deductions -->
                    <div class="space-y-6">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-rose-500 rounded-full"></span>
                            Deductions
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center text-sm">
                                <span class="font-bold text-slate-500 uppercase tracking-tight">Absence ({{ $attendanceSummary['total_absent'] }} days)</span>
                                <span class="font-black text-rose-500 italic">₹{{ number_format($payout->absence_deduction, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="font-bold text-slate-500 uppercase tracking-tight">Late Arrival</span>
                                <span class="font-black text-rose-500 italic">₹{{ number_format($payout->late_arrival_deduction, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="font-bold text-slate-500 uppercase tracking-tight">Advance Recovery</span>
                                <span class="font-black text-rose-500 italic">₹{{ number_format($payout->advance_salary_recovery, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="font-bold text-slate-500 uppercase tracking-tight">Penalty</span>
                                <span class="font-black text-rose-500 italic">₹{{ number_format($payout->penalty_deduction, 2) }}</span>
                            </div>
                            <div class="pt-4 border-t border-slate-100 flex justify-between items-center">
                                <span class="text-xs font-black text-slate-900 uppercase tracking-widest">Total Deductions</span>
                                <span class="text-lg font-black text-rose-500 italic">₹{{ number_format($payout->absence_deduction + $payout->late_arrival_deduction + $payout->advance_salary_recovery + $payout->penalty_deduction, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Summary -->
            <div class="mx-10 mb-10 p-6 bg-slate-900 rounded-2xl text-white">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-6 text-center">
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Working Days</p>
                        <p class="text-xl font-black italic">{{ $attendanceSummary['total_working_days'] }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Present</p>
                        <p class="text-xl font-black italic">{{ $attendanceSummary['total_present'] }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Absent</p>
                        <p class="text-xl font-black italic">{{ $attendanceSummary['total_absent'] }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Half Day</p>
                        <p class="text-xl font-black italic">{{ $attendanceSummary['total_half_day'] }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Attendance %</p>
                        <p class="text-xl font-black italic">{{ $attendanceSummary['attendance_percentage'] }}%</p>
                    </div>
                </div>
            </div>

            <!-- Net Payable Footer -->
            <div class="px-10 py-10 bg-indigo-600 text-white flex flex-col md:flex-row justify-between items-center gap-8">
                <div>
                    <p class="text-[10px] font-bold text-indigo-200 uppercase tracking-widest mb-1">Net Payable Amount</p>
                    <p class="text-4xl font-black italic tracking-tighter uppercase">₹{{ number_format($payout->net_amount, 2) }}</p>
                    <p class="text-[10px] font-medium text-indigo-200 mt-2 uppercase tracking-widest">Payment Status: {{ $payout->status }}</p>
                </div>
                <div class="flex gap-4 print:hidden">
                    <button onclick="window.print()" class="px-8 py-3 bg-white text-indigo-600 font-black rounded-xl hover:bg-indigo-50 transition-all shadow-xl uppercase tracking-widest text-xs">
                        Print Payslip
                    </button>
                </div>
            </div>
            
            <div class="px-10 py-6 bg-slate-50 text-center border-t border-slate-100">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">This is a computer generated document and does not require a signature.</p>
            </div>
        </div>
        
        <div class="mt-8 text-center print:hidden">
            <a href="{{ route('site-managers.payouts.index') }}" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
