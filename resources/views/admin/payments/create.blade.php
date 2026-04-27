<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Record New Project Payment') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Enter the payment details received from the client.') }}
                </p>
            </div>
            <a href="{{ route('project-payments.history') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition-all text-sm shadow-sm">
                {{ __('View History') }}
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <form action="{{ route('project-payments.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="project_id" class="text-xs font-black uppercase tracking-widest text-slate-500">{{ __('Project') }}</label>
                        <select name="project_id" id="project_id" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-600 focus:border-indigo-600 transition-all" required>
                            <option value="">{{ __('Select Project') }}</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ (isset($selected_project_id) && $selected_project_id == $project->id) ? 'selected' : '' }}>
                                    {{ $project->name }} (Budget: ₹{{ number_format($project->total_budget, 2) }} | Paid: ₹{{ number_format($project->total_paid, 2) }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                    </div>

                    <div class="space-y-2">
                        <label for="amount_paid" class="text-xs font-black uppercase tracking-widest text-slate-500">{{ __('Amount Paid (₹)') }}</label>
                        <input type="number" step="0.01" name="amount_paid" id="amount_paid" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-600 focus:border-indigo-600 transition-all" required placeholder="0.00">
                        <x-input-error :messages="$errors->get('amount_paid')" class="mt-2" />
                    </div>

                    <div class="space-y-2">
                        <label for="payment_date" class="text-xs font-black uppercase tracking-widest text-slate-500">{{ __('Payment Date') }}</label>
                        <input type="date" name="payment_date" id="payment_date" value="{{ date('Y-m-d') }}" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-600 focus:border-indigo-600 transition-all" required>
                        <x-input-error :messages="$errors->get('payment_date')" class="mt-2" />
                    </div>

                    <div class="space-y-2">
                        <label for="payment_mode" class="text-xs font-black uppercase tracking-widest text-slate-500">{{ __('Payment Mode') }}</label>
                        <select name="payment_mode" id="payment_mode" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-600 focus:border-indigo-600 transition-all" required>
                            <option value="Cash">{{ __('Cash') }}</option>
                            <option value="Bank Transfer">{{ __('Bank Transfer') }}</option>
                            <option value="Cheque">{{ __('Cheque') }}</option>
                            <option value="UPI">{{ __('UPI') }}</option>
                            <option value="Credit/Debit Card">{{ __('Credit/Debit Card') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('payment_mode')" class="mt-2" />
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label for="reference_no" class="text-xs font-black uppercase tracking-widest text-slate-500">{{ __('Reference No / Transaction ID') }}</label>
                        <input type="text" name="reference_no" id="reference_no" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-600 focus:border-indigo-600 transition-all" placeholder="TXN123456789">
                        <x-input-error :messages="$errors->get('reference_no')" class="mt-2" />
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label for="note" class="text-xs font-black uppercase tracking-widest text-slate-500">{{ __('Note / Internal Remarks') }}</label>
                        <textarea name="note" id="note" rows="3" class="w-full bg-slate-50 border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-600 focus:border-indigo-600 transition-all" placeholder="e.g., First installment for foundation work..."></textarea>
                        <x-input-error :messages="$errors->get('note')" class="mt-2" />
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label for="proof_image" class="text-xs font-black uppercase tracking-widest text-slate-500">{{ __('Payment Proof Image') }}</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="proof_image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-200 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-3 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-2 text-xs font-black text-slate-500 uppercase tracking-widest">{{ __('Click to upload proof') }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">SVG, PNG, JPG or GIF (MAX. 2MB)</p>
                                </div>
                                <input id="proof_image" name="proof_image" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('proof_image')" class="mt-2" />
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                    <button type="reset" class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-all text-sm uppercase tracking-widest">
                        {{ __('Reset') }}
                    </button>
                    <button type="submit" class="px-8 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-black rounded-xl transition-all text-sm uppercase tracking-widest shadow-lg shadow-indigo-600/20">
                        {{ __('Save Payment') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
