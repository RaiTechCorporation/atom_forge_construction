<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Project Work Progress') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Select a project to view daily visual updates and shift-wise progress.') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                @if(auth()->user()->role !== 'labour')
                    <button @click="$dispatch('open-modal', 'upload-progress')" class="inline-flex items-center justify-center px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20 text-xs uppercase tracking-widest">
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

        <!-- Project Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projects as $project)
                <a href="{{ route('labour.work-progress.index', ['project_id' => $project->id]) }}" class="group relative bg-white rounded-[2.5rem] border-2 border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10 hover:border-indigo-500/20 transition-all duration-500 overflow-hidden flex flex-col">
                    <div class="aspect-video bg-slate-100 relative overflow-hidden">
                        @php
                            $latestMedia = \App\Models\LabourWorkProgress::where('project_id', $project->id)->orderBy('created_at', 'desc')->first();
                        @endphp
                        @if($latestMedia && $latestMedia->file_type === 'image')
                            <img src="{{ Storage::url($latestMedia->file_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600">
                                <svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                        <div class="absolute bottom-6 left-8">
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-md text-white text-[9px] font-black uppercase tracking-widest rounded-lg border border-white/30">
                                {{ $project->project_code ?? 'SITE-'.str_pad($project->id, 3, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight group-hover:text-indigo-600 transition-colors mb-2">
                            {{ $project->name }}
                        </h3>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2 mb-6">
                            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $project->city }}, {{ $project->state }}
                        </p>

                        <div class="mt-auto grid grid-cols-2 gap-4">
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 group-hover:bg-indigo-50/50 group-hover:border-indigo-100 transition-colors">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ __('Total Media') }}</p>
                                <p class="text-lg font-black text-slate-900 italic">
                                    {{ \App\Models\LabourWorkProgress::where('project_id', $project->id)->count() }}
                                </p>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 group-hover:bg-emerald-50/50 group-hover:border-emerald-100 transition-colors">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ __('Last Update') }}</p>
                                <p class="text-[10px] font-black text-slate-900 italic">
                                    {{ $latestMedia ? \Carbon\Carbon::parse($latestMedia->date)->format('d M, Y') : 'No Updates' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="px-8 py-4 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between group-hover:bg-indigo-600 transition-all duration-500">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-white/80 transition-colors">{{ __('View Full Feed') }}</span>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-white group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>
                </a>
            @empty
                <div class="col-span-full bg-white rounded-3xl border-2 border-dashed border-slate-200 p-20 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 uppercase tracking-widest mb-2">{{ __('No Projects Found') }}</h3>
                    <p class="text-slate-500 font-medium max-w-sm mx-auto">{{ __('Register your construction projects to start tracking daily work progress.') }}</p>
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
                    <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">{{ __('Categorize visual updates by labourer and shift') }}</p>
                </div>
                <button @click="$dispatch('close-modal', 'upload-progress')" class="p-2 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form id="uploadForm" action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
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
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2 ml-1">{{ __('Select Labourer') }}</label>
                        <select name="labour_id" id="labourSelect" required onchange="updateFormAction(this.value)" class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl text-xs font-bold focus:border-indigo-600 focus:ring-0 transition-all">
                            <option value="">Choose Worker...</option>
                            @foreach($labours as $labour)
                                <option value="{{ $labour->id }}">{{ $labour->name }} ({{ $labour->labour_unique_id }})</option>
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
        function updateFormAction(labourId) {
            const form = document.getElementById('uploadForm');
            if (labourId) {
                form.action = `/labour/${labourId}/work-progress`;
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
                alert('Please select a labourer first.');
                return;
            }

            progressContainer.classList.remove('hidden');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);

            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    const percentage = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percentage + '%';
                    percentageText.innerText = percentage + '%';
                }
            };

            xhr.onload = function() {
                if (xhr.status === 200 || xhr.status === 302) {
                    window.location.reload();
                } else {
                    alert('Upload failed. Please try again.');
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            };

            xhr.onerror = function() {
                alert('An error occurred during upload.');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            };

            xhr.send(formData);
        });
    </script>
</x-app-layout>
