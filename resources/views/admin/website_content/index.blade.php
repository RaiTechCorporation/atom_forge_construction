<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Website Architecture') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Modify and update the core content modules of your public portal.') }}
                    @if($selectedGroup)
                        <span class="text-indigo-600 font-bold ml-1">/ {{ ucfirst($selectedGroup) }}</span>
                    @endif
                </p>
            </div>
            <div class="flex items-center bg-white px-4 py-2 rounded-lg border border-slate-200 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500 flex items-center gap-2">
                    <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
                    {{ __('CONTENT MANAGEMENT') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if (session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3 animate-fade-in">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('website-content.update-all') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <input type="hidden" name="group" value="{{ $selectedGroup }}">

            <div class="space-y-8">
                @foreach($contents as $group => $items)
                    <div class="premium-card overflow-hidden">
                        <div class="p-8 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-1.5 h-6 bg-indigo-600 rounded-full"></div>
                                <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">{{ ucfirst($group) }} Section</h3>
                            </div>
                        </div>
                        <div class="p-8 space-y-8">
                            @foreach($items as $item)
                                <div class="group/field">
                                    <label class="stat-label group-hover/field:text-indigo-600 transition-colors">{{ $item->label }}</label>
                                    
                                    @if($item->type === 'textarea')
                                        <textarea 
                                            name="contents[{{ $item->key }}]" 
                                            rows="5" 
                                            class="input-premium"
                                            placeholder="Enter {{ strtolower($item->label) }}..."
                                        >{{ old("contents.$item->key", $item->value) }}</textarea>
                                    @elseif($item->type === 'image')
                                        <div class="space-y-6 bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                                            <div class="flex flex-col lg:flex-row gap-8">
                                                @if($item->value)
                                                    <div class="relative w-full lg:w-48 h-48 rounded-2xl overflow-hidden border border-slate-200 bg-white flex-shrink-0 shadow-inner group/img">
                                                        <img src="{{ $item->value }}" class="w-full h-full object-contain p-4 group-hover/img:scale-110 transition-transform duration-500">
                                                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover/img:opacity-100 transition-opacity pointer-events-none"></div>
                                                    </div>
                                                @endif
                                                <div class="flex-grow grid grid-cols-1 gap-6">
                                                    <div>
                                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Upload New Asset</label>
                                                        <div class="relative group/file">
                                                            <input 
                                                                type="file" 
                                                                name="files[{{ $item->key }}]" 
                                                                class="absolute inset-0 opacity-0 cursor-pointer z-10"
                                                            >
                                                            <div class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl flex items-center gap-3 group-hover/file:border-indigo-600 transition-all">
                                                                <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                                                </div>
                                                                <span class="text-xs font-bold text-slate-500">Choose file or drag & drop</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">External Asset URL</label>
                                                        <input 
                                                            type="text" 
                                                            name="contents[{{ $item->key }}]" 
                                                            value="{{ old("contents.$item->key", $item->value) }}"
                                                            placeholder="https://..."
                                                            class="input-premium !py-2.5"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-[10px] text-slate-400 font-bold flex items-center gap-2">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                                RECOMMENDED: TRANSPARENT PNG / WEB-OPTIMIZED ASSETS (MAX 2MB)
                                            </p>
                                        </div>
                                    @elseif($item->type === 'number')
                                        <input 
                                            type="number" 
                                            name="contents[{{ $item->key }}]" 
                                            value="{{ old("contents.$item->key", $item->value) }}"
                                            class="input-premium"
                                        >
                                    @else
                                        <input 
                                            type="text" 
                                            name="contents[{{ $item->key }}]" 
                                            value="{{ old("contents.$item->key", $item->value) }}"
                                            class="input-premium"
                                            placeholder="Enter {{ strtolower($item->label) }}..."
                                        >
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                @if($contents->isNotEmpty())
                    <div class="flex justify-end pt-4 pb-12">
                        <button type="submit" class="group relative px-12 py-4 bg-slate-900 text-white font-black uppercase tracking-widest text-[11px] rounded-2xl hover:bg-indigo-600 transition-all duration-300 shadow-2xl shadow-slate-900/20 hover:shadow-indigo-600/30">
                            <span class="relative z-10 flex items-center gap-3">
                                {{ __('Deploy Updates') }}
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </button>
                    </div>
                @endif
            </div>
        </form>
    </div>
</x-app-layout>
