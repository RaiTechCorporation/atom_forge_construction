<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-bold text-slate-900 tracking-tight">
            {{ __('Welcome') }} <span class="text-indigo-600">{{ __('Back') }}</span>
        </h2>
        <p class="text-slate-500 text-sm mt-2 font-medium">
            {{ __('Construction Control Interface') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 font-semibold text-emerald-600 bg-emerald-50 p-4 border border-emerald-100 rounded-xl text-sm text-center" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1.5">
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 font-bold text-xs uppercase tracking-wider ml-1" />
            <x-text-input id="email" class="block w-full py-3 px-4 text-sm rounded-xl border-slate-200 bg-slate-50/50 text-slate-900 font-medium focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 placeholder-slate-400 transition-all shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@atomforge.ai" />
            <x-input-error :messages="$errors->get('email')" class="font-bold text-rose-600 text-[10px] tracking-wide mt-1 ml-1" />
        </div>

        <!-- Password -->
        <div class="space-y-1.5">
            <div class="flex justify-between items-center px-1">
                <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-bold text-xs uppercase tracking-wider" />
                @if (Route::has('password.request'))
                    <a class="text-[10px] uppercase font-bold tracking-widest text-indigo-600 hover:text-indigo-500 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot?') }}
                    </a>
                @endif
            </div>
            <x-text-input id="password" class="block w-full py-3 px-4 text-sm rounded-xl border-slate-200 bg-slate-50/50 text-slate-900 font-medium focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 placeholder-slate-400 transition-all shadow-sm"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="font-bold text-rose-600 text-[10px] tracking-wide mt-1 ml-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center px-1">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors" name="remember">
                <span class="ms-2 text-xs font-semibold text-slate-600 tracking-tight group-hover:text-slate-900 transition-colors">{{ __('Keep me signed in') }}</span>
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" 
                class="w-full flex justify-center py-3 bg-indigo-600 text-white rounded-xl font-bold text-sm hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-600/20 active:scale-[0.98] transition-all duration-200 shadow-lg shadow-indigo-600/20 uppercase tracking-widest">
                {{ __('Sign In') }}
            </button>
        </div>
    </form>
</x-guest-layout>
