<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Create New Blog Post') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- AI Generator Tool -->
        <div class="bg-indigo-50 border border-indigo-100 rounded-lg p-6 shadow-sm">
            <h3 class="text-lg font-medium text-indigo-900 mb-2">AI Blog Generator</h3>
            <p class="text-sm text-indigo-700 mb-4">Enter a topic and let AI generate a high-quality, SEO-optimized blog post for you.</p>
            
            <div class="flex gap-4">
                <input type="text" id="ai_topic" class="flex-1 rounded-md border-indigo-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g., Road Construction Trends in India 2024">
                <button type="button" id="generate_btn" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <span id="btn_text">Generate with AI</span>
                    <svg id="loading_spinner" class="hidden animate-spin ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
            <div id="ai_message" class="mt-2 text-sm hidden"></div>
        </div>

        <!-- Blog Post Form -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="slug" :value="__('Slug')" />
                        <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <x-input-label for="featured_image" :value="__('Featured Image')" />
                        <input id="featured_image" name="featured_image" type="file" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                        <x-input-error class="mt-2" :messages="$errors->get('featured_image')" />
                    </div>

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <x-input-label for="featured_video_url" :value="__('Featured Video URL (YouTube/Vimeo)')" />
                            <x-text-input id="featured_video_url" name="featured_video_url" type="url" class="mt-1 block w-full" :value="old('featured_video_url')" placeholder="https://www.youtube.com/watch?v=..." />
                            <x-input-error class="mt-2" :messages="$errors->get('featured_video_url')" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="featured_video_file" :value="__('OR Upload Video File (MP4)')" />
                            <input id="featured_video_file" name="featured_video_file" type="file" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error class="mt-2" :messages="$errors->get('featured_video_file')" />
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <x-input-label for="content" :value="__('Content (HTML)')" />
                    <textarea id="content" name="content" rows="15" class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('content') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('content')" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-100 pt-6">
                    <div class="space-y-4">
                        <h4 class="font-medium text-slate-900">SEO Settings</h4>
                        
                        <div>
                            <x-input-label for="meta_title" :value="__('Meta Title')" />
                            <x-text-input id="meta_title" name="meta_title" type="text" class="mt-1 block w-full" :value="old('meta_title')" />
                        </div>

                        <div>
                            <x-input-label for="meta_description" :value="__('Meta Description')" />
                            <textarea id="meta_description" name="meta_description" rows="3" class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('meta_description') }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="keywords" :value="__('Keywords')" />
                            <x-text-input id="keywords" name="keywords" type="text" class="mt-1 block w-full" :value="old('keywords')" />
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="font-medium text-slate-900">Additional Info</h4>
                        
                        <div class="flex items-center">
                            <input id="is_published" name="is_published" type="checkbox" value="1" class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('is_published') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-slate-600">Publish immediately</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 border-t border-slate-100 pt-6">
                    <x-primary-button>{{ __('Save Blog Post') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('generate_btn').addEventListener('click', async function() {
            const topic = document.getElementById('ai_topic').value;
            if (!topic) {
                alert('Please enter a topic');
                return;
            }

            const btn = this;
            const btnText = document.getElementById('btn_text');
            const spinner = document.getElementById('loading_spinner');
            const message = document.getElementById('ai_message');

            btn.disabled = true;
            btnText.innerText = 'Generating...';
            spinner.classList.remove('hidden');
            message.classList.remove('hidden');
            message.className = 'mt-2 text-sm text-indigo-600';
            message.innerText = 'AI is writing your masterpiece... This may take a minute.';

            try {
                const response = await fetch('{{ route("admin.blogs.generate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ topic })
                });

                const data = await response.json();

                if (response.ok) {
                    document.getElementById('title').value = data.title;
                    document.getElementById('slug').value = data.slug;
                    document.getElementById('content').value = data.content;
                    document.getElementById('meta_title').value = data.meta_title;
                    document.getElementById('meta_description').value = data.meta_description;
                    document.getElementById('keywords').value = data.keywords;
                    
                    message.className = 'mt-2 text-sm text-emerald-600';
                    message.innerText = 'Content generated successfully! Review and save.';
                } else {
                    throw new Error(data.error || 'Failed to generate content');
                }
            } catch (error) {
                message.className = 'mt-2 text-sm text-rose-600';
                message.innerText = 'Error: ' + error.message;
            } finally {
                btn.disabled = false;
                btnText.innerText = 'Generate with AI';
                spinner.classList.add('hidden');
            }
        });

        // Simple slug generator for title
        document.getElementById('title').addEventListener('input', function() {
            if (!document.getElementById('slug').dataset.manual) {
                document.getElementById('slug').value = this.value
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }
        });

        document.getElementById('slug').addEventListener('input', function() {
            this.dataset.manual = true;
        });
    </script>
    @endpush
</x-app-layout>
