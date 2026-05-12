<section class="space-y-6">
    <header>
        <h2 class="text-xl font-black text-red-600 uppercase tracking-tight">
            {{ __('Danger Zone: Delete Account') }}
        </h2>

        <p class="mt-2 text-sm font-bold text-slate-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently purged. This action is irreversible.') }}
        </p>
    </header>

    @if(auth()->user()->isSiteSupervisor())
        <div class="mt-6 p-4 bg-amber-50 border-2 border-amber-200 rounded-xl">
            <p class="text-sm font-bold text-amber-800 uppercase tracking-wide">
                {{ __('Notice: Site Supervisors are not allowed to delete their accounts. Please contact the administrator for any account management requests.') }}
            </p>
        </div>
    @else
        <button
            class="px-8 py-3 bg-white border-2 border-red-600 rounded-xl font-black text-xs text-red-600 hover:bg-red-50 focus:outline-none focus:ring-4 focus:ring-red-200 transition-all duration-200 uppercase tracking-widest"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >{{ __('Terminate Account') }}</button>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white border-4 border-black">
                @csrf
                @method('delete')

                <h2 class="text-2xl font-black text-black uppercase tracking-tight">
                    {{ __('Final Confirmation') }}
                </h2>

                <p class="mt-4 text-sm font-bold text-slate-600 leading-relaxed">
                    {{ __('Are you absolutely sure? All construction data, project logs, and financial records associated with this account will be permanently deleted. Please enter your password to confirm terminal deletion.') }}
                </p>

                <div class="mt-8">
                    <x-input-label for="password" value="{{ __('Your Security Password') }}" class="sr-only" />

                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full px-4 py-3 bg-white border-2 border-slate-400 focus:border-red-600 focus:ring-4 focus:ring-red-100 rounded-xl transition-all duration-200 text-black font-bold"
                        placeholder="{{ __('Password') }}"
                    />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 font-bold text-red-700" />
                </div>

                <div class="mt-10 flex justify-end gap-4">
                    <button type="button" x-on:click="$dispatch('close')" class="px-8 py-3 bg-white border-2 border-slate-400 rounded-xl font-black text-xs text-slate-600 hover:bg-slate-50 transition-all duration-200 uppercase tracking-widest">
                        {{ __('Abort') }}
                    </button>

                    <button type="submit" class="px-8 py-3 bg-red-600 border-2 border-red-600 rounded-xl font-black text-xs text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-200 transition-all duration-200 uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(220,38,38,0.3)]">
                        {{ __('Confirm Deletion') }}
                    </button>
                </div>
            </form>
        </x-modal>
    @endif
</section>
