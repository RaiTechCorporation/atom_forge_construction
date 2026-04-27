<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Attendance Registry') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Mark and manage daily worker attendance across projects.') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('attendance.index') }}" 
                    class="inline-flex items-center px-6 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold text-xs hover:bg-slate-50 transition-all shadow-sm uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    {{ __('View Records') }}
                </a>
            </div>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-[10px] font-bold uppercase tracking-widest text-slate-500 hover:text-indigo-600 transition-colors">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="flex items-center" aria-current="page">
                        <svg class="w-4 h-4 text-slate-300 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-600">{{ __('Attendance') }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-xl flex items-center gap-3 animate-fade-in" role="alert">
                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-semibold text-emerald-800 text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-rose-50 border border-rose-100 p-4 rounded-xl" role="alert">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 bg-rose-500 rounded-full flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <span class="font-bold text-rose-800 text-sm">{{ __('Validation Error') }}</span>
                </div>
                <ul class="list-disc list-inside text-rose-700 text-xs font-medium ml-11">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Attendance Filter -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <div class="lg:col-span-3 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm h-full">
                <form id="filterForm" action="{{ route('attendance.create') }}" method="GET" class="flex flex-wrap items-end gap-6">
                    <div class="flex-1 min-w-[200px]">
                        <x-input-label for="project_id" :value="__('Select Project')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                        <div class="relative">
                            <select id="project_id_filter" name="project_id" 
                                class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[46px] appearance-none cursor-pointer" required>
                                <option value="">{{ __('CHOOSE PROJECT') }}</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ $selectedProjectId == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-40">
                        <x-input-label for="date" :value="__('Attendance Date')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                        <x-text-input id="date_filter" name="date" type="date" 
                            class="mt-0 block w-full px-4 py-2 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900" 
                            :value="$date" required />
                    </div>
                    <div class="w-full md:w-48">
                        <x-input-label for="shift" :value="__('Select Shift')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                        <div class="relative">
                            <select id="shift_filter" name="shift" 
                                class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[46px] appearance-none cursor-pointer" required>
                                <option value="1st Shift" {{ $shift == '1st Shift' ? 'selected' : '' }}>1st Shift</option>
                                <option value="2nd Shift" {{ $shift == '2nd Shift' ? 'selected' : '' }}>2nd Shift</option>
                                <option value="Overtime" {{ $shift == 'Overtime' ? 'selected' : '' }}>Overtime</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                    <button type="submit" 
                        class="w-full md:w-auto px-8 py-2.5 bg-slate-900 text-white rounded-xl font-bold text-xs hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10 uppercase tracking-widest">
                        {{ __('Load Workforce') }}
                    </button>
                </form>
            </div>

            <!-- Shift Financial Summary -->
            <div class="bg-emerald-600 rounded-2xl p-6 shadow-xl shadow-emerald-600/20 text-white flex flex-col justify-center">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-100 mb-1">{{ __('Shift Total Payout') }}</p>
                <h4 id="today-payout-summary" class="text-3xl font-black italic">
                    ₹{{ number_format($labours->sum(function($worker) use ($existingAttendance) {
                        return isset($existingAttendance[$worker->id]) ? $existingAttendance[$worker->id]->payment_amount : 0;
                    }), 2) }}
                </h4>
                <div class="mt-4 pt-4 border-t border-emerald-500 flex items-center justify-between text-[10px] font-bold uppercase tracking-widest">
                    <span>{{ __('Workers Paid') }}</span>
                    <span>{{ $labours->filter(fn($w) => isset($existingAttendance[$w->id]) && $existingAttendance[$w->id]->payment_amount > 0)->count() }} / {{ $labours->count() }}</span>
                </div>
            </div>
        </div>

        @if($selectedProjectId)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-slate-50/50 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">
                        {{ __('Marking for:') }} <span class="text-indigo-600 ml-1">{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</span>
                        <span class="mx-2 text-slate-300">|</span>
                        <span class="text-indigo-600 uppercase">{{ $shift }}</span>
                    </h3>
                    <div class="flex items-center gap-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                        <span class="flex items-center gap-2 px-3 py-1 bg-white border border-slate-200 rounded-lg"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span> {{ __('PRESENT') }}</span>
                        <span class="flex items-center gap-2 px-3 py-1 bg-white border border-slate-200 rounded-lg"><span class="w-2 h-2 bg-rose-500 rounded-full"></span> {{ __('ABSENT') }}</span>
                    </div>
                </div>
                
                <form action="{{ route('attendance.createsave') }}" method="POST" onsubmit="console.log('Form submitting...');">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $selectedProjectId }}">
                    <input type="hidden" name="date" value="{{ $date }}">
                    <input type="hidden" name="shift" value="{{ $shift }}">

                    <div class="block lg:hidden">
                        <div class="space-y-4 bg-slate-100 p-2">
                            @foreach($labours as $worker)
                                <div class="p-4 space-y-4 bg-white rounded-xl shadow-sm border-2 border-slate-200" data-wage-rate="{{ $worker->wage_rate }}">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="text-sm font-bold text-slate-900">{{ $worker->name }}</div>
                                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $worker->work_type }}</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-[11px] font-black text-slate-500 uppercase tracking-tighter">Rate: ₹{{ number_format($worker->wage_rate, 0) }}</div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Status') }}</span>
                                            <div class="flex items-center gap-2">
                                                <label class="flex-1 cursor-pointer">
                                                    <input type="radio" name="attendance[{{ $worker->id }}]" value="present" 
                                                        {{ (isset($existingAttendance[$worker->id]) && $existingAttendance[$worker->id]->status == 'present') ? 'checked' : '' }}
                                                        class="hidden peer">
                                                    <div class="py-2 flex items-center justify-center rounded-lg border border-slate-200 bg-slate-50 peer-checked:bg-emerald-500 peer-checked:border-emerald-600 peer-checked:text-white text-slate-400 transition-all">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                    </div>
                                                </label>
                                                <label class="flex-1 cursor-pointer">
                                                    <input type="radio" name="attendance[{{ $worker->id }}]" value="absent" 
                                                        {{ (isset($existingAttendance[$worker->id]) && $existingAttendance[$worker->id]->status == 'absent') ? 'checked' : '' }}
                                                        class="hidden peer">
                                                    <div class="py-2 flex items-center justify-center rounded-lg border border-slate-200 bg-slate-50 peer-checked:bg-rose-500 peer-checked:border-rose-600 peer-checked:text-white text-slate-400 transition-all">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="space-y-2 text-center">
                                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $shift == 'Overtime' ? __('OT Hrs') : __('OT Hours') }}</span>
                                            <x-text-input name="overtime_hours[{{ $worker->id }}]" type="number" step="0.5" min="0" 
                                                class="block w-full px-2 py-1.5 bg-slate-50 border-slate-200 rounded-lg text-sm font-semibold text-center" 
                                                :value="isset($existingAttendance[$worker->id]) ? $existingAttendance[$worker->id]->overtime_hours : 0" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 gap-4">
                                        <div class="space-y-2">
                                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Payment (₹)') }}</span>
                                            <x-text-input name="payment_amount[{{ $worker->id }}]" type="number" step="0.01" min="0" 
                                                class="block w-full px-3 py-2 bg-slate-50 border-slate-200 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/5 rounded-lg text-sm font-bold text-emerald-700" 
                                                placeholder="0.00"
                                                :value="isset($existingAttendance[$worker->id]) ? $existingAttendance[$worker->id]->payment_amount : ''" />
                                        </div>
                                        <div class="space-y-2">
                                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Remark') }}</span>
                                            <textarea name="remark[{{ $worker->id }}]" 
                                                class="block w-full px-3 py-2 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-lg text-sm font-semibold text-slate-900 resize-none transition-all duration-200" 
                                                placeholder="Optional remark..."
                                                rows="1"
                                                oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'">{{ isset($existingAttendance[$worker->id]) ? $existingAttendance[$worker->id]->remark : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="hidden lg:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50/30">
                                <tr>
                                    <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">{{ __('Worker Identity') }}</th>
                                    <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">{{ __('Category') }}</th>
                                    <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-500 uppercase tracking-widest w-24">{{ __('Rate') }}</th>
                                    <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-500 uppercase tracking-widest w-32">{{ __('Status') }}</th>
                                    <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-500 uppercase tracking-widest w-32">{{ $shift == 'Overtime' ? __('Labour Work in OT (Hours)') : __('OT Hours') }}</th>
                                    <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-500 uppercase tracking-widest w-40">{{ __('Payment (₹)') }}</th>
                                    <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-500 uppercase tracking-widest w-48">{{ __('Remark') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @foreach($labours as $worker)
                                    <tr class="hover:bg-slate-50/50 transition-colors group" data-wage-rate="{{ $worker->wage_rate }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-slate-900 tracking-tight">{{ $worker->name }}</div>
                                            <div class="text-[9px] font-bold text-slate-400 mt-0.5 tracking-widest uppercase">ID: {{ str_pad($worker->id, 5, '0', STR_PAD_LEFT) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md text-[10px] font-bold uppercase tracking-widest">{{ $worker->work_type }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="text-[11px] font-black text-slate-500 tracking-tighter">₹{{ number_format($worker->wage_rate, 0) }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-3">
                                                <label class="cursor-pointer group/radio">
                                                    <input type="radio" name="attendance[{{ $worker->id }}]" value="present" 
                                                        {{ (isset($existingAttendance[$worker->id]) && $existingAttendance[$worker->id]->status == 'present') ? 'checked' : '' }}
                                                        class="hidden peer">
                                                    <div class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 bg-slate-50 peer-checked:bg-emerald-500 peer-checked:border-emerald-600 peer-checked:text-white text-slate-400 transition-all hover:border-emerald-200">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                    </div>
                                                </label>
                                                <label class="cursor-pointer group/radio">
                                                    <input type="radio" name="attendance[{{ $worker->id }}]" value="absent" 
                                                        {{ (isset($existingAttendance[$worker->id]) && $existingAttendance[$worker->id]->status == 'absent') ? 'checked' : '' }}
                                                        class="hidden peer">
                                                    <div class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 bg-slate-50 peer-checked:bg-rose-500 peer-checked:border-rose-600 peer-checked:text-white text-slate-400 transition-all hover:border-rose-200">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </div>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <x-text-input name="overtime_hours[{{ $worker->id }}]" type="number" step="0.5" min="0" 
                                                class="block w-20 mx-auto px-2 py-1 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-lg text-sm font-semibold text-slate-900 text-center" 
                                                :value="isset($existingAttendance[$worker->id]) ? $existingAttendance[$worker->id]->overtime_hours : 0" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <x-text-input name="payment_amount[{{ $worker->id }}]" type="number" step="0.01" min="0" 
                                                class="block w-32 mx-auto px-3 py-1 bg-slate-50 border-slate-200 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/5 rounded-lg text-sm font-bold text-emerald-700 text-center" 
                                                placeholder="0.00"
                                                :value="isset($existingAttendance[$worker->id]) ? $existingAttendance[$worker->id]->payment_amount : ''" />
                                        </td>
                                        <td class="px-6 py-4">
                                            <textarea name="remark[{{ $worker->id }}]" 
                                                class="block w-full min-w-[200px] px-3 py-2 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-lg text-sm font-semibold text-slate-900 resize-none transition-all duration-200" 
                                                placeholder="Optional remark..."
                                                rows="1"
                                                oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'">{{ isset($existingAttendance[$worker->id]) ? $existingAttendance[$worker->id]->remark : '' }}</textarea>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-slate-50/50">
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-right text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                                        {{ __('Total Payment for this Shift:') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div id="total-payment-display" class="text-sm font-bold text-emerald-600 bg-emerald-50 px-4 py-2 rounded-lg border border-emerald-100 inline-block min-w-[120px]">
                                            ₹{{ number_format($labours->sum(function($worker) use ($existingAttendance) {
                                                return isset($existingAttendance[$worker->id]) ? $existingAttendance[$worker->id]->payment_amount : 0;
                                            }), 2) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="px-6 py-6 bg-slate-50/50 border-t border-slate-100 flex justify-end">
                        <button type="submit" 
                            class="w-full sm:w-auto px-10 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-xs hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 uppercase tracking-widest">
                            {{ __('Save Attendance Record') }}
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-white border border-slate-200 p-12 text-center rounded-3xl shadow-sm">
                <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h4 class="text-lg font-bold text-slate-900 mb-2">{{ __('Initialize Workforce Registry') }}</h4>
                <p class="text-sm font-medium text-slate-500 max-w-sm mx-auto leading-relaxed">
                    {{ __('Choose a project and date from the filters above to load the active labour force for attendance marking.') }}
                </p>
            </div>
        @endif
    </div>
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentInputs = document.querySelectorAll('input[name^="payment_amount"]');
            const totalDisplay = document.getElementById('total-payment-display');
            const summaryDisplay = document.getElementById('today-payout-summary');
            const workersPaidDisplay = document.querySelector('.mt-4.pt-4.border-t.border-emerald-500 span:last-child');
            const totalWorkersCount = {{ $labours->count() }};

            function updateTotal() {
                let total = 0;
                let paidCount = 0;
                paymentInputs.forEach(input => {
                    const val = parseFloat(input.value) || 0;
                    total += val;
                    if (val > 0) paidCount++;
                });

                const formattedTotal = '₹' + total.toLocaleString('en-IN', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                if (totalDisplay) totalDisplay.textContent = formattedTotal;
                if (summaryDisplay) summaryDisplay.textContent = formattedTotal;
                if (workersPaidDisplay) workersPaidDisplay.textContent = paidCount + ' / ' + totalWorkersCount;
            }

            paymentInputs.forEach(input => {
                input.addEventListener('input', updateTotal);
            });

            function calculateRowPayment(row) {
                const wageRate = parseFloat(row.getAttribute('data-wage-rate')) || 0;
                const status = row.querySelector('input[name^="attendance"]:checked')?.value;
                const otHours = parseFloat(row.querySelector('input[name^="overtime_hours"]')?.value) || 0;
                const paymentInput = row.querySelector('input[name^="payment_amount"]');
                
                let payment = 0;
                const hourlyRate = wageRate / 8;

                if (currentShift === "1st Shift" || currentShift === "2nd Shift") {
                    if (status === "present") {
                        payment += wageRate * 0.5;
                    }
                }
                
                // Add Overtime calculation: (wage rate / 8) * hours
                payment += otHours * hourlyRate;

                paymentInput.value = payment.toFixed(2);
                updateTotal();
            }

            // Auto-fill wage rate and OT calculation
            const currentShift = "{{ $shift }}";
            
            const statusRadios = document.querySelectorAll('input[name^="attendance"]');
            statusRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    calculateRowPayment(this.closest('tr'));
                });
            });

            const otHoursInputs = document.querySelectorAll('input[name^="overtime_hours"]');
            otHoursInputs.forEach(input => {
                input.addEventListener('input', function() {
                    calculateRowPayment(this.closest('tr'));
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
