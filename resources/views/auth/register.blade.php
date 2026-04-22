<x-guest-layout>
    <div class="mb-12 text-center">
        <h2 class="text-4xl font-black text-black tracking-tighter uppercase">
            @if(isset($type) && $type === 'investor')
                {{ __('INVESTOR') }} <span class="text-indigo-800">{{ __('PORTAL') }}</span>
            @else
                {{ __('ACCOUNT') }} <span class="text-indigo-800">{{ __('REGISTRATION') }}</span>
            @endif
        </h2>
        <p class="text-slate-800 text-sm mt-3 uppercase tracking-[0.3em] font-black italic opacity-60">
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
        <div class="space-y-3">
            <x-input-label for="name" :value="__('Full Personnel Name')" class="text-black font-black text-sm uppercase tracking-widest" />
            <x-text-input id="name" class="block w-full py-4 px-6 text-base rounded-xl border-4 border-black bg-white text-black font-black focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/10 placeholder-slate-400 transition-all" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="font-black text-red-700 uppercase text-[10px] tracking-widest mt-2" />
        </div>

        <!-- Email Address -->
        <div class="space-y-3">
            <x-input-label for="email" :value="__('System Identifier (Email)')" class="text-black font-black text-sm uppercase tracking-widest" />
            <x-text-input id="email" class="block w-full py-4 px-6 text-base rounded-xl border-4 border-black bg-white text-black font-black focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/10 placeholder-slate-400 transition-all" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@atomforge.sys" />
            <x-input-error :messages="$errors->get('email')" class="font-black text-red-700 uppercase text-[10px] tracking-widest mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-3">
            <x-input-label for="password" :value="__('Security Clearance Key')" class="text-black font-black text-sm uppercase tracking-widest" />
            <x-text-input id="password" class="block w-full py-4 px-6 text-base rounded-xl border-4 border-black bg-white text-black font-black focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/10 placeholder-slate-400 transition-all"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="font-black text-red-700 uppercase text-[10px] tracking-widest mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-3">
            <x-input-label for="password_confirmation" :value="__('Verify Security Key')" class="text-black font-black text-sm uppercase tracking-widest" />
            <x-text-input id="password_confirmation" class="block w-full py-4 px-6 text-base rounded-xl border-4 border-black bg-white text-black font-black focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/10 placeholder-slate-400 transition-all"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="font-black text-red-700 uppercase text-[10px] tracking-widest mt-2" />
        </div>

        <div class="flex flex-col gap-8 pt-8">
            <button type="submit" 
                class="w-full justify-center py-5 bg-yellow-400 border-4 border-black rounded-2xl font-black text-sm text-black hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-400/50 active:scale-[0.98] transition-all duration-200 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] uppercase tracking-widest active:translate-x-1 active:translate-y-1 active:shadow-none">
                {{ __('Initialize Account') }}
            </button>
            
            <a class="text-center text-[10px] uppercase font-black tracking-widest text-indigo-800 hover:text-black transition-colors" href="{{ route('login') }}">
                {{ __('Already registered? Login here') }}
            </a>
        </div>
    </form>
</x-guest-layout>
