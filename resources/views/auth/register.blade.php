<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-bold text-slate-900 tracking-tight">
            @if(isset($type) && $type === 'investor')
                {{ __('Investor') }} <span class="text-indigo-600">{{ __('Portal') }}</span>
            @else
                {{ __('Account') }} <span class="text-indigo-600">{{ __('Registration') }}</span>
            @endif
        </h2>
        <p class="text-slate-500 text-sm mt-2 font-medium">
            @if(isset($type) && $type === 'investor')
                {{ __('Begin Your Investment Journey') }}
            @else
                {{ __('New System Personnel Onboarding') }}
            @endif
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        @if(isset($type))
            <input type="hidden" name="type" value="{{ $type }}">
        @endif

        <!-- Name -->
        <div class="space-y-1.5">
            <x-input-label for="name" :value="__('Full Name')" class="text-slate-700 font-bold text-xs uppercase tracking-wider ml-1" />
            <x-text-input id="name" class="block w-full py-3 px-4 text-sm rounded-xl border-slate-200 bg-slate-50/50 text-slate-900 font-medium focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 placeholder-slate-400 transition-all shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="font-bold text-rose-600 text-[10px] tracking-wide mt-1 ml-1" />
        </div>

        <!-- Email Address -->
        <div class="space-y-1.5">
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 font-bold text-xs uppercase tracking-wider ml-1" />
            <x-text-input id="email" class="block w-full py-3 px-4 text-sm rounded-xl border-slate-200 bg-slate-50/50 text-slate-900 font-medium focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 placeholder-slate-400 transition-all shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@atomforge.ai" />
            <x-input-error :messages="$errors->get('email')" class="font-bold text-rose-600 text-[10px] tracking-wide mt-1 ml-1" />
        </div>

        <!-- Password -->
        <div class="space-y-1.5">
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-bold text-xs uppercase tracking-wider ml-1" />
            <x-text-input id="password" class="block w-full py-3 px-4 text-sm rounded-xl border-slate-200 bg-slate-50/50 text-slate-900 font-medium focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 placeholder-slate-400 transition-all shadow-sm"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="font-bold text-rose-600 text-[10px] tracking-wide mt-1 ml-1" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1.5">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-700 font-bold text-xs uppercase tracking-wider ml-1" />
            <x-text-input id="password_confirmation" class="block w-full py-3 px-4 text-sm rounded-xl border-slate-200 bg-slate-50/50 text-slate-900 font-medium focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 placeholder-slate-400 transition-all shadow-sm"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="font-bold text-rose-600 text-[10px] tracking-wide mt-1 ml-1" />
        </div>

        <div class="flex flex-col gap-6 pt-4">
            <button type="submit" 
                class="w-full flex justify-center py-3 bg-indigo-600 text-white rounded-xl font-bold text-sm hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-600/20 active:scale-[0.98] transition-all duration-200 shadow-lg shadow-indigo-600/20 uppercase tracking-widest">
                {{ __('Create Account') }}
            </button>
            
            <a class="text-center text-[10px] uppercase font-bold tracking-widest text-slate-500 hover:text-indigo-600 transition-colors" href="{{ route('login') }}">
                {{ __('Already registered? Login here') }}
            </a>
        </div>
    </form>
</x-guest-layout>
