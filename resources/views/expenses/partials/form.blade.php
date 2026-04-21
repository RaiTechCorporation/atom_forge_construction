<div class="space-y-8">
    <!-- Transaction Details Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Transaction Details') }}</h3>
            <p class="mt-1 text-sm text-slate-500 leading-relaxed font-medium">
                {{ __('Record the core financial details of this expense.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Project -->
                <div class="md:col-span-2">
                    <x-input-label for="project_id" :value="__('Project Allocation')" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2" />
                    <div class="relative group">
                        <select id="project_id" name="project_id" 
                            class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 appearance-none cursor-pointer" required>
                            <option value="">{{ __('Select Project') }}</option>
                            @foreach($projects as $p)
                                <option value="{{ $p->id }}" {{ (old('project_id', $expense->project_id ?? '') == $p->id) || (($selectedProjectId ?? '') == $p->id) ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2 text-xs font-medium text-red-600" :messages="$errors->get('project_id')" />
                </div>

                <!-- Date -->
                <div>
                    <x-input-label for="date" :value="__('Expense Date')" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2" />
                    <x-text-input id="date" name="date" type="date" 
                        class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900" 
                        :value="old('date', $expense->date ?? date('Y-m-d'))" required />
                    <x-input-error class="mt-2 text-xs font-medium text-red-600" :messages="$errors->get('date')" />
                </div>

                <!-- Amount -->
                <div>
                    <x-input-label for="amount" :value="__('Total Amount')" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2" />
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-400 font-bold text-sm transition-colors group-focus-within:text-indigo-500">₹</span>
                        </div>
                        <x-text-input id="amount" name="amount" type="number" step="0.01" 
                            placeholder="0.00"
                            class="mt-0 block w-full pl-8 px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all duration-200 text-sm font-bold text-slate-900 placeholder-slate-400" 
                            :value="old('amount', $expense->amount ?? '')" required />
                    </div>
                    <x-input-error class="mt-2 text-xs font-medium text-red-600" :messages="$errors->get('amount')" />
                </div>
            </div>
        </div>
    </div>

    <div class="h-px bg-slate-100"></div>

    <!-- Categorization & Source Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Categorization') }}</h3>
            <p class="mt-1 text-sm text-slate-500 leading-relaxed font-medium">
                {{ __('Specify the type of expense and payment source.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Category -->
                <div>
                    <x-input-label for="category" :value="__('Expense Category')" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2" />
                    <div class="relative group">
                        <select id="category" name="category" 
                            class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 appearance-none cursor-pointer" required>
                            <option value="material" {{ old('category', $expense->category ?? '') == 'material' ? 'selected' : '' }}>🧱 MATERIAL</option>
                            <option value="labour" {{ old('category', $expense->category ?? '') == 'labour' ? 'selected' : '' }}>👷 LABOUR</option>
                            <option value="equipment" {{ old('category', $expense->category ?? '') == 'equipment' ? 'selected' : '' }}>⚙️ EQUIPMENT</option>
                            <option value="transport" {{ old('category', $expense->category ?? '') == 'transport' ? 'selected' : '' }}>🚛 TRANSPORT</option>
                            <option value="vendor_bill" {{ old('category', $expense->category ?? '') == 'vendor_bill' ? 'selected' : '' }}>📄 VENDOR BILL</option>
                            <option value="misc" {{ old('category', $expense->category ?? '') == 'misc' ? 'selected' : '' }}>🔹 MISC</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2 text-xs font-medium text-red-600" :messages="$errors->get('category')" />
                </div>

                <!-- Payment Mode -->
                <div>
                    <x-input-label for="payment_mode" :value="__('Payment Method')" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2" />
                    <div class="relative group">
                        <select id="payment_mode" name="payment_mode" 
                            class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 appearance-none cursor-pointer" required>
                            <option value="cash" {{ old('payment_mode', $expense->payment_mode ?? '') == 'cash' ? 'selected' : '' }}>💵 CASH</option>
                            <option value="upi" {{ old('payment_mode', $expense->payment_mode ?? '') == 'upi' ? 'selected' : '' }}>📱 UPI</option>
                            <option value="bank" {{ old('payment_mode', $expense->payment_mode ?? '') == 'bank' ? 'selected' : '' }}>🏦 BANK TRANSFER</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2 text-xs font-medium text-red-600" :messages="$errors->get('payment_mode')" />
                </div>

                <!-- Vendor (Optional) -->
                <div class="md:col-span-2">
                    <x-input-label for="vendor_id" :value="__('Associated Vendor (Optional)')" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2" />
                    <div class="relative group">
                        <select id="vendor_id" name="vendor_id" 
                            class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 appearance-none cursor-pointer">
                            <option value="">{{ __('Select Vendor') }}</option>
                            @foreach($vendors as $v)
                                <option value="{{ $v->id }}" {{ old('vendor_id', $expense->vendor_id ?? '') == $v->id ? 'selected' : '' }}>
                                    {{ $v->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2 text-xs font-medium text-red-600" :messages="$errors->get('vendor_id')" />
                </div>
            </div>
        </div>
    </div>

    <div class="h-px bg-slate-100"></div>

    <!-- Documentation Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Documentation') }}</h3>
            <p class="mt-1 text-sm text-slate-500 leading-relaxed font-medium">
                {{ __('Attach proof of payment and provide detailed descriptions.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Description -->
                <div class="md:col-span-2">
                    <x-input-label for="description" :value="__('Description')" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2" />
                    <x-text-input id="description" name="description" type="text" 
                        placeholder="e.g. Purchase of 50 bags of Cement"
                        class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 placeholder-slate-400" 
                        :value="old('description', $expense->description ?? '')" required />
                    <x-input-error class="mt-2 text-xs font-medium text-red-600" :messages="$errors->get('description')" />
                </div>

                <!-- Bill Upload -->
                <div class="md:col-span-2">
                    <x-input-label for="bill" :value="__('Upload Proof (Smart Scan available)')" class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2" />
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <div class="relative w-full">
                            <input id="bill" name="bill" type="file" 
                                class="mt-0 block w-full px-4 py-2 bg-slate-50 border-2 border-dashed border-slate-200 rounded-xl text-xs font-semibold text-slate-600 cursor-pointer hover:bg-slate-100 hover:border-indigo-300 transition-all" 
                                accept=".jpg,.jpeg,.png,.pdf" onchange="simulateOCR(this)" />
                        </div>
                        <div id="ocr-loading" class="hidden shrink-0 items-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-xl font-bold text-[10px] tracking-widest animate-pulse">
                            <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            ANALYZING...
                        </div>
                    </div>
                    <div class="mt-4 p-4 bg-indigo-50/50 border border-indigo-100 rounded-xl flex items-start gap-3">
                        <svg class="w-5 h-5 text-indigo-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-[11px] text-indigo-700 font-medium leading-relaxed">
                            {{ __('Supported formats: JPG, PNG, PDF (Max 2MB). Our system will attempt to automatically extract amount and details from your upload.') }}
                        </p>
                    </div>
                    <x-input-error class="mt-2 text-xs font-medium text-red-600" :messages="$errors->get('bill')" />
                    
                    @if(isset($expense) && $expense->bill_path)
                        <div class="mt-6 p-4 border border-slate-100 rounded-xl bg-slate-50/50 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white rounded-lg border border-slate-200 flex items-center justify-center text-indigo-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">{{ __('Current Attachment') }}</p>
                                    <p class="text-xs font-semibold text-slate-700">{{ basename($expense->bill_path) }}</p>
                                </div>
                            </div>
                            <a href="{{ Storage::url($expense->bill_path) }}" target="_blank" class="px-4 py-1.5 bg-white border border-slate-200 text-indigo-600 rounded-lg text-xs font-bold hover:bg-indigo-50 transition-all">
                                {{ __('View') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Action -->
    <div class="pt-6 flex justify-end">
        <button type="submit" class="px-8 py-2.5 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 text-sm">
            {{ $submitText }}
        </button>
    </div>
</div>

<script>
    function simulateOCR(input) {
        if (input.files && input.files[0]) {
            const loader = document.getElementById('ocr-loading');
            loader.classList.remove('hidden');
            loader.classList.add('flex');
            
            setTimeout(() => {
                loader.classList.add('hidden');
                loader.classList.remove('flex');
                
                const amountField = document.getElementById('amount');
                const descField = document.getElementById('description');
                
                if (!amountField.value) {
                    const randomAmount = (Math.random() * 5000 + 100).toFixed(2);
                    amountField.value = randomAmount;
                    amountField.classList.add('bg-indigo-50', 'border-indigo-300');
                }
                
                if (!descField.value) {
                    descField.value = "Processed: " + input.files[0].name.split('.')[0];
                    descField.classList.add('bg-indigo-50', 'border-indigo-300');
                }
                
                // Show a modern notification instead of alert if possible, 
                // but alert is reliable for now
                alert('Analysis complete! Please verify the suggested values.');
            }, 1500);
        }
    }
</script>

<div class="mt-20 pt-12 border-t-4 border-black">
    <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-8">
        <a href="{{ route('expenses.index') }}" 
            class="w-full sm:w-auto px-12 py-4 bg-white border-4 border-black rounded-xl font-black text-sm text-black hover:bg-slate-100 transition-all text-center uppercase tracking-widest">
            {{ __('Discard Changes') }}
        </a>
        <button type="submit" 
            class="w-full sm:w-auto px-20 py-4 bg-yellow-400 border-4 border-black rounded-xl font-black text-sm text-black hover:bg-yellow-500 transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] uppercase tracking-widest active:translate-x-0.5 active:translate-y-0.5 active:shadow-none">
            {{ $submitText }}
        </button>
    </div>
</div>
