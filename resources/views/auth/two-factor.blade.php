<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Two-Factor Auth</h2>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">
            Verification Required
        </p>
    </div>

    <div class="mb-8 p-5 bg-indigo-50/50 rounded-2xl border border-indigo-100/50">
        <p class="text-xs font-bold text-indigo-900/70 leading-relaxed">
            Please confirm access to your account by entering the 6-digit authentication code sent to your email.
        </p>
    </div>

    @if (session('status'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl text-[10px] font-black uppercase tracking-widest">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verify.store') }}" class="space-y-6">
        @csrf

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Verification Code</label>
            <input id="two_factor_code" 
                   type="text" 
                   name="two_factor_code" 
                   placeholder="000000"
                   class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-center text-2xl font-black tracking-[0.5em] text-slate-900 placeholder:text-slate-200 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all"
                   required 
                   autofocus 
                   autocomplete="one-time-code" />
            <x-input-error :messages="$errors->get('two_factor_code')" class="mt-3" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-4 bg-indigo-600 text-white text-[10px] font-black rounded-2xl uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20 active:scale-[0.98]">
                Verify Identity
            </button>
        </div>

        <div class="pt-4 flex items-center justify-center">
            <a class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-indigo-600 transition-colors" href="{{ route('verify.resend') }}">
                Resend Code
            </a>
        </div>
    </form>
</x-guest-layout>
