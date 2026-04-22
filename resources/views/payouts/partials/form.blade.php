<div class="space-y-10">
    <!-- Payout Details Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Payout Details') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Information about the return distribution.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Investor -->
                <div>
                    <x-input-label for="investor_id" :value="__('Investor')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative">
                        <select id="investor_id" name="investor_id" 
                            class="mt-0 block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[52px] appearance-none cursor-pointer" required>
                            <option value="" disabled {{ !old('investor_id') ? 'selected' : '' }}>{{ __('Select Investor') }}</option>
                            @foreach($investors as $investor)
                                <option value="{{ $investor->id }}" {{ old('investor_id') == $investor->id ? 'selected' : '' }}>{{ $investor->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('investor_id')" />
                </div>

                <!-- Project -->
                <div>
                    <x-input-label for="project_id" :value="__('Project')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative">
                        <select id="project_id" name="project_id" 
                            class="mt-0 block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[52px] appearance-none cursor-pointer" required>
                            <option value="" disabled {{ !old('project_id') ? 'selected' : '' }}>{{ __('Select Project') }}</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('project_id')" />
                </div>

                <!-- Amount Paid -->
                <div>
                    <x-input-label for="amount_paid" :value="__('Amount Paid')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-500 font-bold group-focus-within:text-indigo-600 transition-colors">₹</span>
                        </div>
                        <x-text-input id="amount_paid" name="amount_paid" type="number" step="0.01" 
                            placeholder="0.00"
                            class="mt-0 block w-full pl-10 px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-bold text-xl placeholder-slate-400" 
                            :value="old('amount_paid')" required />
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('amount_paid')" />
                </div>

                <!-- Payment Date -->
                <div>
                    <x-input-label for="payment_date" :value="__('Payment Date')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="payment_date" name="payment_date" type="date" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" 
                        :value="old('payment_date', date('Y-m-d'))" required />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('payment_date')" />
                </div>

                <!-- Payment Mode -->
                <div>
                    <x-input-label for="payment_mode" :value="__('Payment Mode')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative">
                        <select id="payment_mode" name="payment_mode" 
                            class="mt-0 block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[52px] appearance-none cursor-pointer" required>
                            <option value="bank_transfer" {{ old('payment_mode') == 'bank_transfer' ? 'selected' : '' }}>{{ __('Bank Transfer') }}</option>
                            <option value="cheque" {{ old('payment_mode') == 'cheque' ? 'selected' : '' }}>{{ __('Cheque') }}</option>
                            <option value="cash" {{ old('payment_mode') == 'cash' ? 'selected' : '' }}>{{ __('Cash') }}</option>
                            <option value="upi" {{ old('payment_mode') == 'upi' ? 'selected' : '' }}>{{ __('UPI') }}</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('payment_mode')" />
                </div>

                <!-- Remarks -->
                <div class="md:col-span-2">
                    <x-input-label for="remarks" :value="__('Remarks')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <textarea id="remarks" name="remarks" rows="4" 
                        placeholder="Additional details about this payout..."
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-medium placeholder-slate-400">{{ old('remarks') }}</textarea>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('remarks')" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-12 pt-8 border-t border-slate-100">
    <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4">
        <a href="{{ route('payouts.index') }}" 
            class="w-full sm:w-auto px-8 py-2.5 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-600 hover:bg-slate-50 transition-all text-center uppercase tracking-widest">
            {{ __('Discard') }}
        </a>
        <button type="submit" 
            class="w-full sm:w-auto px-12 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-xs hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 uppercase tracking-widest">
            {{ $submitText }}
        </button>
    </div>
</div>
