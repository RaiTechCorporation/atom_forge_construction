<section>
    <header>
        <h2 class="text-xl font-black text-black uppercase tracking-tight">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-2 text-sm font-bold text-slate-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>
    
    @if(auth()->user()->isSiteSupervisor())
        <div class="mt-6 p-4 bg-amber-50 border-2 border-amber-200 rounded-xl">
            <p class="text-sm font-bold text-amber-800 uppercase tracking-wide">
                {{ __('Notice: Site Supervisors are not allowed to update their password. Please contact the administrator for any security concerns.') }}
            </p>
        </div>
    @else
        <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-8">
            @csrf
            @method('put')

            <div>
                <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-black font-black text-[14px] uppercase tracking-wider mb-2" />
                <x-text-input id="update_password_current_password" name="current_password" type="password" 
                    class="mt-0 block w-full px-4 py-3 bg-white border-2 border-slate-400 focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/20 rounded-xl transition-all duration-200 text-black font-bold" 
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 font-bold text-red-700" />
            </div>

            <div>
                <x-input-label for="update_password_password" :value="__('New Password')" class="text-black font-black text-[14px] uppercase tracking-wider mb-2" />
                <x-text-input id="update_password_password" name="password" type="password" 
                    class="mt-0 block w-full px-4 py-3 bg-white border-2 border-slate-400 focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/20 rounded-xl transition-all duration-200 text-black font-bold" 
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 font-bold text-red-700" />
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-black font-black text-[14px] uppercase tracking-wider mb-2" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                    class="mt-0 block w-full px-4 py-3 bg-white border-2 border-slate-400 focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/20 rounded-xl transition-all duration-200 text-black font-bold" 
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 font-bold text-red-700" />
            </div>

            <div class="flex items-center gap-6">
                <button type="submit" class="px-10 py-3.5 bg-black border-2 border-black rounded-xl font-black text-sm text-white hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-400 transition-all duration-200 uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,0.3)]">
                    {{ __('Save Changes') }}
                </button>

                @if (session('status') === 'password-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-xs font-black text-emerald-600 uppercase tracking-widest"
                    >{{ __('SUCCESS: PASSWORD UPDATED.') }}</p>
                @endif
            </div>
        </form>
    @endif
</section>
