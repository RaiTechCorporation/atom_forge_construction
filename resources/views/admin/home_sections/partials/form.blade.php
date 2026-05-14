<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="space-y-6">
        <div class="space-y-2">
            <label for="title" class="stat-label">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $homeSection->title ?? '') }}" class="input-premium" placeholder="e.g., Innovative Solutions">
        </div>

        <div class="space-y-2">
            <label for="subtitle" class="stat-label">Subtitle</label>
            <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $homeSection->subtitle ?? '') }}" class="input-premium" placeholder="e.g., Professional Team">
        </div>

        <div class="space-y-2">
            <label for="description" class="stat-label">Description</label>
            <textarea name="description" id="description" rows="4" class="input-premium" placeholder="Brief description of the section...">{{ old('description', $homeSection->description ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="order" class="stat-label">Display Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', $homeSection->order ?? 0) }}" class="input-premium">
            </div>
            <div class="space-y-2">
                <label for="icon" class="stat-label">Icon (FontAwesome)</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $homeSection->icon ?? '') }}" class="input-premium" placeholder="e.g., globe, award, building">
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="space-y-2">
            <label class="stat-label">Section Image</label>
            <div class="space-y-4">
                @if(isset($homeSection) && $homeSection->image)
                    <div class="relative w-full h-48 rounded-2xl overflow-hidden border border-slate-200 shadow-inner group">
                        <img src="{{ $homeSection->image }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="text-white text-xs font-bold uppercase tracking-widest">Update Image</span>
                        </div>
                    </div>
                @endif
                <div class="relative group/file">
                    <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    <div class="w-full px-5 py-4 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex items-center gap-4 group-hover/file:border-indigo-600 transition-all">
                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-hover/file:text-indigo-600 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-700 uppercase tracking-widest">Select Image</span>
                            <span class="block text-[10px] text-slate-400 font-medium">PNG, JPG, WEBP (Max 2MB)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="button_text" class="stat-label">Button Text</label>
                <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $homeSection->button_text ?? '') }}" class="input-premium" placeholder="e.g., Explore More">
            </div>
            <div class="space-y-2">
                <label for="button_url" class="stat-label">Button URL</label>
                <input type="text" name="button_url" id="button_url" value="{{ old('button_url', $homeSection->button_url ?? '') }}" class="input-premium" placeholder="e.g., /projects">
            </div>
        </div>

        <div class="flex items-center gap-3 pt-4">
            <div class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2" 
                 x-data="{ active: {{ old('is_active', $homeSection->is_active ?? true) ? 'true' : 'false' }} }"
                 :class="active ? 'bg-indigo-600' : 'bg-slate-200'"
                 @click="active = !active; $refs.activeInput.click()">
                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                      :class="active ? 'translate-x-5' : 'translate-x-0'"></span>
                <input type="checkbox" name="is_active" x-ref="activeInput" class="hidden" :checked="active">
            </div>
            <span class="text-xs font-bold text-slate-600 uppercase tracking-widest">Section Active Status</span>
        </div>
    </div>
</div>
