<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Create New Blog Post') }}
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
            <!-- Left Column: AI Generator & Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- AI Generator Tool -->
                <div class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-2xl p-8 shadow-xl text-white overflow-hidden relative">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold">AI Magic Writer</h3>
                        </div>
                        <p class="text-indigo-100 mb-6">Let our AI craft a professional, SEO-optimized construction blog post for you in seconds.</p>
                        
                        <div class="space-y-4">
                            <div class="flex flex-col sm:flex-row gap-3">
                                <input type="text" id="ai_topic" class="flex-1 rounded-xl border-transparent bg-white/10 backdrop-blur-md text-white placeholder-indigo-200 focus:ring-2 focus:ring-white/50 focus:border-transparent transition-all" placeholder="Enter topic (e.g., Smart Cities in India)">
                                <button type="button" id="generate_btn" class="inline-flex items-center justify-center px-6 py-3 bg-white text-indigo-600 rounded-xl font-bold shadow-lg hover:bg-indigo-50 transition-all active:scale-95 disabled:opacity-50 disabled:scale-100">
                                    <span id="btn_text">Generate Content</span>
                                    <svg id="loading_spinner" class="hidden animate-spin ml-2 h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold uppercase tracking-wider text-indigo-200">Key Points</label>
                                    <textarea id="ai_features" rows="2" class="w-full rounded-xl border-transparent bg-white/10 backdrop-blur-md text-white placeholder-indigo-200 focus:ring-2 focus:ring-white/50 focus:border-transparent transition-all text-sm" placeholder="List key features..."></textarea>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold uppercase tracking-wider text-indigo-200">Specific Sub-topics</label>
                                    <textarea id="ai_specific_topics" rows="2" class="w-full rounded-xl border-transparent bg-white/10 backdrop-blur-md text-white placeholder-indigo-200 focus:ring-2 focus:ring-white/50 focus:border-transparent transition-all text-sm" placeholder="Any specific areas?"></textarea>
                                </div>
                            </div>
                        </div>
                        <div id="ai_message" class="mt-4 p-3 rounded-lg text-sm hidden"></div>
                    </div>
                </div>

                <!-- Main Editor -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <form id="blog_form" action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="p-8 space-y-8">
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Blog Content</label>
                                    <textarea id="content" name="content" class="hidden">{{ old('content') }}</textarea>
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
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" :value="old('title')" required form="blog_form" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="slug" :value="__('URL Slug')" class="text-xs font-bold uppercase text-slate-500" />
                            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500" :value="old('slug')" required form="blog_form" />
                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                        </div>

                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-sm font-semibold text-slate-700">Publish Immediately</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input name="is_published" type="checkbox" value="1" class="sr-only peer" {{ old('is_published') ? 'checked' : '' }} form="blog_form">
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
                                <img id="image_preview" class="absolute inset-0 w-full h-full object-cover hidden" src="#" alt="Preview">
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="featured_video_url" :value="__('Video URL')" class="text-xs font-bold uppercase text-slate-500" />
                                <x-text-input id="featured_video_url" name="featured_video_url" type="url" class="mt-1 block w-full rounded-xl border-slate-200" placeholder="YouTube/Vimeo link" form="blog_form" />
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
                            <x-text-input id="meta_title" name="meta_title" type="text" class="mt-1 block w-full rounded-xl border-slate-200" form="blog_form" />
                        </div>

                        <div>
                            <x-input-label for="meta_description" :value="__('Meta Description')" class="text-xs font-bold uppercase text-slate-500" />
                            <textarea id="meta_description" name="meta_description" rows="3" class="mt-1 block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500" form="blog_form">{{ old('meta_description') }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="keywords" :value="__('Keywords')" class="text-xs font-bold uppercase text-slate-500" />
                            <x-text-input id="keywords" name="keywords" type="text" class="mt-1 block w-full rounded-xl border-slate-200" placeholder="building, roads, india..." form="blog_form" />
                        </div>
                    </div>
                </div>

                <!-- Action -->
                <div class="sticky bottom-8">
                    <button type="submit" form="blog_form" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all active:scale-95 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        Save Blog Post
                    </button>
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

        let blogEditor;

        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo'],
            })
            .then(editor => {
                blogEditor = editor;
                
                // Ensure content is synced when form is submitted
                const form = document.querySelector('form');
                form.addEventListener('submit', (e) => {
                    // Manual sync just in case
                    const data = blogEditor.getData();
                    document.querySelector('#content').value = data;
                });
            })
            .catch(error => {
                console.error(error);
            });

        document.getElementById('generate_btn').addEventListener('click', async function() {
            const topic = document.getElementById('ai_topic').value;
            const features = document.getElementById('ai_features').value;
            const specific_topics = document.getElementById('ai_specific_topics').value;

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
            message.innerText = 'AI is writing your masterpiece with formatting... This may take a minute.';

            try {
                const response = await fetch('{{ route("admin.blogs.generate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        topic,
                        features,
                        specific_topics
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    document.getElementById('ai_features').value = data.features;
                    document.getElementById('ai_specific_topics').value = data.specific_topics;
                    
                    document.getElementById('title').value = data.title;
                    document.getElementById('slug').value = data.slug;
                    
                    // Set CKEditor content
                    if (blogEditor) {
                        blogEditor.setData(data.content);
                    } else {
                        document.getElementById('content').value = data.content;
                    }

                    document.getElementById('meta_title').value = data.meta_title;
                    document.getElementById('meta_description').value = data.meta_description;
                    document.getElementById('keywords').value = data.keywords;
                    
                    message.className = 'mt-2 text-sm text-emerald-600';
                    message.innerText = 'Content generated successfully with bullet points and topics! Review and save.';
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
