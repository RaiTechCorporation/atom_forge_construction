<div class="space-y-10">
    <!-- Worker Profile Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Worker Profile') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Essential identification and contact details for the worker.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="md:col-span-2">
                    <x-input-label for="name" :value="__('Worker Full Name')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="name" name="name" type="text" 
                        placeholder="e.g. Ramesh Kumar"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('name', $labour->name ?? '')" required autofocus />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('name')" />
                </div>

                <!-- Phone -->
                <div class="md:col-span-2">
                    <x-input-label for="phone" :value="__('Contact Number')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
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

    <!-- Skill & Compensation Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Skill & Wages') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Define the worker skill set and their daily compensation rate.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Work Type -->
                <div>
                    <x-input-label for="work_type" :value="__('Work Category')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="work_type" name="work_type" type="text" 
                        placeholder="e.g. Mason, Electrician, Helper"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('work_type', $labour->work_type ?? '')" required />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('work_type')" />
                </div>

                <!-- Wage Rate -->
                <div>
                    <x-input-label for="wage_rate" :value="__('Daily Wage Rate')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
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
