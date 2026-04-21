<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Website Content') }} 
            @if($selectedGroup)
                <span class="text-blue-600">/ {{ ucfirst($selectedGroup) }}</span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('website-content.update-all') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <input type="hidden" name="group" value="{{ $selectedGroup }}">

                <div class="space-y-8">
                    @foreach($contents as $group => $items)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-100">
                            <div class="p-8 border-b border-slate-100 bg-slate-50/50">
                                <h3 class="text-lg font-extrabold text-slate-900 uppercase tracking-wider">{{ ucfirst($group) }} Section</h3>
                            </div>
                            <div class="p-8 space-y-6">
                                @foreach($items as $item)
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2">{{ $item->label }}</label>
                                        
                                        @if($item->type === 'textarea')
                                            <textarea 
                                                name="contents[{{ $item->key }}]" 
                                                rows="6" 
                                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium text-slate-600"
                                            >{{ old("contents.$item->key", $item->value) }}</textarea>
                                        @elseif($item->type === 'image')
                                            <div class="space-y-4">
                                                <div class="flex flex-col md:flex-row gap-6">
                                                    @if($item->value)
                                                        <div class="relative w-48 h-48 rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 flex-shrink-0">
                                                            <img src="{{ $item->value }}" class="w-full h-full object-contain">
                                                        </div>
                                                    @endif
                                                    <div class="flex-grow space-y-4">
                                                        <div>
                                                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Upload New Image</label>
                                                            <input 
                                                                type="file" 
                                                                name="files[{{ $item->key }}]" 
                                                                class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all"
                                                            >
                                                        </div>
                                                        <div>
                                                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Or Image URL</label>
                                                            <input 
                                                                type="text" 
                                                                name="contents[{{ $item->key }}]" 
                                                                value="{{ old("contents.$item->key", $item->value) }}"
                                                                placeholder="https://..."
                                                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium text-slate-600"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-xs text-slate-400 font-medium">Recommended: Transparent PNG for logo. Max 2MB.</p>
                                            </div>
                                        @elseif($item->type === 'number')
                                            <input 
                                                type="number" 
                                                name="contents[{{ $item->key }}]" 
                                                value="{{ old("contents.$item->key", $item->value) }}"
                                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium text-slate-600"
                                            >
                                        @else
                                            <input 
                                                type="text" 
                                                name="contents[{{ $item->key }}]" 
                                                value="{{ old("contents.$item->key", $item->value) }}"
                                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 transition-all font-medium text-slate-600"
                                            >
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    @if($contents->isNotEmpty())
                        <div class="flex justify-end">
                            <button type="submit" class="px-10 py-4 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 transition-all shadow-xl shadow-blue-500/25">
                                Save Changes
                            </button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
