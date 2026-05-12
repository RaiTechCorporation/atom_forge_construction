<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('labour.work-progress.index') }}" class="p-2 bg-white border-2 border-slate-100 rounded-xl text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                        {{ $project ? $project->name : __('Daily Work Progress Feed') }}
                    </h2>
                    <p class="mt-1 text-sm font-medium text-slate-500">
                        {{ __('Track daily visual updates of work completed by site managers.') }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('labour.work-progress.index', ['view' => 'grid']) }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border-2 border-slate-100 text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition-all shadow-sm text-[10px] uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    {{ __('Project Grid') }}
                </a>
                @if(auth()->user()->role !== 'labour')
                    <button @click="$dispatch('open-modal', 'upload-progress')" class="inline-flex items-center justify-center px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20 text-[10px] uppercase tracking-widest">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0l-4-4m4 4v12"></path></svg>
                        {{ __('Upload New Progress') }}
                    </button>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-xl flex items-center gap-3 animate-fade-in" role="alert">
                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-semibold text-emerald-800 text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Progress Feed -->
        <div class="space-y-10">
            @forelse($progresses as $date => $dailyProgress)
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="h-px flex-1 bg-slate-200"></div>
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-[0.3em] bg-white px-6 py-2 rounded-full border border-slate-200 shadow-sm italic">
                            {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}
                        </h3>
                        <div class="h-px flex-1 bg-slate-200"></div>
                    </div>

                    <div class="space-y-12">
                        @foreach($dailyProgress->groupBy('project_id') as $projectId => $projectFiles)
                            @php $proj = $projectFiles->first()->project; @endphp
                            <div class="space-y-6">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 ml-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
                                        <div class="flex flex-col">
                                            <h4 class="text-lg font-black text-slate-900 uppercase tracking-tight">{{ $proj?->name ?? 'Unassigned Project' }}</h4>
                                            @if($proj?->location)
                                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest flex items-center gap-1">
                                                    <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                                    {{ $proj->location }}
                                                </p>
                                            @endif
                                        </div>
                                        <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[9px] font-black uppercase tracking-widest rounded-lg border border-slate-200">
                                            {{ $projectFiles->count() }} Total Updates
                                        </span>
                                    </div>
                                    @php
                                        $projLocation = $projectFiles->whereNotNull('latitude')->whereNotNull('longitude')->first();
                                    @endphp
                                    @if($projLocation)
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ $projLocation->latitude }},{{ $projLocation->longitude }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg shadow-slate-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                            Project Location
                                        </a>
                                    @endif
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                    @foreach($projectFiles->groupBy('shift') as $shift => $files)
                                        <div class="bg-white rounded-[2rem] border-2 border-slate-100 shadow-sm overflow-hidden flex flex-col">
                                            <div class="px-8 py-5 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                                                <div class="flex flex-col gap-1">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-8 h-8 {{ $shift === 'Overtime' ? 'bg-amber-100 text-amber-600' : 'bg-indigo-100 text-indigo-600' }} rounded-xl flex items-center justify-center">
                                                            @if($shift === 'Overtime')
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            @else
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                                            @endif
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-widest">{{ $shift }}</h4>
                                                            @php
                                                                $shiftLoc = $files->whereNotNull('latitude')->whereNotNull('longitude')->first();
                                                            @endphp
                                                            @if($shiftLoc)
                                                                <p class="text-[7px] font-bold text-slate-400 uppercase tracking-widest">{{ $shiftLoc->latitude }}, {{ $shiftLoc->longitude }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @php
                                                        $firstLocation = $files->whereNotNull('latitude')->whereNotNull('longitude')->first();
                                                    @endphp
                                                    @if($firstLocation)
                                                        <a href="https://www.google.com/maps/search/?api=1&query={{ $firstLocation->latitude }},{{ $firstLocation->longitude }}" target="_blank" class="flex items-center gap-1 text-[8px] font-bold text-emerald-600 hover:text-emerald-700 transition-colors uppercase tracking-widest mt-0.5 ml-11">
                                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                                            View Map
                                                        </a>
                                                    @endif
                                                </div>
                                                <span class="text-[9px] font-black text-slate-400 bg-white border border-slate-200 px-3 py-1 rounded-full uppercase tracking-widest">
                                                    {{ $files->count() }} {{ Str::plural('Update', $files->count()) }}
                                                </span>
                                            </div>
                                            <div class="p-8 grid grid-cols-2 sm:grid-cols-3 gap-3">
                                                @foreach($files as $file)
                                                    <div class="relative group aspect-square rounded-2xl overflow-hidden shadow-sm border border-slate-100">
                                                        @php
                                                            $fileExists = Storage::disk('public')->exists($file->file_path);
                                                        @endphp

                                                        @if(!$fileExists)
                                                            <div class="w-full h-full bg-slate-100 flex flex-col items-center justify-center p-4 text-center">
                                                                <svg class="w-8 h-8 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest leading-tight">Media Not Found On Server</span>
                                                            </div>
                                                        @elseif($file->file_type === 'image')
                                                            <img src="{{ asset('storage/' . $file->file_path) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                                        @else
                                                            <div class="w-full h-full bg-slate-900 overflow-hidden">
                                                                <video class="w-full h-full object-cover">
                                                                    <source src="{{ asset('storage/' . $file->file_path) }}" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                                                    <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                                                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        
                                                        <!-- Overlay -->
                                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-3">
                                                            <p class="text-[8px] font-black text-white uppercase tracking-widest mb-0.5 truncate">{{ $file->siteManager?->name ?? 'N/A' }}</p>
                                                            <p class="text-[7px] font-bold text-indigo-300 uppercase tracking-[0.2em] mb-1.5 truncate">{{ $file->project?->location ?? $file->project?->name ?? 'No Project' }}</p>
                                                            <div class="flex items-center justify-between gap-2">
                                                                <div class="flex gap-1.5">
                                                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="p-1.5 bg-white/20 hover:bg-white/40 text-white rounded-lg transition-colors backdrop-blur-md">
                                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                                    </a>
                                                                    @if($file->latitude && $file->longitude)
                                                                        <a href="https://www.google.com/maps/search/?api=1&query={{ $file->latitude }},{{ $file->longitude }}" target="_blank" class="p-1.5 bg-indigo-500/20 hover:bg-indigo-500/40 text-white rounded-lg transition-colors backdrop-blur-md" title="View Location">
                                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                                <form action="{{ route('labour.work-progress.destroy', $file) }}" method="POST" onsubmit="return confirm('Delete this file?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="p-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-lg transition-colors shadow-lg shadow-rose-500/30">
                                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl border-2 border-dashed border-slate-200 p-20 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 uppercase tracking-widest mb-2">{{ __('No Progress Captured') }}</h3>
                    <p class="text-slate-500 font-medium max-w-sm mx-auto mb-8">{{ __('Start documenting daily construction progress by uploading images and videos for your site managers.') }}</p>
                    <button @click="$dispatch('open-modal', 'upload-progress')" class="inline-flex items-center px-8 py-3 bg-indigo-600 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-indigo-500 transition-all shadow-xl shadow-indigo-600/20">
                        {{ __('Upload First Update') }}
                    </button>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Upload Modal -->
    <x-modal name="upload-progress" :show="$errors->any()" focusable>
        <div class="p-8">
            <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-100">
                <div>
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-tighter">{{ __('Upload Daily Progress') }}</h2>
                    <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">{{ __('Categorize visual updates by site manager and shift') }}</p>
                </div>
                <button @click="$dispatch('close-modal', 'upload-progress')" class="p-2 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form id="uploadForm" action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="latitude" id="latitudeInput">
                <input type="hidden" name="longitude" id="longitudeInput">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2 ml-1">{{ __('Select Project Site') }}</label>
                        <select name="project_id" required class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl text-xs font-bold focus:border-indigo-600 focus:ring-0 transition-all">
                            <option value="">Choose Project...</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2 ml-1">{{ __('Select Site Manager') }}</label>
                        <select name="site_manager_id" id="siteManagerSelect" required onchange="updateFormAction(this.value)" class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl text-xs font-bold focus:border-indigo-600 focus:ring-0 transition-all">
                            <option value="">Choose Site Manager...</option>
                            @foreach($siteManagers as $siteManager)
                                <option value="{{ $siteManager->id }}">{{ $siteManager->name }} ({{ $siteManager->manager_unique_id }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2 ml-1">{{ __('Shift Categorization') }}</label>
                        <select name="shift" required class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl text-xs font-bold focus:border-indigo-600 focus:ring-0 transition-all">
                            <option value="1st Shift">1st Shift (Morning)</option>
                            <option value="2nd Shift">2nd Shift (Afternoon)</option>
                            <option value="Overtime">Overtime (Late Shift)</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2 ml-1">{{ __('Report Date') }}</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl text-xs font-bold focus:border-indigo-600 focus:ring-0 transition-all">
                    </div>
                </div>

                <div class="space-y-4 pt-4">
                    <div class="p-6 bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200 group hover:border-indigo-400 transition-colors relative">
                        <label class="cursor-pointer">
                            <input type="file" name="images[]" id="imageInput" multiple accept="image/*" capture="environment" class="hidden" onchange="handleFileSelect(this, 'imagePreview')">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-indigo-600 shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="text-[10px] font-black text-slate-900 uppercase tracking-widest">{{ __('Attach Progress Photos') }}</span>
                                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-[0.2em]">{{ __('Max 10 images • Up to 10MB each') }}</span>
                            </div>
                        </label>
                        <div id="imagePreview" class="mt-4 grid grid-cols-5 gap-2"></div>
                    </div>

                    <div class="p-6 bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200 group hover:border-indigo-400 transition-colors relative">
                        <label class="cursor-pointer">
                            <input type="file" name="videos[]" id="videoInput" multiple accept="video/*" capture="environment" class="hidden" onchange="handleFileSelect(this, 'videoPreview')">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-indigo-600 shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="text-[10px] font-black text-slate-900 uppercase tracking-widest">{{ __('Attach Progress Videos') }}</span>
                                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-[0.2em]">{{ __('Max 5 videos • Up to 50MB each') }}</span>
                            </div>
                        </label>
                        <div id="videoPreview" class="mt-4 grid grid-cols-5 gap-2"></div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div id="uploadProgressContainer" class="hidden space-y-2">
                    <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest text-indigo-600">
                        <span>Uploading Progress...</span>
                        <span id="uploadPercentage">0%</span>
                    </div>
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                        <div id="uploadProgressBar" class="bg-indigo-600 h-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-rose-50 p-4 rounded-xl border border-rose-100">
                        <ul class="list-disc list-inside text-[10px] font-bold text-rose-600 uppercase tracking-widest">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex gap-4 pt-6">
                    <button type="button" @click="$dispatch('close-modal', 'upload-progress')" class="flex-1 py-4 bg-slate-100 text-slate-600 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-200 transition-all">
                        {{ __('Discard') }}
                    </button>
                    <button type="submit" class="flex-2 py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200 px-12">
                        {{ __('Confirm Upload') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

    <script>
        function updateFormAction(siteManagerId) {
            const form = document.getElementById('uploadForm');
            if (siteManagerId) {
                let url = "{{ route('labour.work-progress.store', ':id') }}";
                form.action = url.replace(':id', siteManagerId);
            } else {
                form.action = '';
            }
        }

        function handleFileSelect(input, previewId) {
            const preview = document.getElementById(previewId);
            preview.innerHTML = '';
            
            if (input.files) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    const container = document.createElement('div');
                    container.className = 'aspect-square rounded-lg border-2 border-slate-100 overflow-hidden bg-white shadow-sm';
                    
                    reader.onload = function(e) {
                        if (file.type.startsWith('image/')) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'w-full h-full object-cover';
                            container.appendChild(img);
                        } else {
                            const videoIcon = document.createElement('div');
                            videoIcon.className = 'w-full h-full flex items-center justify-center bg-slate-900 text-white';
                            videoIcon.innerHTML = '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>';
                            container.appendChild(videoIcon);
                        }
                    }
                    reader.readAsDataURL(file);
                    preview.appendChild(container);
                });
            }
        }

        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const formData = new FormData(form);
            const progressContainer = document.getElementById('uploadProgressContainer');
            const progressBar = document.getElementById('uploadProgressBar');
            const percentageText = document.getElementById('uploadPercentage');
            const submitBtn = form.querySelector('button[type="submit"]');

            if (!form.action || form.action === window.location.href) {
                alert('Please select a site manager first.');
                return;
            }

            // File size validation
            const images = document.getElementById('imageInput').files;
            const videos = document.getElementById('videoInput').files;
            
            for (let i = 0; i < images.length; i++) {
                if (images[i].size > 10 * 1024 * 1024) { // 10MB
                    alert('Image ' + images[i].name + ' is too large (max 10MB)');
                    return;
                }
            }
            
            for (let i = 0; i < videos.length; i++) {
                if (videos[i].size > 50 * 1024 * 1024) { // 50MB
                    alert('Video ' + videos[i].name + ' is too large (max 50MB)');
                    return;
                }
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    const percentage = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percentage + '%';
                    percentageText.innerText = percentage + '%';
                }
            };

            xhr.onload = function() {
                if (xhr.status === 200 || xhr.status === 302) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            window.location.reload();
                        } else {
                            alert('Upload failed: ' + (response.message || 'Unknown error'));
                            submitBtn.disabled = false;
                            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                        }
                    } catch (e) {
                        // If not JSON, it might be the redirected page
                        window.location.reload();
                    }
                } else {
                    let errorMessage = 'Upload failed. Please try again.';
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.errors) {
                            errorMessage = Object.values(response.errors).flat().join('\n');
                        } else if (response.message) {
                            errorMessage = response.message;
                        }
                    } catch (e) {}
                    
                    alert(errorMessage);
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            };

            xhr.onerror = function() {
                alert('An error occurred during upload.');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            };

            // Get location if available
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('latitudeInput').value = position.coords.latitude;
                    document.getElementById('longitudeInput').value = position.coords.longitude;
                    
                    formData.set('latitude', position.coords.latitude);
                    formData.set('longitude', position.coords.longitude);
                    
                    startUpload(xhr, formData, progressContainer, progressBar, percentageText, submitBtn);
                }, function(error) {
                    console.error("Error getting location: ", error);
                    startUpload(xhr, formData, progressContainer, progressBar, percentageText, submitBtn);
                }, {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                });
            } else {
                startUpload(xhr, formData, progressContainer, progressBar, percentageText, submitBtn);
            }
        });

        function startUpload(xhr, formData, progressContainer, progressBar, percentageText, submitBtn) {
            progressContainer.classList.remove('hidden');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');

            xhr.send(formData);
        }
    </script>
</x-app-layout>
