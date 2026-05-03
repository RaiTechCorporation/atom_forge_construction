<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 py-2">
            <div>
                <h2 class="font-black text-3xl text-black leading-tight tracking-tighter">
                    {{ __('Record Manager Payout') }}
                </h2>
                <p class="mt-1 text-base font-bold text-slate-800">
                    {{ __('Log a new salary or bonus payment for a site manager.') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border-2 border-slate-200 p-8 shadow-sm">
                <form action="{{ route('site-managers.payouts.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Manager Selection -->
                        <div class="md:col-span-2">
                            <x-input-label for="site_manager_id" :value="__('Select Site Manager')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                            <select id="site_manager_id" name="site_manager_id" class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-slate-900 font-semibold" required onchange="updateBaseSalary(this)">
                                <option value="">Choose a manager</option>
                                @foreach($managers as $manager)
                                    <option value="{{ $manager->id }}" data-salary="{{ $manager->salary_amount }}">{{ $manager->name }} ({{ $manager->manager_unique_id }})</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('site_manager_id')" />
                        </div>

                        <!-- Month/Cycle -->
                        <div>
                            <x-input-label for="month" :value="__('Payout Month/Cycle')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                            <x-text-input id="month" name="month" type="text" placeholder="e.g. April 2026" class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl" :value="old('month', now()->format('F Y'))" required />
                            <x-input-error class="mt-2" :messages="$errors->get('month')" />
                        </div>

                        <!-- Payout Date -->
                        <div>
                            <x-input-label for="payout_date" :value="__('Payout Date')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                            <x-text-input id="payout_date" name="payout_date" type="date" class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl" :value="old('payout_date', now()->format('Y-m-d'))" required />
                            <x-input-error class="mt-2" :messages="$errors->get('payout_date')" />
                        </div>

                        <!-- Base Salary -->
                        <div>
                            <x-input-label for="base_salary" :value="__('Base Salary/Wage')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-slate-500 font-bold group-focus-within:text-indigo-600 transition-colors">₹</span>
                                </div>
                                <x-text-input id="base_salary" name="base_salary" type="number" step="0.01" class="mt-0 block w-full pl-8 px-4 py-3 bg-slate-50 border-slate-200 rounded-xl" :value="old('base_salary')" required oninput="calculateNet()" />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('base_salary')" />
                        </div>

                        <!-- Bonus -->
                        <div>
                            <x-input-label for="bonus" :value="__('Bonus/Incentive')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-slate-500 font-bold group-focus-within:text-indigo-600 transition-colors">₹</span>
                                </div>
                                <x-text-input id="bonus" name="bonus" type="number" step="0.01" class="mt-0 block w-full pl-8 px-4 py-3 bg-slate-50 border-slate-200 rounded-xl" :value="old('bonus', 0)" oninput="calculateNet()" />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('bonus')" />
                        </div>

                        <!-- Deductions -->
                        <div>
                            <x-input-label for="deductions" :value="__('Deductions')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-slate-500 font-bold group-focus-within:text-indigo-600 transition-colors">₹</span>
                                </div>
                                <x-text-input id="deductions" name="deductions" type="number" step="0.01" class="mt-0 block w-full pl-8 px-4 py-3 bg-slate-50 border-slate-200 rounded-xl" :value="old('deductions', 0)" oninput="calculateNet()" />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('deductions')" />
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <x-input-label for="payment_method" :value="__('Payment Method')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                            <select id="payment_method" name="payment_method" class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-slate-900 font-semibold" required>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Cash">Cash</option>
                                <option value="UPI">UPI</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                        </div>
                    </div>

                    <!-- Net Amount Display -->
                    <div class="p-6 bg-slate-900 rounded-2xl flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Net Payable') }}</p>
                            <p class="text-xs text-slate-500 font-medium italic mt-1">{{ __('(Base + Bonus - Deductions)') }}</p>
                        </div>
                        <div class="text-right">
                            <h3 id="net_display" class="text-3xl font-black text-white italic tracking-tight">₹0.00</h3>
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div>
                        <x-input-label for="remarks" :value="__('Remarks/Notes')" class="text-slate-700 font-bold text-xs uppercase tracking-wider mb-2 ml-1" />
                        <textarea id="remarks" name="remarks" class="mt-0 block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-slate-900 font-semibold" rows="3">{{ old('remarks') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-4 pt-4 border-t border-slate-100">
                        <a href="{{ route('site-managers.payouts.index') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-700 font-black uppercase tracking-widest text-[10px] rounded-xl hover:bg-slate-50 transition-all flex items-center">
                            Cancel
                        </a>
                        <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-black uppercase tracking-widest text-[10px] rounded-xl hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20">
                            Record Payout
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateBaseSalary(select) {
            const salary = select.options[select.selectedIndex].getAttribute('data-salary');
            if (salary) {
                document.getElementById('base_salary').value = salary;
                calculateNet();
            }
        }

        function calculateNet() {
            const base = parseFloat(document.getElementById('base_salary').value) || 0;
            const bonus = parseFloat(document.getElementById('bonus').value) || 0;
            const deductions = parseFloat(document.getElementById('deductions').value) || 0;
            const net = base + bonus - deductions;
            document.getElementById('net_display').innerText = '₹' + net.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }
    </script>
</x-app-layout>
