<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Bank Details') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8">
        @if (session('status'))
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl text-sm font-bold">
                @if (session('status') === 'bank-account-added')
                    {{ __('Bank account added successfully.') }}
                @elseif (session('status') === 'primary-bank-updated')
                    {{ __('Primary bank account updated successfully.') }}
                @elseif (session('status') === 'bank-account-deleted')
                    {{ __('Bank account removed successfully.') }}
                @else
                    {{ session('status') }}
                @endif
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)" class="bg-red-50 border border-red-100 text-red-600 px-6 py-4 rounded-2xl text-sm font-bold">
                {{ session('error') }}
            </div>
        @endif

        <!-- List of Bank Accounts -->
        <div class="space-y-6">
            <div class="flex items-center justify-between px-2">
                <h3 class="text-xl font-bold text-slate-900 tracking-tight">Registered Bank Accounts</h3>
                <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-black rounded-full uppercase tracking-widest">{{ $bankAccounts->count() }} / 3 Accounts</span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($bankAccounts as $account)
                    @php
                        $bankLogos = [
                            'State Bank of India' => 'sbi.co.in',
                            'HDFC Bank' => 'hdfcbank.com',
                            'ICICI Bank' => 'icicibank.com',
                            'Axis Bank' => 'axisbank.com',
                            'Kotak Mahindra Bank' => 'kotak.com',
                            'IndusInd Bank' => 'indusind.com',
                            'Yes Bank' => 'yesbank.in',
                            'Punjab National Bank' => 'pnbindia.in',
                            'Bank of Baroda' => 'bankofbaroda.in',
                            'Canara Bank' => 'canarabank.com',
                            'Union Bank of India' => 'unionbankofindia.co.in',
                            'IDBI Bank' => 'idbibank.in',
                            'Central Bank of India' => 'centralbankofindia.co.in',
                            'Indian Bank' => 'indianbank.in',
                            'Bank of India' => 'bankofindia.co.in',
                            'Indian Overseas Bank' => 'iob.in',
                            'UCO Bank' => 'ucobank.com',
                            'Punjab & Sind Bank' => 'punjabandsindbank.co.in',
                            'Federal Bank' => 'federalbank.co.in',
                            'IDFC FIRST Bank' => 'idfcfirstbank.com',
                            'South Indian Bank' => 'southindianbank.com',
                            'Karnataka Bank' => 'karnatakabank.com',
                            'Karur Vysya Bank' => 'kvb.co.in',
                            'RBL Bank' => 'rblbank.com',
                            'Bandhan Bank' => 'bandhanbank.com',
                            'DBS Bank India' => 'dbs.com'
                        ];
                        $domain = $bankLogos[$account->bank_name] ?? null;
                    @endphp

                    <div class="relative group">
                        <!-- Card UI -->
                        <div class="h-64 rounded-[2.5rem] p-8 flex flex-col justify-between transition-all duration-500 {{ $account->is_primary ? 'bg-slate-900 text-white shadow-2xl shadow-slate-900/40 translate-y-[-4px]' : 'bg-white text-slate-900 border border-slate-100 shadow-xl shadow-slate-200/50 hover:border-indigo-100' }}">
                            
                            <!-- Card Header -->
                            <div class="flex justify-between items-start">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-white p-1.5 flex items-center justify-center shadow-sm overflow-hidden border border-slate-50">
                                        @if($domain)
                                            <img src="https://www.google.com/s2/favicons?sz=128&domain={{ $domain }}" 
                                                 alt="{{ $account->bank_name }}" 
                                                 class="w-full h-full object-contain"
                                                 onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($account->bank_name) }}&background=f8fafc&color=6366f1&bold=true';">
                                        @else
                                            <div class="w-full h-full bg-slate-50 flex items-center justify-center text-slate-400">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4 10h3v7H4zM10.5 10h3v7h-3zM17 10h3v7h-3zM2 19h20v3H2zM2 4h20v3H2zM12 1L2 6v2h20V6L12 1z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black uppercase tracking-tight {{ $account->is_primary ? 'text-white' : 'text-slate-900' }}">{{ $account->bank_name }}</h4>
                                        <p class="text-[9px] font-bold {{ $account->is_primary ? 'text-slate-500' : 'text-slate-400' }} uppercase tracking-[0.2em]">{{ $account->account_type }} Account</p>
                                    </div>
                                </div>
                                @if($account->is_primary)
                                    <div class="flex items-center gap-1.5 px-3 py-1 bg-emerald-500/20 rounded-full border border-emerald-500/30">
                                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></div>
                                        <span class="text-[8px] font-black text-emerald-400 uppercase tracking-widest">Primary</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Card Body (Account Number) -->
                            <div class="my-6">
                                <p class="text-[9px] font-black uppercase tracking-[0.3em] {{ $account->is_primary ? 'text-slate-600' : 'text-slate-300' }} mb-2">Account Number</p>
                                <div class="flex items-center gap-3">
                                    <span class="text-xl font-black tracking-[0.2em] {{ $account->is_primary ? 'text-white' : 'text-slate-900' }}">
                                        •••• •••• {{ substr($account->account_number, -4) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-[0.2em] {{ $account->is_primary ? 'text-slate-600' : 'text-slate-400' }} mb-1">Holder Name</p>
                                    <p class="text-xs font-black uppercase tracking-tight">{{ $account->account_holder_name }}</p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-[0.2em] {{ $account->is_primary ? 'text-slate-600' : 'text-slate-400' }} mb-1 text-right">IFSC Code</p>
                                    <p class="text-xs font-black uppercase tracking-tight text-right">{{ $account->ifsc_code }}</p>
                                </div>
                            </div>

                            <!-- Hover Actions Overlay -->
                            <div class="absolute inset-x-8 bottom-8 flex justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                                @if(!$account->is_primary)
                                    <form method="POST" action="{{ route('investor.profile.bank.primary', $account->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white text-[9px] font-black rounded-xl uppercase tracking-widest shadow-xl shadow-indigo-600/30 hover:bg-indigo-700 transition-all">Set as Primary</button>
                                    </form>
                                    <form method="POST" action="{{ route('investor.profile.bank.delete', $account->id) }}" onsubmit="return confirm('Remove this bank account?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2.5 bg-red-500 text-white rounded-xl shadow-xl shadow-red-500/30 hover:bg-red-600 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($bankAccounts->isEmpty())
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-12 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <p class="text-slate-500 font-bold uppercase tracking-widest text-[10px]">No bank accounts registered</p>
                </div>
            @endif
        </div>

        <!-- Add New Bank Account -->
        @if($bankAccounts->count() < 3)
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-10 relative overflow-hidden" x-data="{ open: false }">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-bold text-slate-900 tracking-tight">Add New Bank Account</h3>
                    <button @click="open = !open" class="px-6 py-3 bg-indigo-600 text-white text-[10px] font-black rounded-2xl uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20" x-text="open ? 'Cancel' : 'Add Another Account'"></button>
                </div>
                
                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                    <form method="POST" action="{{ route('investor.profile.bank.update') }}" class="space-y-6" 
                        @php
                            $indianBanks = [
                                'State Bank of India', 'HDFC Bank', 'ICICI Bank', 'Axis Bank', 'Kotak Mahindra Bank',
                                'IndusInd Bank', 'Yes Bank', 'Punjab National Bank', 'Bank of Baroda', 'Canara Bank',
                                'Union Bank of India', 'IDBI Bank', 'Central Bank of India', 'Indian Bank', 'Bank of India',
                                'Indian Overseas Bank', 'UCO Bank', 'Punjab & Sind Bank', 'Federal Bank', 'IDFC FIRST Bank',
                                'South Indian Bank', 'Karnataka Bank', 'Karur Vysya Bank', 'RBL Bank', 'Bandhan Bank', 'DBS Bank India'
                            ];
                        @endphp
                        x-data="{ 
                            bankName: '', 
                            isOther: false 
                        }">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Bank Name</label>
                                    <select name="bank_name" x-model="bankName" @change="isOther = (bankName === 'Other')" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all" required>
                                        <option value="">Select Bank</option>
                                        @foreach($indianBanks as $bank)
                                            <option value="{{ $bank }}">{{ $bank }}</option>
                                        @endforeach
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div x-show="isOther" x-cloak x-transition>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Enter Bank Name</label>
                                    <input type="text" name="other_bank_name" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all" :required="isOther" placeholder="Type your bank name here">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Account Holder Name</label>
                                <input type="text" name="account_holder_name" value="{{ auth()->user()->name }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Account Number</label>
                                <input type="text" name="account_number" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">IFSC Code</label>
                                <input type="text" name="ifsc_code" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Branch Name</label>
                                <input type="text" name="branch_name" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Account Type</label>
                                <select name="account_type" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all" required>
                                    <option value="Savings">Savings</option>
                                    <option value="Current">Current</option>
                                </select>
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="w-full px-8 py-4 bg-slate-900 text-white text-[10px] font-black rounded-2xl uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-xl shadow-slate-900/20">Authorize & Save Bank Account</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="bg-amber-50 border border-amber-100 p-8 rounded-[2rem] text-center">
                <p class="text-amber-700 text-[10px] font-black uppercase tracking-widest">You have reached the maximum limit of 3 bank accounts.</p>
                <p class="text-amber-600 text-[9px] font-bold mt-2 italic">Remove an existing account to add a new one.</p>
            </div>
        @endif
    </div>
</x-app-layout>
