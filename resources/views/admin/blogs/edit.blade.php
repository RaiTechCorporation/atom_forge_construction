<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Edit Blog Post') }}: {{ $post->title }}
        </h2>
    </x-slot>

    @push('styles')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable {
            min-height: 400px;
            border-radius: 0 0 0.5rem 0.5rem !important;
        }
        .ck-editor__top {
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }
    </style>
    @endpush

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Main Editor -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <form id="blog_form" action="{{ route('admin.blogs.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="p-8 space-y-8">
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Blog Content</label>
                                    <textarea id="content" name="content" class="hidden">{{ old('content', $post->content) }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('content')" />
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <!-- Right Column: Settings & Media -->
            <div class="space-y-8">
                <!-- Status & Title -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 space-y-6">
                    <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-4">General Settings</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="title" :value="__('Title')" class="text-xs font-bold uppercase text-slate-500" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" :value="old('title', $post->title)" required form="blog_form" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="slug" :value="__('URL Slug')" class="text-xs font-bold uppercase text-slate-500" />
                            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500" :value="old('slug', $post->slug)" required form="blog_form" />
                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                        </div>

                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-sm font-semibold text-slate-700">Publish Immediately</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input name="is_published" type="checkbox" value="1" class="sr-only peer" {{ old('is_published', $post->is_published) ? 'checked' : '' }} form="blog_form">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Media -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 space-y-6">
                    <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-4">Featured Media</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="featured_image" :value="__('Featured Image')" class="text-xs font-bold uppercase text-slate-500" />
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-indigo-400 transition-colors cursor-pointer group relative overflow-hidden">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-slate-400 group-hover:text-indigo-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-slate-600">
                                        <label for="featured_image" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                            <span>Upload a file</span>
                                            <input id="featured_image" name="featured_image" type="file" class="sr-only" form="blog_form">
                                        </label>
                                    </div>
                                    <p class="text-xs text-slate-500">PNG, JPG, WEBP up to 2MB</p>
                                </div>
                                <img id="image_preview" class="absolute inset-0 w-full h-full object-cover {{ $post->featured_image ? '' : 'hidden' }}" src="{{ $post->featured_image ?? '#' }}" alt="Preview">
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="featured_video_url" :value="__('Video URL')" class="text-xs font-bold uppercase text-slate-500" />
                                <x-text-input id="featured_video_url" name="featured_video_url" type="url" class="mt-1 block w-full rounded-xl border-slate-200" placeholder="YouTube/Vimeo link" form="blog_form" :value="old('featured_video_url', $post->featured_video_url)" />
                            </div>
                            
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                    <div class="w-full border-t border-slate-100"></div>
                                </div>
                                <div class="relative flex justify-center text-xs uppercase">
                                    <span class="px-2 bg-white text-slate-400 font-bold tracking-widest">OR</span>
                                </div>
                            </div>

                            <div>
                                <x-input-label for="featured_video_file" :value="__('Video File')" class="text-xs font-bold uppercase text-slate-500" />
                                @if($post->featured_video_file)
                                    <div class="text-xs text-indigo-600 mb-1 font-semibold">✓ Current file: {{ basename($post->featured_video_file) }}</div>
                                @endif
                                <input id="featured_video_file" name="featured_video_file" type="file" class="mt-1 block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 transition-all" form="blog_form">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 space-y-6">
                    <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-4">SEO Metadata</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="meta_title" :value="__('Meta Title')" class="text-xs font-bold uppercase text-slate-500" />
                            <x-text-input id="meta_title" name="meta_title" type="text" class="mt-1 block w-full rounded-xl border-slate-200" form="blog_form" :value="old('meta_title', $post->meta_title)" />
                        </div>

                        <div>
                            <x-input-label for="meta_description" :value="__('Meta Description')" class="text-xs font-bold uppercase text-slate-500" />
                            <textarea id="meta_description" name="meta_description" rows="3" class="mt-1 block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" form="blog_form">{{ old('meta_description', $post->meta_description) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="keywords" :value="__('Keywords')" class="text-xs font-bold uppercase text-slate-500" />
                            <x-text-input id="keywords" name="keywords" type="text" class="mt-1 block w-full rounded-xl border-slate-200" placeholder="building, roads, india..." form="blog_form" :value="old('keywords', $post->keywords)" />
                        </div>
                    </div>
                </div>

                <!-- Action -->
                <div class="sticky bottom-8">
                    <button type="submit" form="blog_form" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all active:scale-95 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Update Blog Post
                    </button>
                    <a href="{{ route('admin.blogs.index') }}" class="block text-center mt-4 text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">Discard Changes</a>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        // Image Preview
        document.getElementById('featured_image').addEventListener('change', function(e) {
            const preview = document.getElementById('image_preview');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo'],
            })
            .then(editor => {
                const form = document.querySelector('form');
                form.addEventListener('submit', (e) => {
                    document.querySelector('#content').value = editor.getData();
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    @endpush
</x-app-layout>
