<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Security Settings') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8">
        @if (session('status') === 'two-factor-enabled')
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl text-xs font-black uppercase tracking-widest">
                Two-factor authentication has been enabled.
            </div>
        @elseif (session('status') === 'two-factor-disabled')
            <div class="bg-amber-50 border border-amber-100 text-amber-600 px-6 py-4 rounded-2xl text-xs font-black uppercase tracking-widest">
                Two-factor authentication has been disabled.
            </div>
        @endif

        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-10">
            <h3 class="text-xl font-bold text-slate-900 tracking-tight mb-8">Password Update</h3>
            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Current Password</label>
                    <input name="current_password" type="password" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all">
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">New Password</label>
                    <input name="password" type="password" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all">
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Confirm Password</label>
                    <input name="password_confirmation" type="password" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all">
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="pt-4">
                    <button type="submit" class="px-8 py-4 bg-indigo-600 text-white text-[10px] font-black rounded-2xl uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20">Update Password</button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-10 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <div class="w-14 h-14 {{ $user->two_factor_enabled ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-50 text-slate-400' }} rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <div>
                    <h4 class="text-sm font-black text-slate-900 uppercase">Two-Factor Authentication</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Status: {{ $user->two_factor_enabled ? 'Enabled (Email OTP)' : 'Disabled' }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('investor.profile.security.two-factor') }}">
                @csrf
                <button type="submit" class="px-6 py-3 {{ $user->two_factor_enabled ? 'bg-rose-50 text-rose-600 border-rose-100 hover:bg-rose-100' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50' }} border text-[10px] font-black rounded-xl uppercase tracking-widest transition-all">
                    {{ $user->two_factor_enabled ? 'Disable' : 'Enable' }}
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
