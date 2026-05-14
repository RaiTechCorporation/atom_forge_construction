<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Website Architecture') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Modify and update the core content modules of your public portal.') }}
                    @if($selectedGroup)
                        <span class="text-indigo-600 font-bold ml-1">/ {{ ucfirst($selectedGroup) }}</span>
                    @endif
                </p>
            </div>
            <div class="flex items-center bg-white px-4 py-2 rounded-lg border border-slate-200 shadow-sm">
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500 flex items-center gap-2">
                    <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
                    {{ __('CONTENT MANAGEMENT') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if (session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3 animate-fade-in">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        @if($selectedGroup === 'home')
            <div class="premium-card overflow-hidden">
                <div class="p-8 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-indigo-600 rounded-full"></div>
                        <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">Dynamic Home Sections</h3>
                    </div>
                    <a href="{{ route('home-sections.create') }}" class="group relative px-6 py-2.5 bg-slate-900 text-white font-black uppercase tracking-widest text-[10px] rounded-xl hover:bg-indigo-600 transition-all duration-300 shadow-xl shadow-slate-900/20 hover:shadow-indigo-600/30">
                        <span class="relative z-10 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            {{ __('Add New Section') }}
                        </span>
                    </a>
                </div>
                @if($homeSections->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Section Info</th>
                                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Details</th>
                                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Order</th>
                                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Status</th>
                                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($homeSections as $section)
                                    <tr class="group hover:bg-slate-50/50 transition-colors">
                                        <td class="px-8 py-6">
                                            <div class="flex items-center gap-4">
                                                @if($section->image)
                                                    <div class="relative w-12 h-12 rounded-xl overflow-hidden border border-slate-200 shadow-sm flex-shrink-0 group-hover:scale-110 transition-transform duration-500">
                                                        <img src="{{ $section->image }}" class="w-full h-full object-cover">
                                                    </div>
                                                @else
                                                    <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-300 border border-slate-200 shadow-sm flex-shrink-0">
                                                        @if($section->icon)
                                                            <i class="fa-solid fa-{{ $section->icon }} text-lg"></i>
                                                        @else
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        @endif
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-500 mb-0.5">{{ $section->subtitle ?? 'General' }}</div>
                                                    <div class="text-sm font-bold text-slate-900 tracking-tight">{{ $section->title ?? 'Untitled Section' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="max-w-xs">
                                                <p class="text-xs text-slate-500 line-clamp-1 leading-relaxed font-medium">{{ $section->description }}</p>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6 text-center">
                                            <span class="inline-flex items-center justify-center w-8 h-8 text-xs font-black text-slate-700 bg-white border border-slate-200 rounded-lg shadow-sm">{{ $section->order }}</span>
                                        </td>
                                        <td class="px-8 py-6">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider {{ $section->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-50 text-slate-400' }}">
                                                <span class="w-1 h-1 rounded-full {{ $section->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                                {{ $section->is_active ? 'Visible' : 'Hidden' }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <div class="flex justify-end items-center gap-2">
                                                <a href="{{ route('home-sections.edit', $section) }}" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('home-sections.destroy', $section) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h4 class="text-slate-900 font-bold mb-1">No dynamic sections found</h4>
                        <p class="text-slate-500 text-xs">Start by adding your first dynamic section to the home page.</p>
                    </div>
                @endif
            </div>
        @endif

        <form action="{{ route('website-content.update-all') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <input type="hidden" name="group" value="{{ $selectedGroup }}">

            <div class="space-y-8">
                @foreach($contents as $group => $items)
                    @if($group === 'projects')
                        <div class="premium-card overflow-hidden">
                            <div class="p-8 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-1.5 h-6 bg-indigo-600 rounded-full"></div>
                                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">{{ ucfirst($group) }} Management</h3>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2 px-4 py-2 bg-indigo-50 rounded-xl">
                                        <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">Table View Enabled</span>
                                    </div>
                                    <form action="{{ route('website-content.add-project') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="group relative px-6 py-2.5 bg-slate-900 text-white font-black uppercase tracking-widest text-[10px] rounded-xl hover:bg-indigo-600 transition-all duration-300 shadow-xl shadow-slate-900/20 hover:shadow-indigo-600/30">
                                            <span class="relative z-10 flex items-center gap-2">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                                {{ __('Add New Project') }}
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-slate-50/50">
                                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 w-16">#</th>
                                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 min-w-[200px]">Project Info</th>
                                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 min-w-[150px]">Type & Location</th>
                                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 min-w-[300px]">Description</th>
                                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 min-w-[250px]">Media Asset</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @php
                                            $projects = [];
                                            foreach($items as $item) {
                                                if(preg_match('/project_(\d+)_(\w+)/', $item->key, $matches)) {
                                                    $index = $matches[1];
                                                    $field = $matches[2];
                                                    $projects[$index][$field] = $item;
                                                } else {
                                                    $projects['general'][] = $item;
                                                }
                                            }
                                            ksort($projects);
                                        @endphp

                                        @foreach($projects as $index => $projectFields)
                                            @if($index !== 'general')
                                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                                    <td class="px-6 py-8 align-top">
                                                        <span class="inline-flex items-center justify-center w-8 h-8 text-xs font-black text-indigo-600 bg-indigo-50 rounded-lg">{{ $index }}</span>
                                                    </td>
                                                    <td class="px-6 py-8 align-top">
                                                        <div class="space-y-4">
                                                            @if(isset($projectFields['name']))
                                                                <div>
                                                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block">Project Name</label>
                                                                    <input 
                                                                        type="text" 
                                                                        name="contents[{{ $projectFields['name']->key }}]" 
                                                                        value="{{ old("contents.".$projectFields['name']->key, $projectFields['name']->value) }}"
                                                                        class="input-premium !py-2 !px-3 !text-sm"
                                                                        placeholder="Project name..."
                                                                    >
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-8 align-top">
                                                        <div class="space-y-4">
                                                            @if(isset($projectFields['type']))
                                                                <div>
                                                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block">Category / Type</label>
                                                                    <select 
                                                                        name="contents[{{ $projectFields['type']->key }}]" 
                                                                        class="input-premium !py-2 !px-3 !text-sm"
                                                                    >
                                                                        <option value="Residential" {{ old("contents.".$projectFields['type']->key, $projectFields['type']->value) === 'Residential' ? 'selected' : '' }}>Residential</option>
                                                                        <option value="Commercial" {{ old("contents.".$projectFields['type']->key, $projectFields['type']->value) === 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                                                        <option value="Interiors" {{ old("contents.".$projectFields['type']->key, $projectFields['type']->value) === 'Interiors' ? 'selected' : '' }}>Interiors</option>
                                                                        <option value="Industrial" {{ old("contents.".$projectFields['type']->key, $projectFields['type']->value) === 'Industrial' ? 'selected' : '' }}>Industrial</option>
                                                                        <option value="Infrastructure" {{ old("contents.".$projectFields['type']->key, $projectFields['type']->value) === 'Infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                                                                    </select>
                                                                </div>
                                                            @endif
                                                            @if(isset($projectFields['location']))
                                                                <div>
                                                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block">Location</label>
                                                                    <input 
                                                                        type="text" 
                                                                        name="contents[{{ $projectFields['location']->key }}]" 
                                                                        value="{{ old("contents.".$projectFields['location']->key, $projectFields['location']->value) }}"
                                                                        class="input-premium !py-2 !px-3 !text-sm"
                                                                        placeholder="Project location..."
                                                                    >
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-8 align-top">
                                                        @if(isset($projectFields['description']))
                                                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block">Description</label>
                                                            <textarea 
                                                                name="contents[{{ $projectFields['description']->key }}]" 
                                                                rows="4" 
                                                                class="input-premium !py-2 !px-3 !text-sm"
                                                                placeholder="Project details..."
                                                            >{{ old("contents.".$projectFields['description']->key, $projectFields['description']->value) }}</textarea>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-8 align-top">
                                                        @if(isset($projectFields['image']))
                                                            <div class="space-y-3">
                                                                <div class="flex items-center gap-4">
                                                                    @if($projectFields['image']->value)
                                                                        <div class="w-12 h-12 rounded-lg overflow-hidden border border-slate-200 flex-shrink-0 bg-white">
                                                                            <img src="{{ $projectFields['image']->value }}" class="w-full h-full object-cover">
                                                                        </div>
                                                                    @endif
                                                                    <div class="flex-grow">
                                                                        <div class="relative group/file">
                                                                            <input type="file" name="files[{{ $projectFields['image']->key }}]" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                                                                            <div class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg flex items-center gap-2 group-hover/file:border-indigo-600 transition-all">
                                                                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                                                                <span class="text-[10px] font-bold text-slate-500">Upload</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input 
                                                                    type="text" 
                                                                    name="contents[{{ $projectFields['image']->key }}]" 
                                                                    value="{{ old("contents.".$projectFields['image']->key, $projectFields['image']->value) }}"
                                                                    class="input-premium !py-1.5 !px-3 !text-[10px]"
                                                                    placeholder="Or enter URL..."
                                                                >
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            @if(isset($projects['general']))
                                <div class="p-8 bg-slate-50/50 border-t border-slate-100">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        @foreach($projects['general'] as $item)
                                            <div class="group/field">
                                                <label class="stat-label group-hover/field:text-indigo-600 transition-colors">{{ $item->label }}</label>
                                                @if($item->type === 'textarea')
                                                    <textarea name="contents[{{ $item->key }}]" rows="3" class="input-premium">{{ old("contents.$item->key", $item->value) }}</textarea>
                                                @else
                                                    <input type="text" name="contents[{{ $item->key }}]" value="{{ old("contents.$item->key", $item->value) }}" class="input-premium">
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="premium-card overflow-hidden">
                            <div class="p-8 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-1.5 h-6 bg-indigo-600 rounded-full"></div>
                                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">{{ ucfirst($group) }} Section</h3>
                                </div>
                            </div>
                            <div class="p-8 space-y-8">
                                @foreach($items as $item)
                                    <div class="group/field">
                                        <label class="stat-label group-hover/field:text-indigo-600 transition-colors">{{ $item->label }}</label>
                                        
                                        @if($item->type === 'textarea')
                                            <textarea 
                                                name="contents[{{ $item->key }}]" 
                                                rows="5" 
                                                class="input-premium"
                                                placeholder="Enter {{ strtolower($item->label) }}..."
                                            >{{ old("contents.$item->key", $item->value) }}</textarea>
                                        @elseif($item->type === 'image')
                                            <div class="space-y-6 bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                                                <div class="flex flex-col lg:flex-row gap-8">
                                                    @if($item->value)
                                                        <div class="relative w-full lg:w-48 h-48 rounded-2xl overflow-hidden border border-slate-200 bg-white flex-shrink-0 shadow-inner group/img">
                                                            <img src="{{ $item->value }}" class="w-full h-full object-contain p-4 group-hover/img:scale-110 transition-transform duration-500">
                                                            <div class="absolute inset-0 bg-black/5 opacity-0 group-hover/img:opacity-100 transition-opacity pointer-events-none"></div>
                                                        </div>
                                                    @endif
                                                    <div class="flex-grow grid grid-cols-1 gap-6">
                                                        <div>
                                                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Upload New Asset</label>
                                                            <div class="relative group/file">
                                                                <input 
                                                                    type="file" 
                                                                    name="files[{{ $item->key }}]" 
                                                                    class="absolute inset-0 opacity-0 cursor-pointer z-10"
                                                                >
                                                                <div class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl flex items-center gap-3 group-hover/file:border-indigo-600 transition-all">
                                                                    <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                                                    </div>
                                                                    <span class="text-xs font-bold text-slate-500">Choose file or drag & drop</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">External Asset URL</label>
                                                            <input 
                                                                type="text" 
                                                                name="contents[{{ $item->key }}]" 
                                                                value="{{ old("contents.$item->key", $item->value) }}"
                                                                placeholder="https://..."
                                                                class="input-premium !py-2.5"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-[10px] text-slate-400 font-bold flex items-center gap-2">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                                    RECOMMENDED: TRANSPARENT PNG / WEB-OPTIMIZED ASSETS (MAX 2MB)
                                                </p>
                                            </div>
                                        @elseif($item->type === 'number')
                                            <input 
                                                type="number" 
                                                name="contents[{{ $item->key }}]" 
                                                value="{{ old("contents.$item->key", $item->value) }}"
                                                class="input-premium"
                                            >
                                        @else
                                            <input 
                                                type="text" 
                                                name="contents[{{ $item->key }}]" 
                                                value="{{ old("contents.$item->key", $item->value) }}"
                                                class="input-premium"
                                                placeholder="Enter {{ strtolower($item->label) }}..."
                                            >
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach

                @if($contents->isNotEmpty())
                    <div class="flex justify-end pt-4 pb-12">
                        <button type="submit" class="group relative px-12 py-4 bg-slate-900 text-white font-black uppercase tracking-widest text-[11px] rounded-2xl hover:bg-indigo-600 transition-all duration-300 shadow-2xl shadow-slate-900/20 hover:shadow-indigo-600/30">
                            <span class="relative z-10 flex items-center gap-3">
                                {{ __('Deploy Updates') }}
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </button>
                    </div>
                @endif
            </div>
        </form>
    </div>
</x-app-layout>
