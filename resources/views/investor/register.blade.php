<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Become an Investor') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 md:p-10">
                <div class="mb-8">
                    <h3 class="text-2xl font-black text-slate-900 mb-2">Complete Your Investor Profile</h3>
                    <p class="text-slate-500 font-medium">Join our network of investors and track your construction investments in real-time.</p>
                </div>

                <form method="POST" action="{{ route('investor.register.store') }}" class="space-y-6">
                    @csrf

                    <!-- Name (Read-only) -->
                    <div>
                        <x-input-label for="name" :value="__('Full Name')" />
                        <x-text-input id="name" class="block mt-1 w-full text-slate-500 cursor-not-allowed" type="text" :value="auth()->user()->name" disabled />
                    </div>

                    <!-- Email (Read-only) -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email Address')" />
                        <x-text-input id="email" class="block mt-1 w-full text-slate-500 cursor-not-allowed" type="email" :value="auth()->user()->email" disabled />
                    </div>

                    <!-- Phone -->
                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('Phone Number')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required placeholder="+91 98765 43210" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Address -->
                    <div class="mt-4">
                        <x-input-label for="address" :value="__('Postal Address')" />
                        <textarea id="address" name="address" class="bg-slate-50 border-slate-200 focus:border-blue-600 focus:ring-blue-600/20 rounded-lg shadow-sm transition-all text-sm font-medium text-slate-900 placeholder-slate-400 block mt-1 w-full min-h-[100px]" required placeholder="Enter your full residential or office address">{{ old('address') }}</textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-8 py-4 bg-slate-900 hover:bg-indigo-600 text-white font-black text-sm uppercase tracking-widest rounded-2xl transition-all shadow-lg shadow-slate-900/10 hover:shadow-indigo-600/20 group">
                            Create Investor Profile
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-8 border-t border-slate-100">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Important Note</h4>
                            <p class="text-xs text-slate-500 font-medium leading-relaxed mt-1">By creating an investor profile, you will gain access to the Investor Portal where you can view project progress, investment history, and payout schedules. Our team will verify your details within 24-48 hours.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>