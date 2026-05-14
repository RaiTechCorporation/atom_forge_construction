<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="space-y-6">
        <div class="space-y-2">
            <label for="title" class="stat-label">Service Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $service->title ?? '') }}" class="input-premium" placeholder="e.g., Residential Construction" required>
        </div>

        <div class="space-y-2">
            <label for="subtitle" class="stat-label">Subtitle</label>
            <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $service->subtitle ?? '') }}" class="input-premium" placeholder="e.g., Building Your Dreams">
        </div>

        <div class="space-y-2">
            <label for="description" class="stat-label">Description</label>
            <textarea name="description" id="description" rows="4" class="input-premium" placeholder="Detailed description of the service...">{{ old('description', $service->description ?? '') }}</textarea>
        </div>

        <div class="space-y-4">
            <label class="stat-label flex items-center justify-between">
                <span>Key Features</span>
                <button type="button" onclick="addFeature()" class="text-[10px] font-black text-orange-600 uppercase tracking-widest hover:underline">Add Feature</button>
            </label>
            <div id="features-container" class="space-y-3">
                @php
                    $features = old('features', $service->features ?? ['']);
                    if (empty($features)) $features = [''];
                @endphp
                @foreach($features as $index => $feature)
                    <div class="flex items-center gap-3 feature-item">
                        <input type="text" name="features[]" value="{{ $feature }}" class="input-premium" placeholder="e.g., Foundation and Structure">
                        <button type="button" onclick="this.parentElement.remove()" class="p-2 text-slate-400 hover:text-rose-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="order" class="stat-label">Display Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', $service->order ?? 0) }}" class="input-premium">
            </div>
            <div class="space-y-2">
                <label for="icon" class="stat-label">Icon (SVG HTML)</label>
                <textarea name="icon" id="icon" rows="2" class="input-premium" placeholder='e.g., <svg>...</svg>'>{{ old('icon', $service->icon ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="space-y-2">
            <label class="stat-label">Service Image</label>
            <div class="space-y-4">
                @if(isset($service) && $service->image)
                    <div class="relative w-full h-48 rounded-2xl overflow-hidden border border-slate-200 shadow-inner group">
                        <img src="{{ $service->image }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="text-white text-xs font-bold uppercase tracking-widest">Update Image</span>
                        </div>
                    </div>
                @endif
                <div class="relative group/file">
                    <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    <div class="w-full px-5 py-4 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex items-center gap-4 group-hover/file:border-orange-600 transition-all">
                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-hover/file:text-orange-600 shadow-sm">
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
                <label for="button1_text" class="stat-label">Button 1 Text</label>
                <input type="text" name="button1_text" id="button1_text" value="{{ old('button1_text', $service->button1_text ?? '') }}" class="input-premium" placeholder="e.g., Request Quote">
            </div>
            <div class="space-y-2">
                <label for="button1_link" class="stat-label">Button 1 Link</label>
                <input type="text" name="button1_link" id="button1_link" value="{{ old('button1_link', $service->button1_link ?? '') }}" class="input-premium" placeholder="e.g., contact or /services/res">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="button2_text" class="stat-label">Button 2 Text</label>
                <input type="text" name="button2_text" id="button2_text" value="{{ old('button2_text', $service->button2_text ?? '') }}" class="input-premium" placeholder="e.g., Learn More">
            </div>
            <div class="space-y-2">
                <label for="button2_link" class="stat-label">Button 2 Link</label>
                <input type="text" name="button2_link" id="button2_link" value="{{ old('button2_link', $service->button2_link ?? '') }}" class="input-premium" placeholder="e.g., services.commercial">
            </div>
        </div>

        <div class="flex items-center gap-3 pt-4">
            <div class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:ring-offset-2" 
                 x-data="{ active: {{ old('is_active', $service->is_active ?? true) ? 'true' : 'false' }} }"
                 :class="active ? 'bg-orange-600' : 'bg-slate-200'"
                 @click="active = !active; $refs.activeInput.click()">
                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                      :class="active ? 'translate-x-5' : 'translate-x-0'"></span>
                <input type="checkbox" name="is_active" x-ref="activeInput" class="hidden" :checked="active">
            </div>
            <span class="text-xs font-bold text-slate-600 uppercase tracking-widest">Service Active Status</span>
        </div>
    </div>
</div>

<script>
    function addFeature() {
        const container = document.getElementById('features-container');
        const div = document.createElement('div');
        div.className = 'flex items-center gap-3 feature-item';
        div.innerHTML = `
            <input type="text" name="features[]" class="input-premium" placeholder="e.g., Foundation and Structure">
            <button type="button" onclick="this.parentElement.remove()" class="p-2 text-slate-400 hover:text-rose-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        `;
        container.appendChild(div);
    }
</script>
