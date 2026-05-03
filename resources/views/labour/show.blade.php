@push('styles')
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 2px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #cbd5e1;
    }
</style>
@endpush

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 py-4">
            <div class="flex items-center gap-5">
                <div class="relative">
                    <div class="w-20 h-20 rounded-2xl bg-indigo-600 overflow-hidden border-4 border-white shadow-xl">
                        @if($labour->photo_path)
                            <img src="{{ Storage::url($labour->photo_path) }}" alt="{{ $labour->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white text-2xl font-black">
                                {{ substr($labour->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 rounded-lg {{ $labour->status === 'Active' ? 'bg-emerald-500' : 'bg-rose-500' }} border-4 border-white flex items-center justify-center shadow-lg">
                        <div class="w-2 h-2 rounded-full bg-white animate-pulse"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md">
                            {{ $labour->labour_unique_id }}
                        </span>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] {{ $labour->status === 'Active' ? 'text-emerald-600 bg-emerald-50' : 'text-rose-600 bg-rose-50' }} px-2 py-0.5 rounded-md">
                            {{ $labour->status }}
                        </span>
                    </div>
                    <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tighter">
                        {{ $labour->name }}
                    </h2>
                    <p class="text-sm font-bold text-slate-500 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        {{ $labour->work_type }} • {{ $labour->skill_level }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('labour.edit', $labour) }}" 
                    class="group inline-flex items-center gap-2 px-6 py-3 bg-white border-2 border-slate-200 text-slate-700 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all duration-300 shadow-sm">
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    {{ __('Edit Profile') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- Stats Overview Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Wage Rate Card -->
                <div class="bg-white rounded-3xl p-6 border-2 border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-600 group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <span class="text-[10px] font-black text-slate-400 bg-slate-50 px-3 py-1 rounded-lg uppercase tracking-[0.2em]">{{ $labour->wage_type ?? 'Day' }}</span>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Wage Rate') }}</p>
                    <h4 class="text-2xl font-black text-slate-900 italic">₹{{ number_format($labour->wage_rate, 2) }}</h4>
                </div>

                <!-- Financial Health Card -->
                <div class="bg-slate-900 rounded-3xl p-6 shadow-xl shadow-slate-200 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                        <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">{{ __('Current Financial Standing') }}</p>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-800 pb-2">
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Total Earned') }}</span>
                                <span class="text-sm font-black text-white italic">₹{{ number_format($labour->total_earned, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between border-b border-slate-800 pb-2">
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Total Paid') }}</span>
                                <span class="text-sm font-black text-emerald-400 italic">₹{{ number_format($labour->total_paid, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between pt-1">
                                <span class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em]">{{ __('Balance Due') }}</span>
                                <span class="text-xl font-black text-white italic">₹{{ number_format($labour->balance_due, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Due Breakdown Card -->
                <div class="bg-white rounded-3xl p-6 border-2 border-indigo-100 shadow-sm hover:shadow-md transition-shadow group">
                    <p class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em] mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                        {{ __('Due Breakdown') }}
                    </p>
                    <div class="space-y-4">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ __('Day Work (Regular)') }}</span>
                                <span class="text-xs font-black text-slate-900 italic">₹{{ number_format($labour->total_regular_earned, 2) }}</span>
                            </div>
                            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                @php 
                                    $regPercent = $labour->total_earned > 0 ? ($labour->total_regular_earned / $labour->total_earned) * 100 : 0;
                                @endphp
                                <div class="bg-indigo-500 h-full transition-all duration-500" style="width: {{ $regPercent }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ __('Hour Work (Overtime)') }}</span>
                                <span class="text-xs font-black text-slate-900 italic">₹{{ number_format($labour->total_overtime_earned, 2) }}</span>
                            </div>
                            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                @php 
                                    $otPercent = $labour->total_earned > 0 ? ($labour->total_overtime_earned / $labour->total_earned) * 100 : 0;
                                @endphp
                                <div class="bg-amber-500 h-full transition-all duration-500" style="width: {{ $otPercent }}%"></div>
                            </div>
                        </div>
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-[10px] font-black text-slate-900 uppercase tracking-widest">{{ __('Day Work (Regular) + Hour Work (Overtime)') }}</span>
                            <span class="text-sm font-black text-slate-900 italic">₹{{ number_format($labour->total_regular_earned + $labour->total_overtime_earned, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-400">
                            <span class="text-[9px] font-bold uppercase tracking-widest">{{ __('Minus: Already Paid amount') }}</span>
                            <span class="text-xs font-bold italic">-₹{{ number_format($labour->total_paid, 2) }}</span>
                        </div>
                        <div class="pt-2 border-t-2 border-indigo-600 border-dashed flex items-center justify-between">
                            <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">{{ __('Total Due Amount') }}</span>
                            <span class="text-base font-black text-rose-600 italic">₹{{ number_format(($labour->total_regular_earned + $labour->total_overtime_earned) - $labour->total_paid, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Engagement Card -->
                <div class="bg-white rounded-3xl p-6 border-2 border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-[10px] font-black text-amber-600 bg-amber-50 px-3 py-1 rounded-lg uppercase tracking-[0.2em]">{{ __('Activity') }}</span>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Total Attendance') }}</p>
                    <h4 class="text-2xl font-black text-slate-900 italic">{{ $labour->attendances->where('status', 'present')->unique('date')->count() }} <span class="text-sm font-bold text-slate-400 not-italic uppercase tracking-widest ml-1">{{ __('Days') }}</span></h4>
                    <div class="mt-2 text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $labour->attendances->sum('overtime_hours') }} {{ __('Total OT Hours') }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Sidebar: Personal & Documents -->
                <div class="space-y-8">
                    <!-- Personal Info Card -->
                    <div class="bg-white rounded-3xl border-2 border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ __('Personal Identity') }}
                            </h3>
                        </div>
                        <div class="p-8 space-y-6">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Father Name') }}</label>
                                <p class="text-sm font-bold text-slate-900">{{ $labour->father_name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Phone Number') }}</label>
                                <p class="text-sm font-black text-indigo-600">+91 {{ $labour->phone }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Emergency Contact') }}</label>
                                <p class="text-sm font-bold text-slate-900">{{ $labour->emergency_contact_name ?? 'N/A' }}</p>
                                <p class="text-xs font-bold text-slate-500 mt-1">{{ $labour->emergency_contact_number ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Card -->
                    <div class="bg-white rounded-3xl border-2 border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                {{ __('Documents') }}
                            </h3>
                        </div>
                        <div class="p-8 space-y-4">
                            @if($labour->id_proof_path)
                            <a href="{{ Storage::url($labour->id_proof_path) }}" target="_blank" class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-indigo-200 hover:bg-white transition-all group">
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ __('Aadhaar Card') }}</span>
                                <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                            @endif

                            @if($labour->pan_proof_path)
                            <a href="{{ Storage::url($labour->pan_proof_path) }}" target="_blank" class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-indigo-200 hover:bg-white transition-all group">
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ __('PAN Card') }}</span>
                                <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                            @endif

                            @if(!$labour->id_proof_path && !$labour->pan_proof_path)
                                <div class="text-center py-4">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('No Documents Found') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Main Content: Professional & Payment -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Work Details Card -->
                    <div class="bg-white rounded-3xl border-2 border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ __('Employment Details') }}
                            </h3>
                        </div>
                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Joining Date') }}</label>
                                    <p class="text-sm font-black text-slate-900">{{ $labour->joining_date ? \Carbon\Carbon::parse($labour->joining_date)->format('d M, Y') : 'N/A' }}</p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Shift Type') }}</label>
                                    <p class="text-sm font-black text-slate-900">{{ $labour->shift_type ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Work Timings') }}</label>
                                    <p class="text-sm font-black text-slate-900">
                                        {{ $labour->start_time ? \Carbon\Carbon::parse($labour->start_time)->format('h:i A') : '00:00' }} - 
                                        {{ $labour->end_time ? \Carbon\Carbon::parse($labour->end_time)->format('h:i A') : '00:00' }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mt-10 pt-10 border-t border-slate-100 grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Current Location') }}</label>
                                    <p class="text-sm font-bold text-slate-900 leading-relaxed italic">
                                        {{ $labour->current_address ?? 'N/A' }}<br>
                                        {{ $labour->city }}, {{ $labour->state }} - {{ $labour->pincode }}
                                    </p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Compliance IDs') }}</label>
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between text-xs bg-slate-50 p-2 rounded-lg border border-slate-100">
                                            <span class="font-bold text-slate-400 uppercase tracking-widest">{{ __('Aadhaar') }}</span>
                                            <span class="font-black text-slate-900 tracking-widest">{{ $labour->aadhaar_number ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex items-center justify-between text-xs bg-slate-50 p-2 rounded-lg border border-slate-100">
                                            <span class="font-bold text-slate-400 uppercase tracking-widest">{{ __('PAN') }}</span>
                                            <span class="font-black text-slate-900 tracking-widest">{{ $labour->pan_number ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modern Attendance Calendar Card -->
                    <div class="bg-white rounded-[2rem] border-2 border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                        @php
                            $currentMonthObj = \Carbon\Carbon::create($selectedYear, $selectedMonth, 1);
                            $prevMonth = $currentMonthObj->copy()->subMonth();
                            $nextMonth = $currentMonthObj->copy()->addMonth();
                        @endphp

                        <div class="px-8 py-8 bg-white border-b border-slate-100">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                                <div class="flex items-center gap-6">
                                    <div class="flex items-center bg-slate-100 p-1 rounded-xl">
                                        <a href="{{ route('labour.show', [$labour, 'month' => $prevMonth->month, 'year' => $prevMonth->year, 'start_date' => $startDate, 'end_date' => $endDate]) }}" 
                                           class="p-2 hover:bg-white hover:shadow-sm rounded-lg transition-all text-slate-600 hover:text-indigo-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                                        </a>
                                        <div class="px-3 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                            {{ __('Navigation') }}
                                        </div>
                                        <a href="{{ route('labour.show', [$labour, 'month' => $nextMonth->month, 'year' => $nextMonth->year, 'start_date' => $startDate, 'end_date' => $endDate]) }}" 
                                           class="p-2 hover:bg-white hover:shadow-sm rounded-lg transition-all text-slate-600 hover:text-indigo-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                        </a>
                                    </div>
                                    
                                    <div>
                                        <h3 class="text-xl font-black text-slate-900 tracking-tighter flex items-center gap-2">
                                            {{ $currentMonthObj->format('F') }}
                                            <span class="text-indigo-600">{{ $selectedYear }}</span>
                                        </h3>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mt-0.5">{{ __('Attendance Timeline') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <form action="{{ route('labour.show', $labour) }}" method="GET" class="flex items-center gap-3 bg-slate-50 p-2 rounded-2xl border border-slate-100">
                                        <input type="hidden" name="start_date" value="{{ $startDate }}">
                                        <input type="hidden" name="end_date" value="{{ $endDate }}">
                                        <select name="month" onchange="this.form.submit()" class="bg-transparent border-none text-[11px] font-black uppercase tracking-widest text-slate-600 focus:ring-0 cursor-pointer">
                                            @foreach(range(1, 12) as $m)
                                                <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                                                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="h-4 w-px bg-slate-200"></div>
                                        <select name="year" onchange="this.form.submit()" class="bg-transparent border-none text-[11px] font-black uppercase tracking-widest text-slate-600 focus:ring-0 cursor-pointer">
                                            @foreach($years as $year)
                                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                    <a href="{{ route('labour.show', $labour) }}" class="p-3 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-0 bg-slate-50">
                            @php
                                $startOfMonth = \Carbon\Carbon::create($selectedYear, $selectedMonth, 1);
                                $daysInMonth = $startOfMonth->daysInMonth;
                                $dayOfWeek = $startOfMonth->dayOfWeek;
                                $weekDayNames = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
                            @endphp
                            
                            <!-- Structured Calendar Grid -->
                            <div class="grid grid-cols-7 gap-px bg-slate-200 border-x border-b border-slate-200 rounded-b-[2rem] overflow-hidden shadow-sm">
                                <!-- Horizontal Day Headers -->
                                @foreach($weekDayNames as $dayName)
                                    <div class="py-3 text-center bg-white border-b border-slate-100">
                                        <span class="text-[9px] font-black text-slate-400 tracking-[0.2em]">{{ $dayName }}</span>
                                    </div>
                                @endforeach

                                <!-- Empty cells for start of month -->
                                @for($i = 0; $i < $dayOfWeek; $i++)
                                    <div class="min-h-[200px] bg-slate-50/30"></div>
                                @endfor

                                <!-- Days of the month -->
                                @for($day = 1; $day <= $daysInMonth; $day++)
                                    @php
                                        $currentDate = \Carbon\Carbon::create($selectedYear, $selectedMonth, $day)->format('Y-m-d');
                                        $isToday = \Carbon\Carbon::parse($currentDate)->isToday();
                                        $dayAttendances = $calendarAttendance->get($currentDate, collect());
                                        $isWeekend = \Carbon\Carbon::parse($currentDate)->isWeekend();
                                    @endphp
                                    <div class="min-h-[200px] {{ $isWeekend ? 'bg-slate-50/60' : 'bg-white' }} p-3 flex flex-col group transition-all relative hover:bg-slate-50/40">
                                        <!-- Structured Date Header -->
                                        <div class="flex items-center justify-between mb-3 pb-2 border-b border-slate-100">
                                            <span class="text-xs font-black {{ $isToday ? 'bg-indigo-600 text-white w-7 h-7 rounded-lg flex items-center justify-center shadow-md' : 'text-slate-900' }}">
                                                {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                                            </span>
                                            @if($dayAttendances->isNotEmpty())
                                                <div class="flex flex-col items-end">
                                                    <span class="px-1.5 py-0.5 bg-indigo-50 text-indigo-600 rounded-md text-[7px] font-black uppercase tracking-tighter">
                                                        {{ count($dayAttendances) }} {{ count($dayAttendances) > 1 ? 'SHIFTS' : 'SHIFT' }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Structured Attendance Details (Horizontal Rows) -->
                                        <div class="flex-1 space-y-3 overflow-y-auto custom-scrollbar pr-1">
                                            @foreach($dayAttendances as $attendance)
                                                <div class="space-y-2 border-l-4 {{ $attendance->status === 'present' ? 'border-emerald-500 bg-emerald-50/40' : 'border-rose-500 bg-rose-50/40' }} p-2 rounded-r-xl shadow-sm">
                                                    
                                                    <!-- Status Row: Horizontal -->
                                                    <div class="flex items-center justify-between border-b border-white/50 pb-1">
                                                        <span class="text-[7px] font-bold text-slate-500 uppercase tracking-widest">{{ __('STATUS') }}</span>
                                                        <span class="text-[9px] font-black uppercase {{ $attendance->status === 'present' ? 'text-emerald-700' : 'text-rose-700' }}">
                                                            {{ $attendance->status }}
                                                        </span>
                                                    </div>

                                                    <!-- Payment Row: Horizontal -->
                                                    @if($attendance->payment_amount > 0)
                                                    <div class="flex items-center justify-between border-b border-white/50 pb-1">
                                                        <span class="text-[7px] font-bold text-slate-500 uppercase tracking-widest">{{ __('PAYMENT') }}</span>
                                                        <span class="text-[9px] font-black text-slate-900 italic">₹{{ number_format($attendance->payment_amount, 0) }}</span>
                                                    </div>
                                                    @endif

                                                    <!-- OT Row: Horizontal -->
                                                    @if($attendance->overtime_hours > 0)
                                                    <div class="flex items-center justify-between border-b border-white/50 pb-1">
                                                        <span class="text-[7px] font-bold text-slate-500 uppercase tracking-widest">{{ __('OT') }}</span>
                                                        <span class="text-[9px] font-black text-amber-600 uppercase">{{ $attendance->overtime_hours }}h</span>
                                                    </div>
                                                    @endif

                                                    <!-- Remarks Section: Structured -->
                                                    @if($attendance->remark || $attendance->notes)
                                                    <div class="flex flex-col bg-white/60 p-1.5 rounded-lg border border-slate-100 shadow-inner mt-1">
                                                        <span class="text-[7px] font-bold text-slate-500 uppercase tracking-widest mb-1">{{ __('REMARK') }}</span>
                                                        <p class="text-[8px] font-bold text-slate-700 leading-tight italic line-clamp-3">
                                                            "{{ $attendance->remark ?: $attendance->notes }}"
                                                        </p>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endfor

                                @php
                                    $totalCells = $dayOfWeek + $daysInMonth;
                                    $remainingCells = (7 - ($totalCells % 7)) % 7;
                                @endphp
                                @for($i = 0; $i < $remainingCells; $i++)
                                    <div class="min-h-[160px] bg-slate-50/50"></div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Attendance Summary Card -->
                    <div class="bg-white rounded-3xl border-2 border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ __('Monthly Attendance Summary') }}
                            </h3>
                            <form action="{{ route('labour.show', $labour) }}" method="GET" class="flex items-center gap-2">
                                <input type="hidden" name="month" value="{{ $selectedMonth }}">
                                <input type="hidden" name="start_date" value="{{ $startDate }}">
                                <input type="hidden" name="end_date" value="{{ $endDate }}">
                                <select name="year" onchange="this.form.submit()" class="text-[10px] font-black uppercase tracking-widest border-2 border-slate-200 rounded-xl px-4 py-1.5 focus:border-indigo-600 focus:ring-0 transition-all cursor-pointer bg-white">
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/50">
                                    <tr>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Month') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">{{ __('Present Days') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">{{ __('OT Hours') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">{{ __('Total Payout') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($monthlyAttendance as $summary)
                                    <tr class="hover:bg-slate-50/30 transition-colors">
                                        <td class="px-8 py-5 text-xs font-black text-slate-900 italic">
                                            {{ \Carbon\Carbon::create()->month($summary->month)->format('F') }} {{ $summary->year }}
                                        </td>
                                        <td class="px-8 py-5 text-xs font-black text-slate-600 text-center italic">
                                            {{ $summary->present_days }} Days
                                        </td>
                                        <td class="px-8 py-5 text-xs font-black text-slate-600 text-center italic">
                                            {{ number_format($summary->total_ot_hours, 1) }} Hrs
                                        </td>
                                        <td class="px-8 py-5 text-sm font-black text-emerald-600 text-right italic">
                                            ₹{{ number_format($summary->total_payout, 2) }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-8 py-12 text-center">
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('No attendance records for ') }} {{ $selectedYear }}</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Payment History Card -->
                    <div class="bg-white rounded-3xl border-2 border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ __('Financial Transactions') }}
                                </h3>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('labour.report', [$labour->id, 'start_date' => $startDate, 'end_date' => $endDate]) }}" 
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        {{ __('Download Report') }}
                                    </a>
                                </div>
                            </div>

                            <form action="{{ route('labour.show', $labour) }}" method="GET" class="mt-6 flex flex-wrap items-end gap-4 bg-white p-4 rounded-2xl border border-slate-200">
                                <input type="hidden" name="year" value="{{ $selectedYear }}">
                                <input type="hidden" name="month" value="{{ $selectedMonth }}">
                                <div class="flex-1 min-w-[140px]">
                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-1.5 ml-1">{{ __('From') }}</label>
                                    <input type="date" name="start_date" value="{{ $startDate }}" class="w-full px-3 py-2 bg-slate-50 border-slate-200 rounded-lg text-xs font-bold focus:ring-4 focus:ring-indigo-600/5 focus:border-indigo-600 transition-all">
                                </div>
                                <div class="flex-1 min-w-[140px]">
                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-1.5 ml-1">{{ __('To') }}</label>
                                    <input type="date" name="end_date" value="{{ $endDate }}" class="w-full px-3 py-2 bg-slate-50 border-slate-200 rounded-lg text-xs font-bold focus:ring-4 focus:ring-indigo-600/5 focus:border-indigo-600 transition-all">
                                </div>
                                <button type="submit" class="px-5 py-2.5 bg-slate-900 text-white rounded-lg font-black text-[10px] uppercase tracking-widest hover:bg-slate-800 transition-all">
                                    {{ __('Filter') }}
                                </button>
                            </form>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/50">
                                    <tr>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Date') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Project') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">{{ __('OT Hours') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">{{ __('Recorded By') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">{{ __('Payout') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($attendances->where('payment_amount', '>', 0) as $payment)
                                    <tr class="hover:bg-slate-50/30 transition-colors">
                                        <td class="px-8 py-5 text-xs font-black text-slate-900 italic">
                                            {{ \Carbon\Carbon::parse($payment->date)->format('d M, Y') }}
                                        </td>
                                        <td class="px-8 py-5">
                                            <div class="flex flex-col">
                                                <span class="text-xs font-bold text-slate-800">{{ $payment->project->name }}</span>
                                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $payment->shift }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5 text-xs font-black text-slate-600 text-center italic">
                                            {{ $payment->overtime_hours ?? 0 }}
                                        </td>
                                        <td class="px-8 py-5 text-xs font-black text-slate-600 text-center italic">
                                            <div>{{ $payment->recorder->name ?? 'System' }}</div>
                                            @if($payment->recorded_at)
                                                <div class="text-[8px] text-slate-400 not-italic">{{ $payment->recorded_at->timezone('Asia/Kolkata')->format('h:i A') }} IST</div>
                                            @endif
                                        </td>
                                        <td class="px-8 py-5 text-sm font-black text-emerald-600 text-right italic">
                                            ₹{{ number_format($payment->payment_amount, 2) }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-8 py-12 text-center">
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('No Payouts found for selected range') }}</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                @if($attendances->where('payment_amount', '>', 0)->count() > 0)
                                <tfoot class="bg-emerald-50/50">
                                    <tr>
                                        <td colspan="4" class="px-8 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">{{ __('Total for Range:') }}</td>
                                        <td class="px-8 py-4 text-sm font-black text-emerald-700 text-right">₹{{ number_format($totalPaidInRange, 2) }}</td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>

                    <!-- Remarks Card -->
                    @if($labour->remarks)
                    <div class="bg-indigo-600 rounded-3xl p-8 text-white shadow-xl shadow-indigo-100">
                        <h4 class="text-xs font-black uppercase tracking-[0.2em] text-indigo-200 mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                            {{ __('Supervisor Remarks') }}
                        </h4>
                        <p class="text-base font-bold italic leading-relaxed">
                            "{{ $labour->remarks }}"
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>