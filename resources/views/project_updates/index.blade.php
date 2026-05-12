<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Project Updates') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Monitor progress updates and milestones for all projects.') }}
                </p>
            </div>
            @can('upload-media')
                <a href="{{ route('project-updates.create') }}" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20 text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    New Update
                </a>
            @endcan
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

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Date</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Project</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Description</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Progress</th>
                            <th class="px-6 py-4 text-right text-[10px] font-bold text-slate-500 uppercase tracking-widest">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($updates as $update)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-6 text-sm font-semibold text-slate-700">
                                    {{ $update->date->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex flex-col">
                                        @if($update->project)
                                            <a href="{{ route('projects.show', $update->project) }}" class="text-sm font-bold text-slate-900 hover:text-indigo-600 transition-colors">
                                                {{ $update->project->name }}
                                            </a>
                                        @else
                                            <span class="text-sm font-bold text-slate-400">Project Deleted</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-sm text-slate-600 max-w-xs truncate">
                                    {{ $update->description }}
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-1 h-2 bg-slate-100 rounded-full overflow-hidden min-w-[100px]">
                                            <div class="h-full bg-indigo-600 rounded-full" style="width: {{ $update->progress_percent }}%"></div>
                                        </div>
                                        <span class="text-xs font-bold text-slate-700">{{ $update->progress_percent }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        @can('delete-media')
                                            <form action="{{ route('project-updates.destroy', $update) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this update?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete Update">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-base font-bold text-slate-900">No Updates Found</p>
                                            <p class="text-slate-500 text-sm font-medium">No project updates have been recorded yet.</p>
                                        </div>
                                        @can('upload-media')
                                            <a href="{{ route('project-updates.create') }}" class="mt-2 inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-500 transition-all text-sm">
                                                Record First Update
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($updates->hasPages())
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                    {{ $updates->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
