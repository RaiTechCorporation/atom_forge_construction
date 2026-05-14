<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('FAQ Management') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Manage frequently asked questions displayed on your website.') }}
                </p>
            </div>
            <a href="{{ route('faqs.create') }}" class="group relative px-6 py-3 bg-slate-900 text-white font-black uppercase tracking-widest text-[11px] rounded-xl hover:bg-indigo-600 transition-all duration-300 shadow-xl shadow-slate-900/20 hover:shadow-indigo-600/30">
                <span class="relative z-10 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('Add FAQ') }}
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

        @if($sectionSettings->isNotEmpty())
            <div class="premium-card overflow-hidden">
                <div class="p-8 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-indigo-600 rounded-full"></div>
                        <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">FAQ Page Header Settings</h3>
                    </div>
                </div>
                <div class="p-8">
                    <form action="{{ route('website-content.update-all') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="group" value="faq">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($sectionSettings as $item)
                                <div class="space-y-2 {{ $item->type === 'textarea' ? 'md:col-span-2' : '' }}">
                                    <label class="stat-label">{{ $item->label }}</label>
                                    @if($item->type === 'textarea')
                                        <textarea name="contents[{{ $item->key }}]" rows="3" class="input-premium">{{ old("contents.$item->key", $item->value) }}</textarea>
                                    @else
                                        <input type="text" name="contents[{{ $item->key }}]" value="{{ old("contents.$item->key", $item->value) }}" class="input-premium">
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="group relative px-8 py-3 bg-slate-900 text-white font-black uppercase tracking-widest text-[10px] rounded-xl hover:bg-indigo-600 transition-all duration-300 shadow-lg shadow-slate-900/20 hover:shadow-indigo-600/30">
                                <span class="relative z-10 flex items-center gap-2">
                                    {{ __('Update Header') }}
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <div class="premium-card overflow-hidden">
            <div class="p-8 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-6 bg-indigo-600 rounded-full"></div>
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">FAQs List</h3>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Order</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Question</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Status</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($faqs as $faq)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-6 text-sm font-bold text-slate-900">
                                    {{ $faq->order }}
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-bold text-slate-900">{{ $faq->question }}</div>
                                    <div class="text-xs font-medium text-slate-500 mt-1 line-clamp-2">{{ $faq->answer }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $faq->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $faq->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                        {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-end items-center gap-3">
                                        <a href="{{ route('faqs.edit', $faq) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this FAQ?')">
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
                                <td colspan="4" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-500">No FAQs found</p>
                                        <a href="{{ route('faqs.create') }}" class="text-xs font-black text-indigo-600 uppercase tracking-widest hover:underline">Add your first FAQ</a>
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
