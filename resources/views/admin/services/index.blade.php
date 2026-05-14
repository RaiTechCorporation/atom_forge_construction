<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Services Management') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Manage the services displayed on the all services page.') }}
                </p>
            </div>
            <a href="{{ route('admin.services.create') }}" class="group relative px-6 py-3 bg-slate-900 text-white font-black uppercase tracking-widest text-[11px] rounded-xl hover:bg-orange-600 transition-all duration-300 shadow-xl shadow-slate-900/20 hover:shadow-orange-600/30">
                <span class="relative z-10 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('Add New Service') }}
                </span>
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if (session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3 animate-fade-in">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <div class="premium-card overflow-hidden">
            <div class="p-8 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-6 bg-orange-600 rounded-full"></div>
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">Services List</h3>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Service Info</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Details</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Order</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Status</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($services as $service)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-5">
                                        @if($service->image)
                                            <div class="relative w-16 h-16 rounded-2xl overflow-hidden border border-slate-200 shadow-sm flex-shrink-0 group-hover:scale-110 transition-transform duration-500">
                                                <img src="{{ $service->image }}" class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-300 border border-slate-200 shadow-sm flex-shrink-0">
                                                @if($service->icon)
                                                    <div class="w-8 h-8 flex items-center justify-center text-orange-600">
                                                        {!! $service->icon !!}
                                                    </div>
                                                @else
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                @endif
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-[10px] font-black uppercase tracking-[0.2em] text-orange-500 mb-1">{{ $service->subtitle ?? 'General' }}</div>
                                            <div class="text-base font-bold text-slate-900 tracking-tight">{{ $service->title ?? 'Untitled Service' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="max-w-md">
                                        <p class="text-sm text-slate-500 line-clamp-2 leading-relaxed font-medium">{{ $service->description }}</p>
                                        <div class="mt-3 flex flex-wrap gap-2">
                                            @if($service->button1_text)
                                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-slate-50 border border-slate-100 text-[10px] font-black text-slate-600 rounded-lg uppercase tracking-widest transition-all">
                                                    {{ $service->button1_text }}
                                                </div>
                                            @endif
                                            @if($service->button2_text)
                                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-slate-50 border border-slate-100 text-[10px] font-black text-slate-600 rounded-lg uppercase tracking-widest transition-all">
                                                    {{ $service->button2_text }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex items-center justify-center w-10 h-10 text-sm font-black text-slate-700 bg-white border border-slate-200 rounded-xl shadow-sm">{{ $service->order }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-wider {{ $service->is_active ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-50 text-slate-400 border border-slate-100' }}">
                                        <span class="w-2 h-2 rounded-full {{ $service->is_active ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]' : 'bg-slate-300' }}"></span>
                                        {{ $service->is_active ? 'Visible' : 'Hidden' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end items-center gap-3">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="p-2 text-slate-400 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-500">No services found</p>
                                        <a href="{{ route('admin.services.create') }}" class="text-xs font-black text-orange-600 uppercase tracking-widest hover:underline">Add your first service</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
