<div class="space-y-10">
    <!-- 1. Manager Identification -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Manager Identification') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Essential identification and contact details for the site manager.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <!-- Profile Picture Section -->
            <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100">
                <div class="relative">
                    <div class="w-32 h-32 rounded-2xl bg-slate-50 border-2 border-slate-200 overflow-hidden flex items-center justify-center shadow-inner">
                        <img id="photo_preview" 
                            src="{{ isset($siteManager) && $siteManager->photo_path ? asset('storage/' . $siteManager->photo_path) : 'https://ui-avatars.com/api/?name=Manager&background=6366f1&color=fff&size=128' }}" 
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
                            {{ isset($siteManager) && $siteManager->photo_path ? __('Re-upload Photo') : __('Add Photo') }}
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
                <!-- Manager Unique ID -->
                @if(isset($siteManager) && $siteManager->exists)
                <div class="md:col-span-2">
                    <x-input-label for="manager_unique_id" :value="__('Manager Unique ID')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="manager_unique_id" type="text" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-100 border-slate-200 rounded-xl text-slate-500 font-semibold" 
                        :value="$siteManager->manager_unique_id" readonly />
                </div>
                @endif

                <!-- Full Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="name" name="name" type="text" 
                        placeholder="e.g. John Doe"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('name', $siteManager->name ?? '')" required autofocus />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('name')" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email Address (Login ID)')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="email" name="email" type="email" 
                        placeholder="john.doe@example.com"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('email', $siteManager->email ?? '')" required />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('email')" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative group">
                        <x-text-input id="password" name="password" type="password" 
                            placeholder="••••••••"
                            class="mt-0 block w-full px-4 py-3 pr-12 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                            :required="!isset($siteManager)" />
                        <button type="button" onclick="togglePasswordVisibility('password', 'password_icon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-indigo-600 transition-colors">
                            <svg id="password_icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <path class="eye-closed hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    <p class="mt-1 text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ isset($siteManager) ? __('Leave blank to keep current password') : __('Minimum 8 characters') }}</p>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('password')" />
                </div>

                <!-- Mobile Number -->
                <div>
                    <x-input-label for="phone" :value="__('Mobile Number')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="phone" name="phone" type="text" 
                        placeholder="9876543210"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('phone', $siteManager->phone ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('phone')" />
                </div>

                <!-- Father Name -->
                <div>
                    <x-input-label for="father_name" :value="__('Father Name')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="father_name" name="father_name" type="text" 
                        placeholder="e.g. Richard Doe"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('father_name', $siteManager->father_name ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('father_name')" />
                </div>

                <!-- Qualification -->
                <div>
                    <x-input-label for="qualification" :value="__('Highest Qualification')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="qualification" name="qualification" type="text" 
                        placeholder="e.g. B.Tech in Civil Engineering"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('qualification', $siteManager->qualification ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('qualification')" />
                </div>

                <!-- Working Experience -->
                <div>
                    <x-input-label for="experience" :value="__('Working Experience')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="experience" name="experience" type="text" 
                        placeholder="e.g. 5 Years in Road Construction"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('experience', $siteManager->experience ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('experience')" />
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Employment Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Employment Details') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Salary and project assignment information.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Project Selection -->
                <div>
                    <x-input-label for="project_id" :value="__('Assigned Project')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <select id="project_id" name="project_id" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold">
                        <option value="">Select Project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id', $siteManager->project_id ?? '') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('project_id')" />
                </div>

                <!-- Joining Date -->
                <div>
                    <x-input-label for="joining_date" :value="__('Joining Date')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="joining_date" name="joining_date" type="date" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" 
                        :value="old('joining_date', $siteManager->joining_date ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('joining_date')" />
                </div>

                <!-- Salary Amount -->
                <div>
                    <x-input-label for="salary_amount" :value="__('Salary/Wage Amount')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-500 font-bold group-focus-within:text-indigo-600 transition-colors">₹</span>
                        </div>
                        <x-text-input id="salary_amount" name="salary_amount" type="number" step="0.01" 
                            placeholder="0.00"
                            class="mt-0 block w-full pl-8 px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                            :value="old('salary_amount', $siteManager->salary_amount ?? '')" required />
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('salary_amount')" />
                </div>

                <!-- Salary Type -->
                <div>
                    <x-input-label for="salary_type" :value="__('Salary Cycle')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <select id="salary_type" name="salary_type" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" required>
                        <option value="Monthly" {{ old('salary_type', $siteManager->salary_type ?? '') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="Daily" {{ old('salary_type', $siteManager->salary_type ?? '') == 'Daily' ? 'selected' : '' }}>Daily</option>
                        <option value="Weekly" {{ old('salary_type', $siteManager->salary_type ?? '') == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                    </select>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('salary_type')" />
                </div>

                <!-- Status -->
                <div>
                    <x-input-label for="status" :value="__('Employment Status')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <select id="status" name="status" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" required>
                        <option value="Active" {{ old('status', $siteManager->status ?? 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('status', $siteManager->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="On Leave" {{ old('status', $siteManager->status ?? '') == 'On Leave' ? 'selected' : '' }}>On Leave</option>
                    </select>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('status')" />
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Professional Work Experience -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Professional Work Experience') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Details about previous jobs and accomplishments.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 space-y-4">
            <div id="experience-container" class="space-y-4">
                @php
                    $experiences = old('experiences', isset($siteManager) ? $siteManager->experiences->toArray() : []);
                @endphp

                @foreach($experiences as $index => $experience)
                    <div class="experience-item bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6 relative group">
                        <button type="button" onclick="removeExperience(this)" class="absolute top-4 right-4 text-slate-400 hover:text-rose-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label :value="__('Job Title')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                                <x-text-input name="experiences[{{ $index }}][job_title]" type="text" placeholder="e.g. Senior Site Supervisor"
                                    class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" 
                                    :value="$experience['job_title'] ?? ''" />
                            </div>
                            <div>
                                <x-input-label :value="__('Company Name')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                                <x-text-input name="experiences[{{ $index }}][company_name]" type="text" placeholder="e.g. ABC Construction Ltd."
                                    class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" 
                                    :value="$experience['company_name'] ?? ''" />
                            </div>
                            <div>
                                <x-input-label :value="__('Location')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                                <x-text-input name="experiences[{{ $index }}][location]" type="text" placeholder="e.g. Mumbai, Maharashtra"
                                    class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" 
                                    :value="$experience['location'] ?? ''" />
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label :value="__('Starting Date')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                                    <x-text-input name="experiences[{{ $index }}][start_date]" type="date"
                                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" 
                                        :value="$experience['start_date'] ?? ''" />
                                </div>
                                <div>
                                    <x-input-label :value="__('Ending Date')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                                    <x-text-input name="experiences[{{ $index }}][end_date]" type="date"
                                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" 
                                        :value="$experience['end_date'] ?? ''" />
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label :value="__('Key Responsibilities & Achievements')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                                <textarea name="experiences[{{ $index }}][responsibilities_achievements]" rows="3"
                                    class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400"
                                    placeholder="Describe your role and what you achieved...">{{ $experience['responsibilities_achievements'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <button type="button" onclick="addExperience()" class="w-full py-4 border-2 border-dashed border-slate-200 rounded-2xl text-slate-500 font-bold hover:border-indigo-600 hover:text-indigo-600 transition-all flex items-center justify-center gap-2 group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ __('Add Professional Work Experience') }}
            </button>
        </div>
    </div>

    <!-- 4. Address Details -->
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
                        rows="3" placeholder="Enter current address">{{ old('current_address', $siteManager->current_address ?? '') }}</textarea>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('current_address')" />
                </div>

                <!-- Permanent Address -->
                <div class="md:col-span-2">
                    <x-input-label for="permanent_address" :value="__('Permanent Address')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <textarea id="permanent_address" name="permanent_address" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        rows="3" placeholder="Enter permanent address (optional)">{{ old('permanent_address', $siteManager->permanent_address ?? '') }}</textarea>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('permanent_address')" />
                </div>

                <!-- City -->
                <div>
                    <x-input-label for="city" :value="__('City')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="city" name="city" type="text" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('city', $siteManager->city ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('city')" />
                </div>

                <!-- State -->
                <div>
                    <x-input-label for="state" :value="__('State')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="state" name="state" type="text" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('state', $siteManager->state ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('state')" />
                </div>

                <!-- Pincode -->
                <div>
                    <x-input-label for="pincode" :value="__('Pincode')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="pincode" name="pincode" type="text" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('pincode', $siteManager->pincode ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('pincode')" />
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Education & Certificates -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Education & Certificates') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Upload educational qualifications and skilled certificates.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- 10th Details -->
                <div class="md:col-span-2 p-6 bg-slate-50/50 rounded-2xl border border-slate-100 space-y-4">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest border-b border-slate-100 pb-2">{{ __('10th Education Details') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <x-input-label for="tenth_passing_year" :value="__('Year of Passing')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2" />
                            <x-text-input id="tenth_passing_year" name="tenth_passing_year" type="text" placeholder="e.g. 2015"
                                class="w-full px-3 py-2 text-xs" :value="old('tenth_passing_year', $siteManager->tenth_passing_year ?? '')" />
                        </div>
                        <div>
                            <x-input-label for="tenth_percentage" :value="__('Percentage (%)')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2" />
                            <x-text-input id="tenth_percentage" name="tenth_percentage" type="text" placeholder="e.g. 85%"
                                class="w-full px-3 py-2 text-xs" :value="old('tenth_percentage', $siteManager->tenth_percentage ?? '')" />
                        </div>
                        <div>
                            <x-input-label for="tenth_board" :value="__('Board')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2" />
                            <x-text-input id="tenth_board" name="tenth_board" type="text" placeholder="e.g. CBSE / State Board"
                                class="w-full px-3 py-2 text-xs" :value="old('tenth_board', $siteManager->tenth_board ?? '')" />
                        </div>
                    </div>
                    <div>
                        <x-input-label for="certificate_10th_path" :value="__('10th Certificate File')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2" />
                        <input type="file" id="certificate_10th_path" name="certificate_10th_path" 
                            class="mt-0 block w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                        @if(isset($siteManager) && $siteManager->certificate_10th_path)
                            <a href="{{ asset('storage/' . $siteManager->certificate_10th_path) }}" target="_blank" class="mt-2 inline-flex items-center text-[10px] font-bold text-indigo-600 hover:text-indigo-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                View 10th Certificate
                            </a>
                        @endif
                        <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('certificate_10th_path')" />
                    </div>
                </div>

                <!-- 12th Details -->
                <div class="md:col-span-2 p-6 bg-slate-50/50 rounded-2xl border border-slate-100 space-y-4">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest border-b border-slate-100 pb-2">{{ __('12th Education Details') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <x-input-label for="twelfth_passing_year" :value="__('Year of Passing')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2" />
                            <x-text-input id="twelfth_passing_year" name="twelfth_passing_year" type="text" placeholder="e.g. 2017"
                                class="w-full px-3 py-2 text-xs" :value="old('twelfth_passing_year', $siteManager->twelfth_passing_year ?? '')" />
                        </div>
                        <div>
                            <x-input-label for="twelfth_percentage" :value="__('Percentage (%)')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2" />
                            <x-text-input id="twelfth_percentage" name="twelfth_percentage" type="text" placeholder="e.g. 82%"
                                class="w-full px-3 py-2 text-xs" :value="old('twelfth_percentage', $siteManager->twelfth_percentage ?? '')" />
                        </div>
                        <div>
                            <x-input-label for="twelfth_board" :value="__('Board')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2" />
                            <x-text-input id="twelfth_board" name="twelfth_board" type="text" placeholder="e.g. CBSE / State Board"
                                class="w-full px-3 py-2 text-xs" :value="old('twelfth_board', $siteManager->twelfth_board ?? '')" />
                        </div>
                    </div>
                    <div>
                        <x-input-label for="certificate_12th_path" :value="__('12th Certificate File')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2" />
                        <input type="file" id="certificate_12th_path" name="certificate_12th_path" 
                            class="mt-0 block w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                        @if(isset($siteManager) && $siteManager->certificate_12th_path)
                            <a href="{{ asset('storage/' . $siteManager->certificate_12th_path) }}" target="_blank" class="mt-2 inline-flex items-center text-[10px] font-bold text-indigo-600 hover:text-indigo-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                View 12th Certificate
                            </a>
                        @endif
                        <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('certificate_12th_path')" />
                    </div>
                </div>

                <!-- Graduation Details -->
                <div class="md:col-span-2 p-6 bg-slate-50/50 rounded-2xl border border-slate-100 space-y-4">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest border-b border-slate-100 pb-2">{{ __('Graduation Education Details') }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <x-input-label for="graduation_passing_year" :value="__('Year of Passing')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2" />
                            <x-text-input id="graduation_passing_year" name="graduation_passing_year" type="text" placeholder="e.g. 2020"
                                class="w-full px-3 py-2 text-xs" :value="old('graduation_passing_year', $siteManager->graduation_passing_year ?? '')" />
                        </div>
                        <div>
                            <x-input-label for="graduation_percentage" :value="__('Percentage (%)')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2" />
                            <x-text-input id="graduation_percentage" name="graduation_percentage" type="text" placeholder="e.g. 75%"
                                class="w-full px-3 py-2 text-xs" :value="old('graduation_percentage', $siteManager->graduation_percentage ?? '')" />
                        </div>
                        <div>
                            <x-input-label for="graduation_university" :value="__('University')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2" />
                            <x-text-input id="graduation_university" name="graduation_university" type="text" placeholder="e.g. Mumbai University"
                                class="w-full px-3 py-2 text-xs" :value="old('graduation_university', $siteManager->graduation_university ?? '')" />
                        </div>
                    </div>
                    <div>
                        <x-input-label for="graduation_certificate_path" :value="__('Graduation Certificate File')" class="text-slate-700 font-bold text-[10px] uppercase tracking-wider mb-2" />
                        <input type="file" id="graduation_certificate_path" name="graduation_certificate_path" 
                            class="mt-0 block w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                        @if(isset($siteManager) && $siteManager->graduation_certificate_path)
                            <a href="{{ asset('storage/' . $siteManager->graduation_certificate_path) }}" target="_blank" class="mt-2 inline-flex items-center text-[10px] font-bold text-indigo-600 hover:text-indigo-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                View Graduation Certificate
                            </a>
                        @endif
                        <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('graduation_certificate_path')" />
                    </div>
                </div>

                <!-- Skilled Certificate -->
                <div>
                    <x-input-label for="skilled_certificate_path" :value="__('Skilled Certificate')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <input type="file" id="skilled_certificate_path" name="skilled_certificate_path" 
                        class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                    @if(isset($siteManager) && $siteManager->skilled_certificate_path)
                        <a href="{{ asset('storage/' . $siteManager->skilled_certificate_path) }}" target="_blank" class="mt-2 inline-flex items-center text-[10px] font-bold text-indigo-600 hover:text-indigo-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            View Skilled Certificate
                        </a>
                    @endif
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('skilled_certificate_path')" />
                </div>
            </div>
        </div>
    </div>

    <!-- 5. Documents & Remarks -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Documents & Remarks') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Upload ID proofs and add any relevant notes.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- ID Proof -->
                <div>
                    <x-input-label for="id_proof_path" :value="__('ID Proof (Aadhaar/Voter)')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <input type="file" id="id_proof_path" name="id_proof_path" 
                        class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                    @if(isset($siteManager) && $siteManager->id_proof_path)
                        <a href="{{ asset('storage/' . $siteManager->id_proof_path) }}" target="_blank" class="mt-2 inline-flex items-center text-[10px] font-bold text-indigo-600 hover:text-indigo-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            View Current ID Proof
                        </a>
                    @endif
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('id_proof_path')" />
                </div>

                <!-- PAN Proof -->
                <div>
                    <x-input-label for="pan_proof_path" :value="__('PAN Card Proof')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <input type="file" id="pan_proof_path" name="pan_proof_path" 
                        class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                    @if(isset($siteManager) && $siteManager->pan_proof_path)
                        <a href="{{ asset('storage/' . $siteManager->pan_proof_path) }}" target="_blank" class="mt-2 inline-flex items-center text-[10px] font-bold text-indigo-600 hover:text-indigo-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            View Current PAN Proof
                        </a>
                    @endif
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('pan_proof_path')" />
                </div>

                <!-- Remarks -->
                <div class="md:col-span-2">
                    <x-input-label for="remarks" :value="__('Additional Remarks')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <textarea id="remarks" name="remarks" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        rows="3" placeholder="Any additional notes about the manager">{{ old('remarks', $siteManager->remarks ?? '') }}</textarea>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('remarks')" />
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        const openPaths = icon.querySelectorAll('.eye-open');
        const closedPaths = icon.querySelectorAll('.eye-closed');

        if (input.type === 'password') {
            input.type = 'text';
            openPaths.forEach(p => p.classList.add('hidden'));
            closedPaths.forEach(p => p.classList.remove('hidden'));
        } else {
            input.type = 'password';
            openPaths.forEach(p => p.classList.remove('hidden'));
            closedPaths.forEach(p => p.classList.add('hidden'));
        }
    }

    let experienceIndex = {{ count(old('experiences', isset($siteManager) ? $siteManager->experiences : [])) }};

    function addExperience() {
        const container = document.getElementById('experience-container');
        const template = `
            <div class="experience-item bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6 relative group">
                <button type="button" onclick="removeExperience(this)" class="absolute top-4 right-4 text-slate-400 hover:text-rose-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-bold text-xs uppercase tracking-[0.2em] text-slate-700 mb-2 tracking-wider ml-1">Job Title</label>
                        <input name="experiences[${experienceIndex}][job_title]" type="text" placeholder="e.g. Senior Site Supervisor"
                            class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold shadow-sm">
                    </div>
                    <div>
                        <label class="block font-bold text-xs uppercase tracking-[0.2em] text-slate-700 mb-2 tracking-wider ml-1">Company Name</label>
                        <input name="experiences[${experienceIndex}][company_name]" type="text" placeholder="e.g. ABC Construction Ltd."
                            class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold shadow-sm">
                    </div>
                    <div>
                        <label class="block font-bold text-xs uppercase tracking-[0.2em] text-slate-700 mb-2 tracking-wider ml-1">Location</label>
                        <input name="experiences[${experienceIndex}][location]" type="text" placeholder="e.g. Mumbai, Maharashtra"
                            class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold shadow-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-xs uppercase tracking-[0.2em] text-slate-700 mb-2 tracking-wider ml-1">Starting Date</label>
                            <input name="experiences[${experienceIndex}][start_date]" type="date"
                                class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold shadow-sm">
                        </div>
                        <div>
                            <label class="block font-bold text-xs uppercase tracking-[0.2em] text-slate-700 mb-2 tracking-wider ml-1">Ending Date</label>
                            <input name="experiences[${experienceIndex}][end_date]" type="date"
                                class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold shadow-sm">
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block font-bold text-xs uppercase tracking-[0.2em] text-slate-700 mb-2 tracking-wider ml-1">Key Responsibilities & Achievements</label>
                        <textarea name="experiences[${experienceIndex}][responsibilities_achievements]" rows="3"
                            class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400 shadow-sm"
                            placeholder="Describe your role and what you achieved..."></textarea>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
        experienceIndex++;
    }

    function removeExperience(button) {
        button.closest('.experience-item').remove();
    }
</script>
