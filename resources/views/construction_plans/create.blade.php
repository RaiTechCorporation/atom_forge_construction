<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Initialize New Plan') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Deploy a new construction plan configuration to the ecosystem.') }}
                </p>
            </div>
            <a href="{{ route('construction-plans.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-slate-50 transition-all shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                {{ __('Back to Plans') }}
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-8">
                <form action="{{ route('construction-plans.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Plan Name -->
                        <div class="space-y-2">
                            <label for="name" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Plan Designation') }}</label>
                            <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-900 font-medium placeholder-slate-400"
                                   placeholder="e.g. Ultra Luxury">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Price -->
                        <div class="space-y-2">
                            <label for="price_per_sqft" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Fiscal Rate (Per Sq Ft)') }}</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">₹</span>
                                <input type="number" name="price_per_sqft" id="price_per_sqft" required value="{{ old('price_per_sqft') }}"
                                       class="w-full pl-8 pr-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-900 font-medium"
                                       placeholder="0.00">
                            </div>
                            <x-input-error :messages="$errors->get('price_per_sqft')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="space-y-2">
                        <label for="features" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ __('Structural Specifications (One per line)') }}</label>
                        <textarea name="features" id="features" rows="6"
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-slate-900 font-medium placeholder-slate-400"
                                  placeholder="Reinforced Concrete&#10;Smart Home Integration&#10;Premium Flooring">{{ old('features') }}</textarea>
                        <p class="text-[10px] font-medium text-slate-400 italic">{{ __('Note: Separate each feature with a new line.') }}</p>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 transition-all">
                        <label for="is_active" class="text-sm font-bold text-slate-700 cursor-pointer select-none">{{ __('Protocol Deployment Active') }}</label>
                    </div>

                    <div class="pt-6 border-t border-slate-100">
                        <button type="submit" class="w-full md:w-auto px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 transition-all shadow-sm">
                            {{ __('Deploy Plan Protocol') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
