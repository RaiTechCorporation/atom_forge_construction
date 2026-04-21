<div class="space-y-10">
    <!-- Vendor Profile Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Vendor Profile') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Official company name and primary contact person details.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="md:col-span-2">
                    <x-input-label for="name" :value="__('Vendor / Company Name')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="name" name="name" type="text" 
                        placeholder="e.g. Acme Construction Supplies"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('name', $vendor->name ?? '')" required autofocus />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('name')" />
                </div>

                <!-- Contact Person -->
                <div class="md:col-span-2">
                    <x-input-label for="contact_person" :value="__('Primary Contact Person')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="contact_person" name="contact_person" type="text" 
                        placeholder="e.g. John Doe"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('contact_person', $vendor->contact_person ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('contact_person')" />
                </div>
            </div>
        </div>
    </div>

    <!-- Communication Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Communication') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('How we reach this vendor for orders and inquiries.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Phone -->
                <div>
                    <x-input-label for="phone" :value="__('Phone Number')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="phone" name="phone" type="text" 
                        placeholder="e.g. +91 98765 43210"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('phone', $vendor->phone ?? '')" required />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('phone')" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="email" name="email" type="email" 
                        placeholder="e.g. sales@acme.com"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('email', $vendor->email ?? '')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('email')" />
                </div>

                <!-- Address -->
                <div class="md:col-span-2">
                    <x-input-label for="address" :value="__('Office Address')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <textarea id="address" name="address" rows="3"
                        placeholder="Enter full office or warehouse address"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400 shadow-sm">{{ old('address', $vendor->address ?? '') }}</textarea>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('address')" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-12 pt-8 border-t border-slate-100">
    <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4">
        <a href="{{ route('vendors.index') }}" 
            class="w-full sm:w-auto px-8 py-2.5 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-600 hover:bg-slate-50 transition-all text-center uppercase tracking-widest">
            {{ __('Discard Changes') }}
        </a>
        <button type="submit" 
            class="w-full sm:w-auto px-12 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-xs hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 uppercase tracking-widest">
            {{ $submitText }}
        </button>
    </div>
</div>
