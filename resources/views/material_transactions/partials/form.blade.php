<div class="space-y-10">
    <!-- Context Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Context & Material') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Select the project and the material involved in this transaction.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Project -->
                <div class="md:col-span-2">
                    <x-input-label for="project_id" :value="__('Project')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative">
                        <select id="project_id" name="project_id" 
                            class="mt-0 block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[52px] appearance-none cursor-pointer" required>
                            <option value="">{{ __('SELECT PROJECT') }}</option>
                            @foreach($projects as $p)
                                <option value="{{ $p->id }}" {{ (old('project_id', $transaction->project_id ?? '') == $p->id) || (($selectedProjectId ?? '') == $p->id) ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('project_id')" />
                </div>

                <!-- Material -->
                <div class="md:col-span-2">
                    <x-input-label for="material_id" :value="__('Material')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative">
                        <select id="material_id" name="material_id" 
                            class="mt-0 block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[52px] appearance-none cursor-pointer" required>
                            <option value="">{{ __('SELECT MATERIAL') }}</option>
                            @foreach($materials as $m)
                                <option value="{{ $m->id }}" {{ (old('material_id', $transaction->material_id ?? '') == $m->id) || (($selectedMaterialId ?? '') == $m->id) ? 'selected' : '' }}>
                                    {{ $m->name }} ({{ $m->unit }})
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('material_id')" />
                </div>
            </div>
        </div>
    </div>

    <!-- Movement Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Inventory Movement') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Specify the type, quantity, and date of the material movement.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Transaction Type -->
                <div>
                    <x-input-label for="type" :value="__('Movement Type')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative">
                        <select id="type" name="type" 
                            class="mt-0 block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[52px] appearance-none cursor-pointer" required>
                            <option value="purchase" {{ old('type', $transaction->type ?? '') == 'purchase' ? 'selected' : '' }}>{{ __('📥 Purchase (IN)') }}</option>
                            <option value="transfer_in" {{ old('type', $transaction->type ?? '') == 'transfer_in' ? 'selected' : '' }}>{{ __('🚛 Transfer In (IN)') }}</option>
                            <option value="transfer_out" {{ old('type', $transaction->type ?? '') == 'transfer_out' ? 'selected' : '' }}>{{ __('📤 Transfer Out (OUT)') }}</option>
                            <option value="consumption" {{ old('type', $transaction->type ?? '') == 'consumption' ? 'selected' : '' }}>{{ __('🏗️ Consumption (OUT)') }}</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('type')" />
                </div>

                <!-- Quantity -->
                <div>
                    <x-input-label for="quantity" :value="__('Quantity')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="quantity" name="quantity" type="number" step="0.01" 
                        placeholder="0.00"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-bold text-xl placeholder-slate-400" 
                        :value="old('quantity', $transaction->quantity ?? '')" required />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('quantity')" />
                </div>

                <!-- Date -->
                <div>
                    <x-input-label for="date" :value="__('Transaction Date')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="date" name="date" type="date" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" 
                        :value="old('date', $transaction->date ?? date('Y-m-d'))" required />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('date')" />
                </div>

                <!-- Rate (Optional) -->
                <div>
                    <x-input-label for="rate" :value="__('Rate (₹ per unit)')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-500 font-bold group-focus-within:text-indigo-600 transition-colors">₹</span>
                        </div>
                        <x-text-input id="rate" name="rate" type="number" step="0.01" 
                            placeholder="0.00"
                            class="mt-0 block w-full pl-10 px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                            :value="old('rate', $transaction->rate ?? '')" />
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('rate')" />
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor & Billing Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Vendor & Billing') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Information about the supplier and payment documentation.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Vendor (Optional) -->
                <div>
                    <x-input-label for="vendor_id" :value="__('Vendor (Optional)')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative">
                        <select id="vendor_id" name="vendor_id" 
                            class="mt-0 block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[52px] appearance-none cursor-pointer">
                            <option value="">{{ __('SELECT VENDOR') }}</option>
                            @foreach($vendors as $v)
                                <option value="{{ $v->id }}" {{ old('vendor_id', $transaction->vendor_id ?? '') == $v->id ? 'selected' : '' }}>
                                    {{ $v->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('vendor_id')" />
                </div>

                <!-- Bill Upload -->
                <div>
                    <x-input-label for="bill" :value="__('Upload Bill (Optional)')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <input id="bill" name="bill" type="file" 
                        class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-600 cursor-pointer hover:bg-slate-100 transition-colors" 
                        accept=".jpg,.jpeg,.png,.pdf" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('bill')" />
                    
                    @if(isset($transaction) && $transaction->bill_path)
                        <div class="mt-4">
                            <a href="{{ Storage::url($transaction->bill_path) }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-50 text-indigo-600 border border-indigo-100 rounded-lg font-bold hover:bg-indigo-100 transition-all uppercase tracking-widest text-[9px]">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                {{ __('View Document') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-12 pt-8 border-t border-slate-100">
    <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4">
        <a href="{{ route('material_transactions.index') }}" 
            class="w-full sm:w-auto px-8 py-2.5 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-600 hover:bg-slate-50 transition-all text-center uppercase tracking-widest">
            {{ __('Discard Changes') }}
        </a>
        <button type="submit" 
            class="w-full sm:w-auto px-12 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-xs hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 uppercase tracking-widest">
            {{ $submitText }}
        </button>
    </div>
</div>
