<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Add New Testimonial') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Create a new client review to showcase on your website.') }}
                </p>
            </div>
            <a href="{{ route('testimonials.index') }}" class="group relative px-6 py-3 bg-white text-slate-900 border border-slate-200 font-black uppercase tracking-widest text-[11px] rounded-xl hover:bg-slate-50 transition-all duration-300 shadow-sm">
                <span class="relative z-10 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    {{ __('Back to List') }}
                </span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="space-y-8">
                <div class="premium-card overflow-hidden">
                    <div class="p-8 border-b border-slate-100 bg-slate-50/30 flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-indigo-600 rounded-full"></div>
                        <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">Testimonial Details</h3>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="author" class="stat-label">Author Name</label>
                                <input 
                                    type="text" 
                                    id="author" 
                                    name="author" 
                                    value="{{ old('author') }}"
                                    class="input-premium"
                                    placeholder="e.g. Arjun Mehta"
                                    required
                                >
                                @error('author') <p class="text-xs font-bold text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="location" class="stat-label">Location / Role</label>
                                <input 
                                    type="text" 
                                    id="location" 
                                    name="location" 
                                    value="{{ old('location') }}"
                                    class="input-premium"
                                    placeholder="e.g. Homeowner, Mumbai"
                                >
                                @error('location') <p class="text-xs font-bold text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="quote" class="stat-label">Client Quote</label>
                            <textarea 
                                id="quote" 
                                name="quote" 
                                rows="5" 
                                class="input-premium"
                                placeholder="Enter the testimonial text here..."
                                required
                            >{{ old('quote') }}</textarea>
                            @error('quote') <p class="text-xs font-bold text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="stat-label">Author Image</label>
                            <div class="relative group/file">
                                <input 
                                    type="file" 
                                    name="image" 
                                    class="absolute inset-0 opacity-0 cursor-pointer z-10"
                                >
                                <div class="w-full px-5 py-4 bg-white border border-slate-200 rounded-xl flex items-center gap-3 group-hover/file:border-indigo-600 transition-all shadow-sm">
                                    <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                    </div>
                                    <span class="text-sm font-bold text-slate-500">Choose author photo or drag & drop</span>
                                </div>
                            </div>
                            @error('image') <p class="text-xs font-bold text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="order" class="stat-label">Display Order</label>
                                <input 
                                    type="number" 
                                    id="order" 
                                    name="order" 
                                    value="{{ old('order', 0) }}"
                                    class="input-premium"
                                >
                                @error('order') <p class="text-xs font-bold text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex items-center pt-8">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
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
                            {{ __('Save Testimonial') }}
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
