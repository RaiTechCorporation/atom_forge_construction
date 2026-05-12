<div class="space-y-10">
    <!-- 1. Labour Identification -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Labour Identification') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Essential identification and contact details for the worker.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <!-- Profile Picture Section -->
            <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100">
                <div class="relative">
                    <div class="w-32 h-32 rounded-2xl bg-slate-50 border-2 border-slate-200 overflow-hidden flex items-center justify-center shadow-inner">
                        <img id="photo_preview" 
                            src="{{ $labour->photo_path ? asset('storage/' . $labour->photo_path) : 'https://ui-avatars.com/api/?name=Worker&background=6366f1&color=fff&size=128' }}" 
                            class="w-full h-full object-cover" 
                            alt="Preview">
                    </div>
                    <label for="photo_path" class="absolute -bottom-1 -right-1 w-10 h-10 bg-indigo-600 text-white rounded-xl flex items-center justify-center cursor-pointer shadow-lg hover:bg-indigo-500 transition-all border-4 border-white z-10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <input type="file" id="photo_path" name="photo_path" class="hidden" accept="image/*" onchange="previewImage(this)">
                    </label>
                </div>
                <div class="flex-1 text-center sm:text-left space-y-2">
                    <div>
                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest">{{ __('Profile Picture') }}</h4>
                        <p class="text-xs font-bold text-slate-500">{{ __('Upload a clear photo for identification.') }}</p>
                    </div>
                    <div class="flex flex-wrap justify-center sm:justify-start gap-3">
                        <button type="button" onclick="document.getElementById('photo_path').click()" class="px-4 py-2 bg-slate-100 text-slate-700 text-[10px] font-black uppercase tracking-widest rounded-lg hover:bg-slate-200 transition-all border border-slate-200">
                            {{ $labour->photo_path ? __('Re-upload Photo') : __('Add Photo') }}
                        </button>
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('photo_path')" />
                </div>
            </div>

            <script>
                function previewImage(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('photo_preview').src = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Labour Unique ID -->
                @if($labour->exists)
                <div class="md:col-span-2">
                    <x-input-label for="labour_unique_id" :value="__('Labour Unique ID')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="labour_unique_id" type="text" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-100 border-slate-200 rounded-xl text-slate-500 font-semibold" 
                        :value="$labour->labour_unique_id" readonly />
                </div>
                @endif

                <!-- Full Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="name" name="name" type="text" 
                        placeholder="e.g. Ramesh Kumar"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('name', $labour->name ?? '')" required autofocus />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('name')" />
                </div>

                <!-- Father Name -->
                <div>
                    <x-input-label for="father_name" :value="__('Father Name')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="father_name" name="father_name" type="text" 
                        placeholder="e.g. Suresh Kumar"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('father_name', $labour->father_name ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('father_name')" />
                </div>

                <!-- Mobile Number -->
                <div class="md:col-span-2">
                    <x-input-label for="phone" :value="__('Mobile Number')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-500 font-bold group-focus-within:text-indigo-600 transition-colors">+91</span>
                        </div>
                        <x-text-input id="phone" name="phone" type="text" 
                            placeholder="9876543210"
                            class="mt-0 block w-full pl-12 px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                            :value="old('phone', $labour->phone ?? '')" />
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('phone')" />
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Address Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Address Details') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Current and permanent residence information.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Current Address -->
                <div class="md:col-span-2">
                    <x-input-label for="current_address" :value="__('Current Address')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <textarea id="current_address" name="current_address" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        rows="3" placeholder="Enter current address">{{ old('current_address', $labour->current_address ?? '') }}</textarea>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('current_address')" />
                </div>

                <!-- Permanent Address -->
                <div class="md:col-span-2">
                    <x-input-label for="permanent_address" :value="__('Permanent Address')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <textarea id="permanent_address" name="permanent_address" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        rows="3" placeholder="Enter permanent address (optional)">{{ old('permanent_address', $labour->permanent_address ?? '') }}</textarea>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('permanent_address')" />
                </div>

                <!-- City -->
                <div>
                    <x-input-label for="city" :value="__('City')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="city" name="city" type="text" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('city', $labour->city ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('city')" />
                </div>

                <!-- State -->
                <div>
                    <x-input-label for="state" :value="__('State')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="state" name="state" type="text" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('state', $labour->state ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('state')" />
                </div>

                <!-- Pincode -->
                <div>
                    <x-input-label for="pincode" :value="__('Pincode')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="pincode" name="pincode" type="text" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('pincode', $labour->pincode ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('pincode')" />
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Working Time / Interval -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Working Time / Interval') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Define shift patterns and daily work timings.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Shift Type -->
                <div>
                    <x-input-label for="shift_type" :value="__('Shift Type')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <select id="shift_type" name="shift_type" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold">
                        <option value="">Select Shift</option>
                        <option value="Full Day" {{ old('shift_type', $labour->shift_type ?? '') == 'Full Day' ? 'selected' : '' }}>Full Day</option>
                        <option value="Half Day" {{ old('shift_type', $labour->shift_type ?? '') == 'Half Day' ? 'selected' : '' }}>Half Day</option>
                        <option value="Hourly" {{ old('shift_type', $labour->shift_type ?? '') == 'Hourly' ? 'selected' : '' }}>Hourly</option>
                    </select>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('shift_type')" />
                </div>

                <!-- Break Time -->
                <div>
                    <x-input-label for="break_time" :value="__('Break Time')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="break_time" name="break_time" type="text" 
                        placeholder="e.g. 1 hour"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('break_time', $labour->break_time ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('break_time')" />
                </div>

                <!-- Start Time -->
                <div>
                    <x-input-label for="start_time" :value="__('Start Time')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="start_time" name="start_time" type="time" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" 
                        :value="old('start_time', $labour->start_time ? \Illuminate\Support\Carbon::parse($labour->start_time)->format('H:i') : '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('start_time')" />
                </div>

                <!-- End Time -->
                <div>
                    <x-input-label for="end_time" :value="__('End Time')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="end_time" name="end_time" type="time" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" 
                        :value="old('end_time', $labour->end_time ? \Illuminate\Support\Carbon::parse($labour->end_time)->format('H:i') : '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('end_time')" />
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Work Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Work Details') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Categorize the worker skill set and project assignment.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Labour Type -->
                <div>
                    <x-input-label for="work_type" :value="__('Labour Type')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="work_type" name="work_type" type="text" 
                        placeholder="e.g. Mason, Helper, Electrician"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('work_type', $labour->work_type ?? '')" required />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('work_type')" />
                </div>

                <!-- Skill Level -->
                <div>
                    <x-input-label for="skill_level" :value="__('Skill Level')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <select id="skill_level" name="skill_level" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold">
                        <option value="">Select Level</option>
                        <option value="Skilled" {{ old('skill_level', $labour->skill_level ?? '') == 'Skilled' ? 'selected' : '' }}>Skilled</option>
                        <option value="Semi-Skilled" {{ old('skill_level', $labour->skill_level ?? '') == 'Semi-Skilled' ? 'selected' : '' }}>Semi-Skilled</option>
                        <option value="Unskilled" {{ old('skill_level', $labour->skill_level ?? '') == 'Unskilled' ? 'selected' : '' }}>Unskilled</option>
                    </select>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('skill_level')" />
                </div>

                <!-- Assigned Project -->
                <div class="md:col-span-2">
                    <x-input-label for="project_id" :value="__('Assigned Project')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <select id="project_id" name="project_id" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold">
                        <option value="">Select Project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id', $labour->project_id ?? '') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('project_id')" />
                </div>
            </div>
        </div>
    </div>

    <!-- 5. Wage & Payment -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Wage & Payment') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Define the compensation structure and rates.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Wage Type -->
                <div>
                    <x-input-label for="wage_type" :value="__('Wage Type')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <select id="wage_type" name="wage_type" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold">
                        <option value="">Select Wage Type</option>
                        <option value="Daily" {{ old('wage_type', $labour->wage_type ?? '') == 'Daily' ? 'selected' : '' }}>Daily</option>
                        <option value="Hourly" {{ old('wage_type', $labour->wage_type ?? '') == 'Hourly' ? 'selected' : '' }}>Hourly</option>
                        <option value="Monthly" {{ old('wage_type', $labour->wage_type ?? '') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                    </select>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('wage_type')" />
                </div>

                <!-- Wage Rate -->
                <div>
                    <x-input-label for="wage_rate" :value="__('Wage Rate')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-500 font-bold group-focus-within:text-indigo-600 transition-colors">₹</span>
                        </div>
                        <x-text-input id="wage_rate" name="wage_rate" type="number" step="0.01" 
                            placeholder="0.00"
                            class="mt-0 block w-full pl-10 px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-bold text-xl placeholder-slate-400" 
                            :value="old('wage_rate', $labour->wage_rate ?? '')" required />
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('wage_rate')" />
                </div>

                <!-- Overtime Rate -->
                <div class="md:col-span-2">
                    <x-input-label for="overtime_rate" :value="__('Overtime Rate (Optional)')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-500 font-bold group-focus-within:text-indigo-600 transition-colors">₹</span>
                        </div>
                        <x-text-input id="overtime_rate" name="overtime_rate" type="number" step="0.01" 
                            placeholder="0.00"
                            class="mt-0 block w-full pl-10 px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                            :value="old('overtime_rate', $labour->overtime_rate ?? '')" />
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('overtime_rate')" />
                </div>
            </div>
        </div>
    </div>

    <!-- 6. Identity Proof -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Identity Proof') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Upload necessary identification documents and photo.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Aadhaar Number -->
                <div>
                    <x-input-label for="aadhaar_number" :value="__('Aadhaar Number')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="aadhaar_number" name="aadhaar_number" type="text" 
                        placeholder="1234 5678 9012"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('aadhaar_number', $labour->aadhaar_number ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('aadhaar_number')" />
                </div>

                <!-- PAN Number -->
                <div>
                    <x-input-label for="pan_number" :value="__('PAN Number')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="pan_number" name="pan_number" type="text" 
                        placeholder="ABCDE1234F"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('pan_number', $labour->pan_number ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('pan_number')" />
                </div>

                <!-- Aadhaar ID Proof Upload -->
                <div>
                    <x-input-label for="id_proof_path" :value="__('Aadhaar ID Proof Upload')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <input id="id_proof_path" name="id_proof_path" type="file" 
                        class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900" />
                    @if($labour->id_proof_path)
                        <p class="mt-2 text-xs text-indigo-600 font-bold">
                            <a href="{{ asset('storage/' . $labour->id_proof_path) }}" target="_blank">{{ __('View Current Aadhaar Proof') }}</a>
                        </p>
                    @endif
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('id_proof_path')" />
                </div>

                <!-- PAN Card ID Proof Upload -->
                <div>
                    <x-input-label for="pan_proof_path" :value="__('PAN Card Proof Upload')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <input id="pan_proof_path" name="pan_proof_path" type="file" 
                        class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900" />
                    @if($labour->pan_proof_path)
                        <p class="mt-2 text-xs text-indigo-600 font-bold">
                            <a href="{{ asset('storage/' . $labour->pan_proof_path) }}" target="_blank">{{ __('View Current PAN Proof') }}</a>
                        </p>
                    @endif
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('pan_proof_path')" />
                </div>
            </div>
        </div>
    </div>

    <!-- 7. Emergency Info -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Emergency Info') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Contact details in case of emergencies.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Emergency Contact Name -->
                <div>
                    <x-input-label for="emergency_contact_name" :value="__('Emergency Contact Name')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="emergency_contact_name" name="emergency_contact_name" type="text" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('emergency_contact_name', $labour->emergency_contact_name ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('emergency_contact_name')" />
                </div>

                <!-- Emergency Contact Number -->
                <div>
                    <x-input-label for="emergency_contact_number" :value="__('Emergency Contact Number')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="emergency_contact_number" name="emergency_contact_number" type="text" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('emergency_contact_number', $labour->emergency_contact_number ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('emergency_contact_number')" />
                </div>
            </div>
        </div>
    </div>

    <!-- 8. Status & Tracking -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Status & Tracking') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Administrative details and current status.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Joining Date -->
                <div>
                    <x-input-label for="joining_date" :value="__('Joining Date')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="joining_date" name="joining_date" type="date" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" 
                        :value="old('joining_date', $labour->joining_date ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('joining_date')" />
                </div>

                <!-- Status -->
                <div>
                    <x-input-label for="status" :value="__('Status')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <select id="status" name="status" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold">
                        <option value="Active" {{ old('status', $labour->status ?? 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('status', $labour->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('status')" />
                </div>

                <!-- Remarks -->
                <div class="md:col-span-2">
                    <x-input-label for="remarks" :value="__('Remarks (Optional)')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <textarea id="remarks" name="remarks" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        rows="3" placeholder="Any additional remarks">{{ old('remarks', $labour->remarks ?? '') }}</textarea>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('remarks')" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-12 pt-8 border-t border-slate-100">
    <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4">
        <a href="{{ route('labour.index') }}" 
            class="w-full sm:w-auto px-8 py-2.5 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-600 hover:bg-slate-50 transition-all text-center uppercase tracking-widest">
            {{ __('Discard Changes') }}
        </a>
        <button type="submit" 
            class="w-full sm:w-auto px-12 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-xs hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 uppercase tracking-widest">
            {{ $submitText }}
        </button>
    </div>
</div>
