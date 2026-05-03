<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 py-2">
            <div>
                <h2 class="font-black text-3xl text-black leading-tight tracking-tighter">
                    {{ __('Record Project Update') }}
                </h2>
                <p class="mt-1 text-base font-bold text-slate-800">
                    {{ __('Log a new progress milestone or status update for a project.') }}
                </p>
            </div>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center bg-white px-5 py-3 rounded-xl border-2 border-slate-400 shadow-sm">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-xs font-black uppercase tracking-widest text-slate-700 hover:text-indigo-800 transition-colors">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-slate-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('project-updates.index') }}" class="text-xs font-black uppercase tracking-widest text-slate-700 hover:text-indigo-800 transition-colors">{{ __('Project Updates') }}</a>
                    </li>
                    <li class="flex items-center" aria-current="page">
                        <svg class="w-5 h-5 text-slate-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-xs font-black uppercase tracking-widest text-indigo-800">{{ __('Create') }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('project-updates.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Project Selection -->
                        <div class="col-span-1">
                            <x-input-label for="project_id" :value="__('Project')" />
                            <select id="project_id" name="project_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select a Project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                        </div>

                        <!-- Date -->
                        <div class="col-span-1">
                            <x-input-label for="date" :value="__('Date')" />
                            <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" :value="old('date', date('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <!-- Progress Percentage -->
                        <div class="col-span-1">
                            <x-input-label for="progress_percent" :value="__('Progress (%)')" />
                            <x-text-input id="progress_percent" name="progress_percent" type="number" min="0" max="100" class="mt-1 block w-full" :value="old('progress_percent', 0)" required />
                            <x-input-error :messages="$errors->get('progress_percent')" class="mt-2" />
                        </div>

                        <!-- Images -->
                        <div class="col-span-1">
                            <x-input-label for="images" :value="__('Progress Photos')" />
                            <input id="images" name="images[]" type="file" multiple capture="environment" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error :messages="$errors->get('images')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <x-input-label for="description" :value="__('Description/Milestones')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-4">
                        <a href="{{ route('project-updates.index') }}" class="text-sm font-bold text-slate-600 hover:text-slate-900">
                            {{ __('Cancel') }}
                        </a>
                        <x-primary-button>
                            {{ __('Save Update') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
