<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Account Settings') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Manage your operational profile, security, and access.') }}
                </p>
            </div>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-[10px] font-bold uppercase tracking-widest text-slate-500 hover:text-indigo-600 transition-colors">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="flex items-center" aria-current="page">
                        <svg class="w-4 h-4 text-slate-300 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-600">{{ __('Profile') }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="space-y-8">
        <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-rose-50/50 rounded-2xl p-8 border border-rose-100 shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
