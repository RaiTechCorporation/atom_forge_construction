<div class="space-y-10">
    <!-- Investment Details Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Investment Details') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Primary information about the capital contribution.') }}
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

                <!-- Investment Amount -->
                <div>
                    <x-input-label for="investment_amount" :value="__('Investment Amount')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-500 font-bold group-focus-within:text-indigo-600 transition-colors">₹</span>
                        </div>
                        <x-text-input id="investment_amount" name="investment_amount" type="number" step="0.01" 
                            placeholder="0.00"
                            class="mt-0 block w-full pl-10 px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-bold text-xl placeholder-slate-400" 
                            :value="old('investment_amount')" required />
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('investment_amount')" />
                </div>

                <!-- Investment Date -->
                <div>
                    <x-input-label for="investment_date" :value="__('Investment Date')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="investment_date" name="investment_date" type="date" 
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold" 
                        :value="old('investment_date', date('Y-m-d'))" required />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('investment_date')" />
                </div>
            </div>
        </div>
    </div>

    <!-- Terms & Payouts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="col-span-1">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ __('Terms & Payouts') }}</h3>
            <p class="mt-2 text-sm text-slate-500 font-medium leading-relaxed">
                {{ __('Define return expectations and payout frequency.') }}
            </p>
        </div>

        <div class="col-span-1 lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Expected Return -->
                <div>
                    <x-input-label for="expected_return" :value="__('Expected Return (%)')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="expected_return" name="expected_return" type="number" step="0.01" 
                        placeholder="e.g. 12.5"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('expected_return')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('expected_return')" />
                </div>

                <!-- Profit Share -->
                <div>
                    <x-input-label for="profit_share" :value="__('Profit Share (%)')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <x-text-input id="profit_share" name="profit_share" type="number" step="0.01" 
                        placeholder="e.g. 5.0"
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-semibold placeholder-slate-400" 
                        :value="old('profit_share')" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('profit_share')" />
                </div>

                <!-- Payout Cycle -->
                <div>
                    <x-input-label for="payout_cycle" :value="__('Payout Cycle')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <div class="relative">
                        <select id="payout_cycle" name="payout_cycle" 
                            class="mt-0 block w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-sm font-semibold text-slate-900 h-[52px] appearance-none cursor-pointer" required>
                            <option value="monthly" {{ old('payout_cycle') == 'monthly' ? 'selected' : '' }}>{{ __('Monthly') }}</option>
                            <option value="quarterly" {{ old('payout_cycle') == 'quarterly' ? 'selected' : '' }}>{{ __('Quarterly') }}</option>
                            <option value="end" {{ old('payout_cycle') == 'end' ? 'selected' : '' }}>{{ __('At the End') }}</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('payout_cycle')" />
                </div>

                <!-- Agreement File -->
                <div>
                    <x-input-label for="agreement" :value="__('Agreement (PDF)')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <input type="file" id="agreement" name="agreement" accept=".pdf"
                        class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-900 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all cursor-pointer" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('agreement')" />
                </div>

                <!-- Payment Proof -->
                <div>
                    <x-input-label for="payment_proof" :value="__('Payment Proof (Image)')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <input type="file" id="payment_proof" name="payment_proof" accept="image/*"
                        class="mt-0 block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-900 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all cursor-pointer" />
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('payment_proof')" />
                </div>

                <!-- Notes -->
                <div class="md:col-span-2">
                    <x-input-label for="notes" :value="__('Notes')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                    <textarea id="notes" name="notes" rows="4" 
                        placeholder="Additional details about this investment..."
                        class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 rounded-xl transition-all duration-200 text-slate-900 font-medium placeholder-slate-400">{{ old('notes') }}</textarea>
                    <x-input-error class="mt-2 font-bold text-rose-600 text-[10px]" :messages="$errors->get('notes')" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-12 pt-8 border-t border-slate-100">
    <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4">
        <a href="{{ route('investments.index') }}" 
            class="w-full sm:w-auto px-8 py-2.5 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-600 hover:bg-slate-50 transition-all text-center uppercase tracking-widest">
            {{ __('Discard') }}
        </a>
        <button type="submit" 
            class="w-full sm:w-auto px-12 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-xs hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20 uppercase tracking-widest">
            {{ $submitText }}
        </button>
    </div>
</div>
