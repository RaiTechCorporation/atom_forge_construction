<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Attendance Records') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('View and manage historical attendance data across all sites.') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('attendance.export', request()->all()) }}" 
                    class="inline-flex items-center px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold text-xs hover:bg-slate-50 transition-all shadow-sm uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    {{ __('Export') }}
                </a>

                <button type="button" 
                    onclick="document.getElementById('importModal').classList.remove('hidden')"
                    class="inline-flex items-center px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold text-xs hover:bg-slate-50 transition-all shadow-sm uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    {{ __('Import') }}
                </button>

                <button type="button" 
                    onclick="document.getElementById('deleteModal').classList.remove('hidden')"
                    class="inline-flex items-center px-4 py-2.5 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl font-bold text-xs hover:bg-rose-100 transition-all shadow-sm uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    {{ __('Bulk Delete') }}
                </button>

                <a href="{{ route('attendance.create') }}" 
                    class="inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-xs hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('Mark New Attendance') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-400 p-4 rounded-xl shadow-sm mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-emerald-800 uppercase tracking-wider">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error') || $errors->any())
            <div class="bg-rose-50 border-l-4 border-rose-400 p-4 rounded-xl shadow-sm mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-rose-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-rose-800 uppercase tracking-wider">
                            {{ session('error') ?? __('Please correct the errors below.') }}
                        </p>
                        @if($errors->any())
                            <ul class="mt-1 list-disc list-inside text-xs text-rose-700 font-medium">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm">
            <form action="{{ route('attendance.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-[200px]">
                    <x-input-label for="project_id" :value="__('Project')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-1.5 ml-1" />
                    <select name="project_id" class="block w-full px-3 py-2 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[42px]">
                        <option value="">{{ __('All Projects') }}</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-40">
                    <x-input-label for="start_date" :value="__('Start Date')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-1.5 ml-1" />
                    <x-text-input name="start_date" type="date" class="block w-full px-3 py-1.5 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[42px]" :value="request('start_date')" />
                </div>
                <div class="w-full md:w-40">
                    <x-input-label for="end_date" :value="__('End Date')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-1.5 ml-1" />
                    <x-text-input name="end_date" type="date" class="block w-full px-3 py-1.5 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[42px]" :value="request('end_date')" />
                </div>
                <div class="w-full md:w-40">
                    <x-input-label for="month" :value="__('Month')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-1.5 ml-1" />
                    <select name="month" class="block w-full px-3 py-2 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[42px]">
                        <option value="">{{ __('All Months') }}</option>
                        @for($m=1; $m<=12; $m++)
                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="w-full md:w-32">
                    <x-input-label for="year" :value="__('Year')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-1.5 ml-1" />
                    <select name="year" class="block w-full px-3 py-2 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[42px]">
                        <option value="">{{ __('All Years') }}</option>
                        @for($y=date('Y'); $y>=2020; $y--)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="w-full md:w-40">
                    <x-input-label for="shift" :value="__('Shift')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-1.5 ml-1" />
                    <select name="shift" class="block w-full px-3 py-2 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[42px]">
                        <option value="">{{ __('All Shifts') }}</option>
                        <option value="1st Shift" {{ request('shift') == '1st Shift' ? 'selected' : '' }}>1st Shift</option>
                        <option value="2nd Shift" {{ request('shift') == '2nd Shift' ? 'selected' : '' }}>2nd Shift</option>
                        <option value="Overtime" {{ request('shift') == 'Overtime' ? 'selected' : '' }}>Overtime</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-6 py-2 bg-slate-900 text-white rounded-xl font-bold text-[10px] hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10 uppercase tracking-widest h-[42px]">
                        {{ __('Filter') }}
                    </button>
                    <a href="{{ route('attendance.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl font-bold text-[10px] hover:bg-slate-300 transition-all uppercase tracking-widest flex items-center h-[42px]">
                        {{ __('Clear') }}
                    </a>
                </div>
            </form>
        </div>

        <!-- Attendance List -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/30">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Date') }}</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Project') }}</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Worker') }}</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Supervisor') }}</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Shift') }}</th>
                            <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Status') }}</th>
                            <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('OT Hours') }}</th>
                            <th class="px-6 py-4 text-right text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Payment') }}</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Remark') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($attendances as $record)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900">
                                    {{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-600">
                                    {{ $record->project->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-slate-900">{{ $record->labour->name }}</div>
                                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $record->labour->work_type }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-slate-700">{{ $record->recorder->name ?? 'System' }}</div>
                                    @if($record->recorded_at)
                                        <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ $record->recorded_at->timezone('Asia/Kolkata')->format('h:i A') }} IST</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md text-[10px] font-bold uppercase tracking-widest">{{ $record->shift }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if(strtolower($record->status) == 'present')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wider">
                                            {{ __('Present') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-700 uppercase tracking-wider">
                                            {{ __($record->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-slate-700">
                                    {{ $record->overtime_hours ?? 0 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <span class="text-sm font-bold text-emerald-600">
                                        ₹{{ number_format($record->payment_amount ?? 0, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-500 min-w-[200px]">
                                    {{ $record->remark }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        <p class="font-medium">{{ __('No attendance records found.') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($attendances->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                    {{ $attendances->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Bulk Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="document.getElementById('deleteModal').classList.add('hidden')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200">
                <form action="{{ route('attendance.bulk-delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="bg-white px-6 pt-6 pb-4 sm:p-8 sm:pb-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-slate-900 uppercase tracking-tight" id="modal-title">
                                {{ __('Bulk Delete Attendance') }}
                            </h3>
                            <button type="button" onclick="document.getElementById('deleteModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-500 transition-colors">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div class="p-4 bg-rose-50 rounded-xl border border-rose-100">
                                <p class="text-xs font-bold text-rose-800 uppercase tracking-wider mb-1">{{ __('Warning') }}</p>
                                <p class="text-xs font-medium text-rose-700 leading-relaxed">
                                    {{ __('This action is permanent and cannot be undone. Please select the criteria carefully.') }}
                                </p>
                            </div>

                            <div>
                                <x-input-label for="del_project_id" :value="__('Project (Optional)')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2 ml-1" />
                                <select name="project_id" id="del_project_id" class="block w-full px-3 py-2 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900">
                                    <option value="">{{ __('All Projects') }}</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ (old('project_id') ?? request('project_id')) == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="del_type" :value="__('Delete Type')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2 ml-1" />
                                <select name="type" id="del_type" onchange="toggleDeleteInputs(this.value)" class="block w-full px-3 py-2 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900">
                                    <option value="day" {{ old('type') == 'day' ? 'selected' : '' }}>{{ __('Particular Day') }}</option>
                                    <option value="week" {{ old('type') == 'week' ? 'selected' : '' }}>{{ __('Particular Week') }}</option>
                                    <option value="month" {{ old('type') == 'month' ? 'selected' : '' }}>{{ __('Particular Month') }}</option>
                                </select>
                            </div>

                            <div id="del_day_input" class="{{ old('type', 'day') == 'day' ? '' : 'hidden' }}">
                                <x-input-label for="del_date" :value="__('Select Date')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2 ml-1" />
                                <x-text-input type="date" name="date" id="del_date" class="block w-full" :value="old('date')" />
                            </div>

                            <div id="del_week_input" class="{{ old('type') == 'week' ? '' : 'hidden' }}">
                                <x-input-label for="del_week" :value="__('Select Week')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2 ml-1" />
                                <x-text-input type="week" name="week" id="del_week" class="block w-full" :value="old('week')" />
                            </div>

                            <div id="del_month_input" class="{{ old('type') == 'month' ? '' : 'hidden' }} flex gap-4">
                                <div class="flex-1">
                                    <x-input-label for="del_month" :value="__('Month')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2 ml-1" />
                                    <select name="month" id="del_month" class="block w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-900">
                                        @for($m=1; $m<=12; $m++)
                                            <option value="{{ $m }}" {{ old('month', date('n')) == $m ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <x-input-label for="del_year" :value="__('Year')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2 ml-1" />
                                    <select name="year" id="del_year" class="block w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-900">
                                        @for($y=date('Y'); $y>=2020; $y--)
                                            <option value="{{ $y }}" {{ old('year', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-6 py-4 sm:px-8 sm:flex sm:flex-row-reverse gap-3">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete these records?')" class="w-full inline-flex justify-center items-center px-6 py-2.5 bg-rose-600 text-white rounded-xl font-bold text-xs hover:bg-rose-500 transition-all shadow-lg shadow-rose-600/20 uppercase tracking-widest sm:w-auto">
                            {{ __('Delete Records') }}
                        </button>
                        <button type="button" onclick="document.getElementById('deleteModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center items-center px-6 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold text-xs hover:bg-slate-50 transition-all sm:mt-0 sm:w-auto">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleDeleteInputs(type) {
            document.getElementById('del_day_input').classList.add('hidden');
            document.getElementById('del_week_input').classList.add('hidden');
            document.getElementById('del_month_input').classList.add('hidden');

            if (type === 'day') document.getElementById('del_day_input').classList.remove('hidden');
            else if (type === 'week') document.getElementById('del_week_input').classList.remove('hidden');
            else if (type === 'month') document.getElementById('del_month_input').classList.remove('hidden');
        }

        function toggleImportInputs(type) {
            document.getElementById('imp_day_input').classList.add('hidden');
            document.getElementById('imp_week_input').classList.add('hidden');
            document.getElementById('imp_month_input').classList.add('hidden');

            if (type === 'day') document.getElementById('imp_day_input').classList.remove('hidden');
            else if (type === 'week') document.getElementById('imp_week_input').classList.remove('hidden');
            else if (type === 'month') document.getElementById('imp_month_input').classList.remove('hidden');
        }

        @if($errors->hasAny(['type', 'date', 'week', 'month', 'year', 'project_id']))
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('deleteModal').classList.remove('hidden');
                toggleDeleteInputs('{{ old('type', 'day') }}');
            });
        @endif

        @if($errors->hasAny(['import_type', 'import_date', 'import_week', 'import_month', 'import_year', 'file']))
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('importModal').classList.remove('hidden');
                toggleImportInputs('{{ old('import_type', 'all') }}');
            });
        @endif
    </script>

    <!-- Import Modal -->
    <div id="importModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="document.getElementById('importModal').classList.add('hidden')"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200">
                <form action="{{ route('attendance.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white px-6 pt-6 pb-4 sm:p-8 sm:pb-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-slate-900 uppercase tracking-tight" id="modal-title">
                                {{ __('Import Attendance') }}
                            </h3>
                            <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-500 transition-colors">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div class="p-4 bg-amber-50 rounded-xl border border-amber-100">
                                <p class="text-xs font-bold text-amber-800 uppercase tracking-wider mb-1">{{ __('Instructions') }}</p>
                                <p class="text-xs font-medium text-amber-700 leading-relaxed">
                                    {{ __('Please use the standard export format for bulk uploads. Ensure Date, Labour ID, Project ID, and Status columns are correctly filled.') }}
                                </p>
                            </div>

                            <div>
                                <x-input-label for="import_type" :value="__('Import Restriction')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2 ml-1" />
                                <select name="import_type" id="import_type" onchange="toggleImportInputs(this.value)" class="block w-full px-3 py-2 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900">
                                    <option value="all" {{ old('import_type') == 'all' ? 'selected' : '' }}>{{ __('Import Everything in File') }}</option>
                                    <option value="day" {{ old('import_type') == 'day' ? 'selected' : '' }}>{{ __('Particular Day Only') }}</option>
                                    <option value="week" {{ old('import_type') == 'week' ? 'selected' : '' }}>{{ __('Particular Week Only') }}</option>
                                    <option value="month" {{ old('import_type') == 'month' ? 'selected' : '' }}>{{ __('Particular Month Only') }}</option>
                                </select>
                            </div>

                            <div id="imp_day_input" class="{{ old('import_type') == 'day' ? '' : 'hidden' }}">
                                <x-input-label for="import_date" :value="__('Select Date')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2 ml-1" />
                                <x-text-input type="date" name="import_date" id="import_date" class="block w-full" :value="old('import_date')" />
                            </div>

                            <div id="imp_week_input" class="{{ old('import_type') == 'week' ? '' : 'hidden' }}">
                                <x-input-label for="import_week" :value="__('Select Week')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2 ml-1" />
                                <x-text-input type="week" name="import_week" id="import_week" class="block w-full" :value="old('import_week')" />
                            </div>

                            <div id="imp_month_input" class="{{ old('import_type') == 'month' ? '' : 'hidden' }} flex gap-4">
                                <div class="flex-1">
                                    <x-input-label for="import_month" :value="__('Month')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2 ml-1" />
                                    <select name="import_month" id="import_month" class="block w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-900">
                                        @for($m=1; $m<=12; $m++)
                                            <option value="{{ $m }}" {{ old('import_month', date('n')) == $m ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <x-input-label for="import_year" :value="__('Year')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2 ml-1" />
                                    <select name="import_year" id="import_year" class="block w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-900">
                                        @for($y=date('Y'); $y>=2020; $y--)
                                            <option value="{{ $y }}" {{ old('import_year', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="file" :value="__('Select Excel/CSV File')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2 ml-1" />
                                <div class="relative">
                                    <input type="file" name="file" id="file" required
                                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all border border-slate-200 rounded-xl bg-slate-50 p-1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-6 py-4 sm:px-8 sm:flex sm:flex-row-reverse gap-3">
                        <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-xs hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 uppercase tracking-widest sm:w-auto">
                            {{ __('Start Import') }}
                        </button>
                        <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center items-center px-6 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold text-xs hover:bg-slate-50 transition-all sm:mt-0 sm:w-auto uppercase tracking-widest">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
