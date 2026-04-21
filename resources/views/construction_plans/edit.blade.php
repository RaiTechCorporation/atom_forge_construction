<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 py-2">
            <div>
                <h2 class="font-black text-3xl text-black leading-tight tracking-tighter uppercase italic">
                    {{ __('Modify Protocol') }}
                </h2>
                <p class="mt-1 text-base font-bold text-slate-800 uppercase tracking-widest text-[10px]">
                    {{ __('Adjust existing construction plan configuration') }}
                </p>
            </div>
            <a href="{{ route('construction-plans.index') }}" class="inline-flex items-center px-8 py-4 bg-white border-4 border-black text-black font-black rounded-xl hover:bg-slate-50 transition-all shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none uppercase tracking-widest text-xs">
                Abort Mission
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2.5rem] border-4 border-black p-10 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
                <form action="{{ route('construction-plans.update', $construction_plan) }}" method="POST" class="space-y-10">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Plan Name -->
                        <div class="space-y-4">
                            <label for="name" class="block text-xs font-black text-black uppercase tracking-[0.2em] italic">Plan Designation</label>
                            <input type="text" name="name" id="name" required value="{{ old('name', $construction_plan->name) }}"
                                   class="w-full py-5 px-8 rounded-2xl border-4 border-black bg-white text-black font-black focus:ring-4 focus:ring-blue-600/20 focus:border-blue-600 transition-all placeholder-slate-300 text-lg uppercase tracking-tight"
                                   placeholder="e.g. ULTRA LUXURY">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Price -->
                        <div class="space-y-4">
                            <label for="price_per_sqft" class="block text-xs font-black text-black uppercase tracking-[0.2em] italic">Fiscal Rate (Per Sq Ft)</label>
                            <div class="relative">
                                <span class="absolute left-8 top-1/2 -translate-y-1/2 text-2xl font-black text-slate-400">₹</span>
                                <input type="number" name="price_per_sqft" id="price_per_sqft" required value="{{ old('price_per_sqft', $construction_plan->price_per_sqft) }}"
                                       class="w-full py-5 pl-14 pr-8 rounded-2xl border-4 border-black bg-white text-black font-black focus:ring-4 focus:ring-blue-600/20 focus:border-blue-600 transition-all text-lg"
                                       placeholder="0.00">
                            </div>
                            <x-input-error :messages="$errors->get('price_per_sqft')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="space-y-4">
                        <label for="features" class="block text-xs font-black text-black uppercase tracking-[0.2em] italic">Structural Specifications (One per line)</label>
                        <textarea name="features" id="features" rows="6"
                                  class="w-full py-5 px-8 rounded-2xl border-4 border-black bg-white text-black font-black focus:ring-4 focus:ring-blue-600/20 focus:border-blue-600 transition-all placeholder-slate-300 font-mono text-sm uppercase tracking-widest leading-relaxed"
                                  placeholder="REINFORCED CONCRETE&#10;SMART HOME INTEGRATION&#10;PREMIUM FLOORING">{{ old('features', is_array($construction_plan->features) ? implode("\n", $construction_plan->features) : '') }}</textarea>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest italic">Note: Separate each feature with a new line (Enter key).</p>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center gap-4 p-6 bg-slate-50 rounded-2xl border-2 border-slate-200">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $construction_plan->is_active) ? 'checked' : '' }}
                               class="w-8 h-8 rounded border-4 border-black text-blue-600 focus:ring-blue-600 focus:ring-offset-2 transition-all">
                        <label for="is_active" class="text-sm font-black text-black uppercase tracking-widest cursor-pointer select-none">Protocol Deployment Active</label>
                    </div>

                    <div class="pt-6 border-t-4 border-black">
                        <button type="submit" class="w-full py-6 bg-indigo-600 border-4 border-black rounded-2xl font-black text-base text-white hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-600/50 active:scale-[0.98] transition-all duration-200 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] uppercase tracking-widest active:translate-x-1 active:translate-y-1 active:shadow-none">
                            Update Plan Protocol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
