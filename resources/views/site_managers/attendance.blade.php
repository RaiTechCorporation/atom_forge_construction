<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ auth()->user()->isSiteSupervisor() ? __('My Attendance') : __('Site Manager Attendance') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ auth()->user()->isSiteSupervisor() ? __('View your daily attendance and overtime records.') : __('Record daily attendance and overtime for site management staff.') }}
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                @unless(auth()->user()->isSiteSupervisor())
                <a href="{{ route('site-managers.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition-all text-xs">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Directory
                </a>
                @endunless
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

        <!-- Filters Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <form action="{{ route('site-managers.attendance') }}" method="GET" class="grid grid-cols-1 {{ !auth()->user()->isSiteSupervisor() ? 'md:grid-cols-3' : 'md:grid-cols-2' }} gap-6 items-end">
                <div>
                    <x-input-label for="date" :value="__('Select Date')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="date" name="date" type="date" class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl" :value="$date" onchange="this.form.submit()" />
                </div>
                @unless(auth()->user()->isSiteSupervisor())
                <div>
                    <x-input-label for="project_id" :value="__('Filter by Project')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <select id="project_id" name="project_id" class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-slate-900 font-semibold" onchange="this.form.submit()">
                        <option value="">All Projects</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $projectId == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endunless
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 px-4 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-500 transition-all text-sm">
                        Refresh List
                    </button>
                </div>
            </form>
        </div>

        <!-- Attendance Form -->
        <form action="{{ route('site-managers.attendance.store') }}" method="POST">
            @csrf
            <input type="hidden" name="date" value="{{ $date }}">
            
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ auth()->user()->isSiteSupervisor() ? 'Supervisor' : 'Manager' }}</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Attendance Status</th>
                                @unless(auth()->user()->isSiteSupervisor())
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Summary (Month)</th>
                                @endunless
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">OT Hours</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Remarks/Notes</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($managers as $manager)
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-bold uppercase text-base shrink-0">
                                                {{ substr($manager->name, 0, 1) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-sm font-black text-slate-900 tracking-tight">{{ $manager->name }}</span>
                                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $manager->project->name ?? 'Unassigned' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        @php 
                                            $status = $attendances[$manager->id]->status ?? 'Pending'; 
                                            $statusClasses = [
                                                'Present' => 'bg-emerald-500 text-white',
                                                'Absent' => 'bg-rose-500 text-white',
                                                'Leave' => 'bg-amber-500 text-white',
                                                'Half Day' => 'bg-indigo-500 text-white',
                                                'Pending' => 'bg-slate-200 text-slate-600'
                                            ];
                                        @endphp

                                        @unless(auth()->user()->isSiteSupervisor())
                                        <div class="flex gap-2">
                                            <label class="cursor-pointer">
                                                <input type="radio" name="attendance[{{ $manager->id }}][status]" value="Present" class="hidden peer" {{ $status == 'Present' ? 'checked' : '' }}>
                                                <span class="px-3 py-1.5 rounded-lg border border-slate-200 text-[10px] font-bold uppercase tracking-wider peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 transition-all">Present</span>
                                            </label>
                                            <label class="cursor-pointer">
                                                <input type="radio" name="attendance[{{ $manager->id }}][status]" value="Absent" class="hidden peer" {{ $status == 'Absent' ? 'checked' : '' }}>
                                                <span class="px-3 py-1.5 rounded-lg border border-slate-200 text-[10px] font-bold uppercase tracking-wider peer-checked:bg-rose-500 peer-checked:text-white peer-checked:border-rose-500 transition-all">Absent</span>
                                            </label>
                                            <label class="cursor-pointer">
                                                <input type="radio" name="attendance[{{ $manager->id }}][status]" value="Leave" class="hidden peer" {{ $status == 'Leave' ? 'checked' : '' }}>
                                                <span class="px-3 py-1.5 rounded-lg border border-slate-200 text-[10px] font-bold uppercase tracking-wider peer-checked:bg-amber-500 peer-checked:text-white peer-checked:border-amber-500 transition-all">Leave</span>
                                            </label>
                                            <label class="cursor-pointer">
                                                <input type="radio" name="attendance[{{ $manager->id }}][status]" value="Half Day" class="hidden peer" {{ $status == 'Half Day' ? 'checked' : '' }}>
                                                <span class="px-3 py-1.5 rounded-lg border border-slate-200 text-[10px] font-bold uppercase tracking-wider peer-checked:bg-indigo-500 peer-checked:text-white peer-checked:border-indigo-500 transition-all">Half Day</span>
                                            </label>
                                        </div>
                                        @else
                                            <span class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest {{ $statusClasses[$status] ?? $statusClasses['Pending'] }}">
                                                {{ $status }}
                                            </span>
                                        @endunless
                                    </td>
                                    @unless(auth()->user()->isSiteSupervisor())
                                    <td class="px-6 py-6">
                                        <div class="flex flex-col gap-1">
                                            @php $summary = $attendanceSummaries[$manager->id] ?? null; @endphp
                                            @if($summary)
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tight">Pres: <span class="text-emerald-600">{{ $summary['total_present'] }}</span></span>
                                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tight">Abs: <span class="text-rose-600">{{ $summary['total_absent'] }}</span></span>
                                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tight">Half: <span class="text-indigo-600">{{ $summary['total_half_day'] }}</span></span>
                                                </div>
                                                <div class="w-full bg-slate-100 h-1 rounded-full overflow-hidden mt-1">
                                                    <div class="bg-indigo-500 h-full" style="width: {{ $summary['attendance_percentage'] }}%"></div>
                                                </div>
                                                <span class="text-[9px] font-black text-indigo-600 mt-0.5">{{ $summary['attendance_percentage'] }}% Attendance</span>
                                            @endif
                                        </div>
                                    </td>
                                    @endunless
                                    <td class="px-6 py-6">
                                        <input type="number" step="0.5" name="attendance[{{ $manager->id }}][overtime_hours]" value="{{ $attendances[$manager->id]->overtime_hours ?? 0 }}" {{ !auth()->user()->isSiteSupervisor() ? '' : 'readonly' }} class="w-20 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 transition-all">
                                    </td>
                                    <td class="px-6 py-6">
                                        <input type="text" name="attendance[{{ $manager->id }}][remarks]" value="{{ $attendances[$manager->id]->remarks ?? '' }}" placeholder="Notes..." {{ !auth()->user()->isSiteSupervisor() ? '' : 'readonly' }} class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 transition-all">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-20 text-center">
                                        <p class="text-slate-500 font-bold uppercase text-xs tracking-widest">No active site managers found for the selected criteria.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($managers->isNotEmpty() && !auth()->user()->isSiteSupervisor())
                    <div class="px-6 py-6 bg-slate-50 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-black uppercase tracking-widest text-[10px] rounded-xl hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20">
                            Save Attendance Record
                        </button>
                    </div>
                @endif
            </div>
        </form>
    </div>
</x-app-layout>
