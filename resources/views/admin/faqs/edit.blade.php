<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Edit FAQ') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Update the frequently asked question details.') }}
                </p>
            </div>
            <a href="{{ route('faqs.index') }}" class="group relative px-6 py-3 bg-white text-slate-900 border border-slate-200 font-black uppercase tracking-widest text-[11px] rounded-xl hover:bg-slate-50 transition-all duration-300 shadow-sm">
                <span class="relative z-10 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    {{ __('Back to List') }}
                </span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('faqs.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-8">
                <div class="premium-card overflow-hidden">
                    <div class="p-8 border-b border-slate-100 bg-slate-50/30 flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-indigo-600 rounded-full"></div>
                        <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">FAQ Details</h3>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        <div class="space-y-2">
                            <label for="question" class="stat-label">Question</label>
                            <input 
                                type="text" 
                                id="question" 
                                name="question" 
                                value="{{ old('question', $faq->question) }}"
                                class="input-premium"
                                placeholder="e.g. What types of projects do you handle?"
                                required
                            >
                            @error('question') <p class="text-xs font-bold text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="answer" class="stat-label">Answer</label>
                            <textarea 
                                id="answer" 
                                name="answer" 
                                rows="5" 
                                class="input-premium"
                                placeholder="Enter the answer text here..."
                                required
                            >{{ old('answer', $faq->answer) }}</textarea>
                            @error('answer') <p class="text-xs font-bold text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="order" class="stat-label">Display Order</label>
                                <input 
                                    type="number" 
                                    id="order" 
                                    name="order" 
                                    value="{{ old('order', $faq->order) }}"
                                    class="input-premium"
                                >
                                @error('order') <p class="text-xs font-bold text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex items-center pt-8">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $faq->is_active ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                    <span class="ml-3 text-sm font-black text-slate-900 uppercase tracking-wider">Active</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4 pb-12">
                    <button type="submit" class="group relative px-12 py-4 bg-slate-900 text-white font-black uppercase tracking-widest text-[11px] rounded-2xl hover:bg-indigo-600 transition-all duration-300 shadow-2xl shadow-slate-900/20 hover:shadow-indigo-600/30">
                        <span class="relative z-10 flex items-center gap-3">
                            {{ __('Update FAQ') }}
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
