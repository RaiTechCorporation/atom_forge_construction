<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Site Manager Attendance Records') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('View and manage historical attendance data for site supervisors.') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('site-managers.attendance') }}" 
                    class="inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-xs hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('Mark New Attendance') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Filters -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
            <form action="{{ route('site-managers.attendance-records') }}" method="GET" class="flex flex-wrap items-end gap-6">
                <div class="flex-1 min-w-[200px]">
                    <x-input-label for="site_manager_id" :value="__('Site Manager')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <select name="site_manager_id" class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[46px]">
                        <option value="">{{ __('All Managers') }}</option>
                        @foreach($siteManagers as $manager)
                            <option value="{{ $manager->id }}" {{ request('site_manager_id') == $manager->id ? 'selected' : '' }}>
                                {{ $manager->name }} ({{ $manager->manager_unique_id }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <x-input-label for="project_id" :value="__('Project')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <select name="project_id" class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[46px]">
                        <option value="">{{ __('All Projects') }}</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-44">
                    <x-input-label for="date" :value="__('Date')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input name="date" type="date" class="block w-full px-4 py-2 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900" :value="request('date')" />
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-8 py-2.5 bg-slate-900 text-white rounded-xl font-bold text-xs hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10 uppercase tracking-widest">
                        {{ __('Filter') }}
                    </button>
                    <a href="{{ route('site-managers.attendance-records') }}" class="px-6 py-2.5 bg-slate-200 text-slate-700 rounded-xl font-bold text-xs hover:bg-slate-300 transition-all uppercase tracking-widest flex items-center">
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
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Site Manager') }}</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Recorded By') }}</th>
                            <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Status') }}</th>
                            <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('OT Hours') }}</th>
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
                                    {{ $record->project->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-slate-900">{{ $record->siteManager->name }}</div>
                                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $record->siteManager->manager_unique_id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-slate-700">{{ $record->recorder->name ?? 'System' }}</div>
                                    @if($record->recorded_at)
                                        <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ \Carbon\Carbon::parse($record->recorded_at)->timezone('Asia/Kolkata')->format('h:i A') }} IST</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($record->status == 'Present')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wider">
                                            {{ __('Present') }}
                                        </span>
                                    @elseif($record->status == 'Half Day')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 uppercase tracking-wider">
                                            {{ __('Half Day') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-700 uppercase tracking-wider">
                                            {{ __('Absent') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-slate-700">
                                    {{ $record->overtime_hours ?? 0 }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-500 min-w-[200px]">
                                    {{ $record->remarks }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-slate-500">
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
</x-app-layout>
