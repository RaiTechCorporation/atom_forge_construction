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
                        @if($siteManager->photo_path)
                            <img src="{{ asset('storage/' . $siteManager->photo_path) }}" alt="{{ $siteManager->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white text-2xl font-black">
                                {{ substr($siteManager->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 rounded-lg {{ $siteManager->status === 'Active' ? 'bg-emerald-500' : 'bg-rose-500' }} border-4 border-white flex items-center justify-center shadow-lg">
                        <div class="w-2 h-2 rounded-full bg-white animate-pulse"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md">
                            {{ $siteManager->manager_unique_id }}
                        </span>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] {{ $siteManager->status === 'Active' ? 'text-emerald-600 bg-emerald-50' : 'text-rose-600 bg-rose-50' }} px-2 py-0.5 rounded-md">
                            {{ $siteManager->status }}
                        </span>
                    </div>
                    <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tighter">
                        {{ $siteManager->name }}
                    </h2>
                    <p class="text-sm font-bold text-slate-500 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        {{ $siteManager->project->name ?? 'Unassigned' }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('site-managers.edit', $siteManager) }}" 
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
                <!-- Salary Card -->
                <div class="bg-white rounded-3xl p-6 border-2 border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-600 group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <span class="text-[10px] font-black text-slate-400 bg-slate-50 px-3 py-1 rounded-lg uppercase tracking-[0.2em]">{{ $siteManager->salary_type }}</span>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Current Salary') }}</p>
                    <h4 class="text-2xl font-black text-slate-900 italic">₹{{ number_format($siteManager->salary_amount, 2) }}</h4>
                </div>

                <!-- Financial Health Card -->
                <div class="bg-slate-900 rounded-3xl p-6 shadow-xl shadow-slate-200 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                        <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">{{ __('Financial Overview') }}</p>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-800 pb-2">
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Total Paid') }}</span>
                                <span class="text-sm font-black text-emerald-400 italic">₹{{ number_format($siteManager->payouts()->sum('paid_amount'), 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between pt-1">
                                <span class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em]">{{ __('Net Payable (All Time)') }}</span>
                                <span class="text-xl font-black text-white italic">₹{{ number_format($siteManager->payouts()->sum('net_amount'), 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Engagement Card -->
                <div class="bg-white rounded-3xl p-6 border-2 border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg uppercase tracking-[0.2em]">{{ __('Activity') }}</span>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Total Attendance') }}</p>
                    <h4 class="text-2xl font-black text-slate-900 italic">{{ $siteManager->attendances->where('status', 'Present')->unique('date')->count() }} <span class="text-sm font-bold text-slate-400 not-italic uppercase tracking-widest ml-1">{{ __('Days') }}</span></h4>
                    <div class="mt-2 text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $siteManager->attendances()->sum('overtime_hours') }} {{ __('Total OT Hours') }}</div>
                </div>

                <!-- Leave Balance Card -->
                <div class="bg-white rounded-3xl p-6 border-2 border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-[10px] font-black text-amber-600 bg-amber-50 px-3 py-1 rounded-lg uppercase tracking-[0.2em]">{{ __('Availability') }}</span>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Leave Balance') }}</p>
                    <h4 class="text-2xl font-black text-slate-900 italic">{{ $siteManager->leave_balance }} <span class="text-sm font-bold text-slate-400 not-italic uppercase tracking-widest ml-1">{{ __('Days') }}</span></h4>
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
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Highest Qualification') }}</label>
                                <p class="text-sm font-bold text-indigo-600 italic">{{ $siteManager->qualification ?? 'Not Provided' }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Working Experience') }}</label>
                                <p class="text-sm font-bold text-slate-900">{{ $siteManager->experience ?? 'Not Provided' }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Father Name') }}</label>
                                <p class="text-sm font-bold text-slate-900">{{ $siteManager->father_name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Contact Details') }}</label>
                                <p class="text-sm font-black text-indigo-600">+91 {{ $siteManager->phone ?? 'N/A' }}</p>
                                <p class="text-xs font-bold text-slate-500 mt-1">{{ $siteManager->email }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">{{ __('Current Address') }}</label>
                                <p class="text-xs font-bold text-slate-600 leading-relaxed">{{ $siteManager->current_address ?? 'No address registered' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Educational Background Card -->
                    <div class="bg-white rounded-3xl border-2 border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                                {{ __('Educational Background') }}
                            </h3>
                        </div>
                        <div class="p-8 space-y-6">
                            <!-- 10th Details -->
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 pb-2 border-b border-white">{{ __('10th Grade / Metric') }}</p>
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ __('Year') }}</p>
                                        <p class="text-xs font-black text-slate-900">{{ $siteManager->tenth_passing_year ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ __('Score') }}</p>
                                        <p class="text-xs font-black text-emerald-600">{{ $siteManager->tenth_percentage ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ __('Board') }}</p>
                                        <p class="text-xs font-black text-slate-900">{{ $siteManager->tenth_board ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- 12th Details -->
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 pb-2 border-b border-white">{{ __('12th Grade / Intermediate') }}</p>
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ __('Year') }}</p>
                                        <p class="text-xs font-black text-slate-900">{{ $siteManager->twelfth_passing_year ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ __('Score') }}</p>
                                        <p class="text-xs font-black text-emerald-600">{{ $siteManager->twelfth_percentage ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ __('Board') }}</p>
                                        <p class="text-xs font-black text-slate-900">{{ $siteManager->twelfth_board ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Graduation Details -->
                            <div class="p-4 bg-slate-900 rounded-2xl border border-slate-800 shadow-lg">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 pb-2 border-b border-slate-800">{{ __('Graduation / Degree') }}</p>
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Year') }}</p>
                                        <p class="text-xs font-black text-white">{{ $siteManager->graduation_passing_year ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Score') }}</p>
                                        <p class="text-xs font-black text-emerald-400">{{ $siteManager->graduation_percentage ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">{{ __('University') }}</p>
                                        <p class="text-xs font-black text-white">{{ $siteManager->graduation_university ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KYC & Documents Card -->
                    <div class="bg-white rounded-3xl border-2 border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                {{ __('KYC Documents') }}
                            </h3>
                        </div>
                        <div class="p-8 space-y-4">
                            @php
                                $docs = [
                                    ['label' => 'Aadhaar Card', 'number' => $siteManager->aadhaar_number, 'path' => $siteManager->id_proof_path],
                                    ['label' => 'PAN Card', 'number' => $siteManager->pan_number, 'path' => $siteManager->pan_proof_path],
                                    ['label' => '10th Certificate', 'number' => null, 'path' => $siteManager->certificate_10th_path],
                                    ['label' => '12th Certificate', 'number' => null, 'path' => $siteManager->certificate_12th_path],
                                    ['label' => 'Graduation Degree', 'number' => null, 'path' => $siteManager->graduation_certificate_path],
                                    ['label' => 'Skilled Certificate', 'number' => null, 'path' => $siteManager->skilled_certificate_path],
                                ];
                            @endphp
                            @foreach($docs as $doc)
                                @if($doc['path'] || $doc['number'])
                                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 group">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ $doc['label'] }}</p>
                                            @if($doc['number'])
                                                <p class="text-sm font-black text-slate-900 tracking-tight">{{ $doc['number'] }}</p>
                                            @else
                                                <p class="text-[9px] font-bold text-emerald-600 uppercase tracking-widest">Document Uploaded</p>
                                            @endif
                                        </div>
                                        @if($doc['path'])
                                            <a href="{{ asset('storage/' . $doc['path']) }}" target="_blank" class="w-8 h-8 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-600 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 transition-all shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Professional History -->
                    <div class="bg-white rounded-[2rem] border-2 border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                        <div class="px-8 py-6 bg-slate-900 border-b border-slate-800 flex items-center justify-between">
                            <h3 class="text-xs font-black text-white uppercase tracking-[0.2em] flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ __('Professional Experience History') }}
                            </h3>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $siteManager->experiences->count() }} Entries</span>
                        </div>
                        <div class="p-8 space-y-8">
                            @forelse($siteManager->experiences as $exp)
                                <div class="relative pl-8 border-l-2 border-slate-100 group">
                                    <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white border-4 border-indigo-600 shadow-sm group-hover:scale-125 transition-transform"></div>
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                                        <div>
                                            <h4 class="text-lg font-black text-slate-900 leading-tight">{{ $exp->job_title }}</h4>
                                            <p class="text-sm font-bold text-indigo-600">{{ $exp->company_name }} <span class="text-slate-400 mx-2">•</span> {{ $exp->location }}</p>
                                        </div>
                                        <div class="flex flex-col items-end">
                                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1 rounded-lg border border-slate-100">
                                                {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }} — {{ $exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : 'Present' }}
                                            </span>
                                            @if($exp->end_date)
                                                @php
                                                    $start = \Carbon\Carbon::parse($exp->start_date);
                                                    $end = \Carbon\Carbon::parse($exp->end_date);
                                                    $diff = $start->diffInMonths($end);
                                                    $years = floor($diff / 12);
                                                    $months = $diff % 12;
                                                @endphp
                                                <span class="text-[9px] font-bold text-slate-400 mt-1">
                                                    {{ $years > 0 ? $years.' Yr ' : '' }}{{ $months > 0 ? $months.' Mo' : '' }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @if($exp->responsibilities_achievements)
                                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                                            <p class="text-xs font-semibold text-slate-600 leading-relaxed whitespace-pre-line">
                                                {{ $exp->responsibilities_achievements }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-10 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('No detailed experience history recorded') }}</p>
                                </div>
                            @endforelse
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
                                        <a href="{{ route('site-managers.show', [$siteManager, 'month' => $prevMonth->month, 'year' => $prevMonth->year, 'start_date' => $startDate, 'end_date' => $endDate]) }}" 
                                           class="p-2 hover:bg-white hover:shadow-sm rounded-lg transition-all text-slate-600 hover:text-indigo-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                                        </a>
                                        <div class="px-3 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                            {{ __('Navigation') }}
                                        </div>
                                        <a href="{{ route('site-managers.show', [$siteManager, 'month' => $nextMonth->month, 'year' => $nextMonth->year, 'start_date' => $startDate, 'end_date' => $endDate]) }}" 
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
                                    <form action="{{ route('site-managers.show', $siteManager) }}" method="GET" class="flex items-center gap-3 bg-slate-50 p-2 rounded-2xl border border-slate-100">
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
                                    <a href="{{ route('site-managers.attendance-records', ['site_manager_id' => $siteManager->id]) }}" class="p-3 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200 group relative">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        <span class="absolute -top-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[9px] font-black uppercase tracking-widest px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">{{ __('Detailed Records') }}</span>
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
                                    <div class="min-h-[160px] bg-slate-50/30"></div>
                                @endfor

                                <!-- Days of the month -->
                                @for($day = 1; $day <= $daysInMonth; $day++)
                                    @php
                                        $currentDate = \Carbon\Carbon::create($selectedYear, $selectedMonth, $day)->format('Y-m-d');
                                        $isToday = \Carbon\Carbon::parse($currentDate)->isToday();
                                        $dayAttendances = $calendarAttendance->get($currentDate, collect());
                                        $isWeekend = \Carbon\Carbon::parse($currentDate)->isWeekend();
                                    @endphp
                                    <div class="min-h-[160px] {{ $isWeekend ? 'bg-slate-50/60' : 'bg-white' }} p-3 flex flex-col group transition-all relative hover:bg-slate-50/40">
                                        <!-- Structured Date Header -->
                                        <div class="flex items-center justify-between mb-3 pb-2 border-b border-slate-100">
                                            <span class="text-xs font-black {{ $isToday ? 'bg-indigo-600 text-white w-7 h-7 rounded-lg flex items-center justify-center shadow-md' : 'text-slate-900' }}">
                                                {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                                            </span>
                                        </div>
                                        
                                        <!-- Structured Attendance Details -->
                                        <div class="flex-1 space-y-3 overflow-y-auto custom-scrollbar pr-1">
                                            @foreach($dayAttendances as $attendance)
                                                <div class="space-y-2 border-l-4 {{ $attendance->status === 'Present' ? 'border-emerald-500 bg-emerald-50/40' : ($attendance->status === 'Absent' ? 'border-rose-500 bg-rose-50/40' : 'border-amber-500 bg-amber-50/40') }} p-2 rounded-r-xl shadow-sm">
                                                    
                                                    <!-- Status Row -->
                                                    <div class="flex items-center justify-between border-b border-white/50 pb-1">
                                                        <span class="text-[7px] font-bold text-slate-500 uppercase tracking-widest">{{ __('STATUS') }}</span>
                                                        <span class="text-[9px] font-black uppercase {{ $attendance->status === 'Present' ? 'text-emerald-700' : ($attendance->status === 'Absent' ? 'text-rose-700' : 'text-amber-700') }}">
                                                            {{ $attendance->status }}
                                                        </span>
                                                    </div>

                                                    <!-- OT Row -->
                                                    @if($attendance->overtime_hours > 0)
                                                    <div class="flex items-center justify-between border-b border-white/50 pb-1">
                                                        <span class="text-[7px] font-bold text-slate-500 uppercase tracking-widest">{{ __('OT') }}</span>
                                                        <span class="text-[9px] font-black text-amber-600 uppercase">{{ $attendance->overtime_hours }}h</span>
                                                    </div>
                                                    @endif

                                                    <!-- Remarks Section -->
                                                    @if($attendance->remarks)
                                                    <div class="flex flex-col bg-white/60 p-1.5 rounded-lg border border-slate-100 shadow-inner mt-1">
                                                        <span class="text-[7px] font-bold text-slate-500 uppercase tracking-widest mb-1">{{ __('REMARK') }}</span>
                                                        <p class="text-[8px] font-bold text-slate-700 leading-tight italic line-clamp-3">
                                                            "{{ $attendance->remarks }}"
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

                    <!-- Attendance History Table Card -->
                    <div class="bg-white rounded-[2rem] border-2 border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                {{ __('Attendance Records History') }}
                            </h3>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('site-managers.report.pdf', [$siteManager->id, 'start_date' => $startDate, 'end_date' => $endDate]) }}" 
                                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-rose-600 text-white rounded-lg font-black text-[9px] uppercase tracking-widest hover:bg-rose-700 transition-all shadow-md">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    PDF
                                </a>
                                <a href="{{ route('site-managers.report.excel', [$siteManager->id, 'start_date' => $startDate, 'end_date' => $endDate]) }}" 
                                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-600 text-white rounded-lg font-black text-[9px] uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-md">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Excel
                                </a>
                                <a href="{{ route('site-managers.attendance-records', ['site_manager_id' => $siteManager->id]) }}" class="text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-700">View Log</a>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/50">
                                    <tr>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Date') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Project') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">{{ __('Status') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">{{ __('OT Hours') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">{{ __('Recorded By') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($attendances->take(10) as $attendance)
                                    <tr class="hover:bg-slate-50/30 transition-colors">
                                        <td class="px-8 py-5 text-xs font-black text-slate-900 italic">
                                            {{ \Carbon\Carbon::parse($attendance->date)->format('d M, Y') }}
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="text-xs font-bold text-slate-800">{{ $attendance->project->name ?? 'N/A' }}</span>
                                        </td>
                                        <td class="px-8 py-5 text-center">
                                            @if($attendance->status == 'Present')
                                                <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase tracking-widest border border-emerald-100">{{ __('Present') }}</span>
                                            @elseif($attendance->status == 'Half Day')
                                                <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-600 text-[9px] font-black uppercase tracking-widest border border-amber-100">{{ __('Half Day') }}</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded-md bg-rose-50 text-rose-600 text-[9px] font-black uppercase tracking-widest border border-rose-100">{{ __('Absent') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-8 py-5 text-xs font-black text-slate-600 text-center italic">
                                            {{ $attendance->overtime_hours ?? 0 }} Hrs
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <div class="text-xs font-black text-slate-600 italic">{{ $attendance->recorder->name ?? 'System' }}</div>
                                            @if($attendance->recorded_at)
                                                <div class="text-[8px] text-slate-400 font-bold uppercase tracking-tighter">{{ \Carbon\Carbon::parse($attendance->recorded_at)->timezone('Asia/Kolkata')->format('h:i A') }}</div>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-8 py-12 text-center">
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('No recent attendance records found') }}</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Monthly Attendance Summary Card -->
                    <div class="bg-white rounded-3xl border-2 border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ __('Monthly Attendance Summary') }}
                            </h3>
                            <form action="{{ route('site-managers.show', $siteManager) }}" method="GET" class="flex items-center gap-2">
                                <input type="hidden" name="month" value="{{ $selectedMonth }}">
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
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">{{ __('Present') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">{{ __('Half Day') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">{{ __('Absent') }}</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">{{ __('OT Hours') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($monthlyAttendance as $summary)
                                    <tr class="hover:bg-slate-50/30 transition-colors">
                                        <td class="px-8 py-5 text-xs font-black text-slate-900 italic">
                                            {{ \Carbon\Carbon::create()->month($summary->month)->format('F') }} {{ $summary->year }}
                                        </td>
                                        <td class="px-8 py-5 text-xs font-black text-emerald-600 text-center italic">
                                            {{ $summary->present_days }}
                                        </td>
                                        <td class="px-8 py-5 text-xs font-black text-amber-600 text-center italic">
                                            {{ $summary->half_days }}
                                        </td>
                                        <td class="px-8 py-5 text-xs font-black text-rose-600 text-center italic">
                                            {{ $summary->absent_days }}
                                        </td>
                                        <td class="px-8 py-5 text-xs font-black text-slate-600 text-center italic">
                                            {{ number_format($summary->total_ot_hours, 1) }} Hrs
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-8 py-12 text-center">
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ __('No attendance records for ') }} {{ $selectedYear }}</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Payout History -->
                    <div class="bg-white rounded-3xl border-2 border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ __('Payroll History') }}
                            </h3>
                            <a href="{{ route('site-managers.payouts.index') }}" class="text-[10px] font-black text-emerald-600 uppercase tracking-widest hover:text-emerald-700">View All</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/50">
                                    <tr>
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Month</th>
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest">Amount</th>
                                        <th class="px-8 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-right">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($payouts as $payout)
                                        <tr>
                                            <td class="px-8 py-4 text-sm font-black text-slate-900 tracking-tight">{{ $payout->month }}</td>
                                            <td class="px-8 py-4 text-xs font-bold text-slate-500">{{ \Carbon\Carbon::parse($payout->payout_date)->format('d M Y') }}</td>
                                            <td class="px-8 py-4 text-sm font-black text-emerald-600 italic">₹{{ number_format($payout->net_amount, 2) }}</td>
                                            <td class="px-8 py-4 text-right">
                                                <span class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase tracking-widest">
                                                    {{ $payout->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-8 py-10 text-center text-xs font-bold text-slate-400 uppercase tracking-widest italic">No payout history found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>