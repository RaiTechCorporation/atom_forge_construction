<section>
    <header>
        <h2 class="text-xl font-black text-black uppercase tracking-tight">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm font-bold text-slate-600">
            {{ __("Update your account's profile identity and primary contact email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-8" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex items-center gap-6">
            <div class="shrink-0">
                <div class="relative group">
                    <div class="w-24 h-24 rounded-2xl bg-slate-100 border-2 border-slate-400 overflow-hidden flex items-center justify-center">
                        @if($user->profile_picture)
                            <img src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <x-input-label for="profile_picture" :value="__('Profile Picture')" class="text-black font-black text-[14px] uppercase tracking-wider mb-2" />
                <input id="profile_picture" name="profile_picture" type="file" 
                    class="block w-full text-xs font-bold text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all cursor-pointer" />
                <x-input-error class="mt-2 font-bold text-red-700" :messages="$errors->get('profile_picture')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-black font-black text-[14px] uppercase tracking-wider mb-2" />
            <x-text-input id="name" name="name" type="text" 
                class="mt-0 block w-full px-4 py-3 bg-white border-2 border-slate-400 focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/20 rounded-xl transition-all duration-200 text-black font-bold" 
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 font-bold text-red-700" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-black font-black text-[14px] uppercase tracking-wider mb-2" />
            <x-text-input id="email" name="email" type="email" 
                class="mt-0 block w-full px-4 py-3 bg-white border-2 border-slate-400 focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/20 rounded-xl transition-all duration-200 text-black font-bold" 
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 font-bold text-red-700" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-amber-50 border-2 border-amber-200 rounded-xl">
                    <p class="text-sm font-bold text-amber-900">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="ml-2 underline text-indigo-700 font-black hover:text-indigo-900 transition-colors uppercase tracking-widest text-[10px]">
                            {{ __('Resend Verification') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-black text-xs text-emerald-700 uppercase tracking-widest">
                            {{ __('A new verification link has been dispatched.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-6">
            <button type="submit" class="px-10 py-3.5 bg-black border-2 border-black rounded-xl font-black text-sm text-white hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-400 transition-all duration-200 uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,0.3)]">
                {{ __('Update Profile') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-black text-emerald-600 uppercase tracking-widest"
                >{{ __('SUCCESS: SAVED.') }}</p>
            @endif
        </div>
    </form>
</section>
