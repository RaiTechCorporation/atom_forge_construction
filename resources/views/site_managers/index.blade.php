<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Site Managers') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Manage your site management personnel and their assignments.') }}
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <a href="{{ route('site-managers.export') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold rounded-xl transition-all shadow-sm text-xs">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export
                </a>
                <button type="button" onclick="document.getElementById('import-form-container').classList.toggle('hidden')" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold rounded-xl transition-all shadow-sm text-xs">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    Import
                </button>
                <a href="{{ route('site-managers.attendance') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-emerald-600/20 text-xs">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    Manager Attendance
                </a>
                <a href="{{ route('site-managers.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20 text-xs">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add Site Manager
                </a>
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

        <!-- Import Form -->
        <div id="import-form-container" class="hidden bg-white p-6 rounded-2xl border border-slate-200 shadow-sm animate-fade-in">
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-4">Import Site Manager Data</h3>
            <form action="{{ route('site-managers.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-4">
                @csrf
                <div class="flex-1">
                    <input type="file" name="file" accept=".xlsx,.xls,.csv" required class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all cursor-pointer">
                </div>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-bold rounded-xl text-xs uppercase tracking-widest hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20">
                    Upload & Import
                </button>
            </form>
            <p class="mt-2 text-[10px] text-slate-400 font-bold uppercase tracking-widest italic">Supported formats: XLSX, XLS, CSV. Ensure headers match the export format.</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Manager Identity</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Contact Info</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Assigned Project</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Salary/Wage</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Status</th>
                            <th class="px-6 py-4 text-right text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($managers as $manager)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-bold uppercase text-base border border-indigo-100 shrink-0">
                                            @if($manager->photo_path)
                                                <img src="{{ asset('storage/' . $manager->photo_path) }}" alt="{{ $manager->name }}" class="w-full h-full object-cover rounded-xl">
                                            @else
                                                {{ substr($manager->name, 0, 1) }}
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <a href="{{ route('site-managers.show', $manager) }}" class="text-sm font-black text-slate-900 tracking-tight hover:text-indigo-600 transition-colors">{{ $manager->name }}</a>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $manager->manager_unique_id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-xs font-semibold text-slate-500">
                                    <div class="flex flex-col gap-1">
                                        <span class="font-bold text-slate-700">{{ $manager->phone ?? 'No Phone' }}</span>
                                        <span class="text-[10px] text-slate-400 font-bold lowercase tracking-tight">{{ $manager->email ?? 'no email' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    @if($manager->project)
                                        <span class="inline-flex w-fit px-2.5 py-0.5 bg-indigo-50 text-indigo-700 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                            {{ $manager->project->name }}
                                        </span>
                                    @else
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">Unassigned</span>
                                    @endif
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-slate-900 tracking-tight">₹{{ number_format($manager->salary_amount, 2) }}</span>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">/ {{ $manager->salary_type }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="px-2 py-1 {{ $manager->status === 'Active' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }} text-[9px] font-black uppercase tracking-widest rounded-full">
                                        {{ $manager->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-6 text-right whitespace-nowrap">
                                    <div class="flex justify-end items-center gap-2">
                                        <a href="{{ route('site-managers.show', $manager) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="View Profile">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        <a href="{{ route('site-managers.edit', $manager) }}" class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all" title="Edit Manager">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('site-managers.destroy', $manager) }}" method="POST" class="inline-block" onsubmit="return confirm('Archive this site manager record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete Manager">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-base font-bold text-slate-900">No Site Managers Found</p>
                                            <p class="text-slate-500 text-sm font-medium">Get started by registering your first site manager.</p>
                                        </div>
                                        <a href="{{ route('site-managers.create') }}" class="mt-2 inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-500 transition-all text-sm">
                                            Register Manager
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($managers->hasPages())
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                    {{ $managers->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
