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

        <!-- Attendance Filter -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
            <form action="{{ route('attendance.create') }}" method="GET" class="flex flex-wrap items-end gap-6">
                <div class="flex-1 min-w-[250px]">
                    <x-input-label for="project_id" :value="__('Select Project')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative">
                        <select id="project_id" name="project_id" 
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
                <div class="w-full md:w-48">
                    <x-input-label for="date" :value="__('Attendance Date')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="date" name="date" type="date" 
                        class="mt-0 block w-full px-4 py-2 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900" 
                        :value="$date" required />
                </div>
                <button type="submit" 
                    class="w-full md:w-auto px-8 py-2.5 bg-slate-900 text-white rounded-xl font-bold text-xs hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10 uppercase tracking-widest">
                    {{ __('Load Workforce') }}
                </button>
            </form>
        </div>

        @if($selectedProjectId)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-slate-50/50 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">
                        {{ __('Marking for:') }} <span class="text-indigo-600 ml-1">{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</span>
                    </h3>
                    <div class="flex items-center gap-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                        <span class="flex items-center gap-2 px-3 py-1 bg-white border border-slate-200 rounded-lg"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span> {{ __('PRESENT') }}</span>
                        <span class="flex items-center gap-2 px-3 py-1 bg-white border border-slate-200 rounded-lg"><span class="w-2 h-2 bg-rose-500 rounded-full"></span> {{ __('ABSENT') }}</span>
                    </div>
                </div>
                
                <form action="{{ route('attendance.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $selectedProjectId }}">
                    <input type="hidden" name="date" value="{{ $date }}">

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50/30">
                                <tr>
                                    <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">{{ __('Worker Identity') }}</th>
                                    <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">{{ __('Category') }}</th>
                                    <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-500 uppercase tracking-widest w-32">{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @foreach($labours as $worker)
                                    <tr class="hover:bg-slate-50/50 transition-colors group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-slate-900 tracking-tight">{{ $worker->name }}</div>
                                            <div class="text-[9px] font-bold text-slate-400 mt-0.5 tracking-widest uppercase">ID: {{ str_pad($worker->id, 5, '0', STR_PAD_LEFT) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md text-[10px] font-bold uppercase tracking-widest">{{ $worker->work_type }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-3">
                                                <label class="cursor-pointer group/radio">
                                                    <input type="radio" name="attendance[{{ $worker->id }}]" value="present" 
                                                        {{ (isset($existingAttendance[$worker->id]) && $existingAttendance[$worker->id] == 'present') ? 'checked' : '' }}
                                                        class="hidden peer" required>
                                                    <div class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 bg-slate-50 peer-checked:bg-emerald-500 peer-checked:border-emerald-600 peer-checked:text-white text-slate-400 transition-all hover:border-emerald-200">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                    </div>
                                                </label>
                                                <label class="cursor-pointer group/radio">
                                                    <input type="radio" name="attendance[{{ $worker->id }}]" value="absent" 
                                                        {{ (isset($existingAttendance[$worker->id]) && $existingAttendance[$worker->id] == 'absent') ? 'checked' : '' }}
                                                        class="hidden peer" required>
                                                    <div class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 bg-slate-50 peer-checked:bg-rose-500 peer-checked:border-rose-600 peer-checked:text-white text-slate-400 transition-all hover:border-rose-200">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </div>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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
</x-app-layout>
