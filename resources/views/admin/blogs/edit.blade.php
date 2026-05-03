<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Edit Blog Post') }}: {{ $post->title }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('admin.blogs.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PATCH')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $post->title)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="slug" :value="__('Slug')" />
                        <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', $post->slug)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <x-input-label for="featured_image" :value="__('Featured Image')" />
                        @if($post->featured_image)
                            <div class="mb-2">
                                <img src="{{ $post->featured_image }}" class="w-32 h-20 object-cover rounded shadow-sm">
                            </div>
                        @endif
                        <input id="featured_image" name="featured_image" type="file" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                        <x-input-error class="mt-2" :messages="$errors->get('featured_image')" />
                    </div>

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <x-input-label for="featured_video_url" :value="__('Featured Video URL (YouTube/Vimeo)')" />
                            <x-text-input id="featured_video_url" name="featured_video_url" type="url" class="mt-1 block w-full" :value="old('featured_video_url', $post->featured_video_url)" placeholder="https://www.youtube.com/watch?v=..." />
                            <x-input-error class="mt-2" :messages="$errors->get('featured_video_url')" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="featured_video_file" :value="__('OR Upload Video File (MP4)')" />
                            @if($post->featured_video_file)
                                <div class="text-xs text-slate-500 mb-1 italic">Current file: {{ basename($post->featured_video_file) }}</div>
                            @endif
                            <input id="featured_video_file" name="featured_video_file" type="file" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error class="mt-2" :messages="$errors->get('featured_video_file')" />
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <x-input-label for="content" :value="__('Content (HTML)')" />
                    <textarea id="content" name="content" rows="15" class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('content', $post->content) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('content')" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-100 pt-6">
                    <div class="space-y-4">
                        <h4 class="font-medium text-slate-900">SEO Settings</h4>
                        
                        <div>
                            <x-input-label for="meta_title" :value="__('Meta Title')" />
                            <x-text-input id="meta_title" name="meta_title" type="text" class="mt-1 block w-full" :value="old('meta_title', $post->meta_title)" />
                        </div>

                        <div>
                            <x-input-label for="meta_description" :value="__('Meta Description')" />
                            <textarea id="meta_description" name="meta_description" rows="3" class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('meta_description', $post->meta_description) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="keywords" :value="__('Keywords')" />
                            <x-text-input id="keywords" name="keywords" type="text" class="mt-1 block w-full" :value="old('keywords', $post->keywords)" />
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="font-medium text-slate-900">Additional Info</h4>
                        
                        <div class="flex items-center">
                            <input id="is_published" name="is_published" type="checkbox" value="1" class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-slate-600">Publish immediately</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 border-t border-slate-100 pt-6">
                    <x-primary-button>{{ __('Update Blog Post') }}</x-primary-button>
                    <a href="{{ route('admin.blogs.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
