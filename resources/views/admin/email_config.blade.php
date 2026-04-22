<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Email Configuration') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Breadcrumb and Header --}}
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Email <span class="text-indigo-600">Configuration</span></h2>
                    <p class="mt-1 text-slate-500 font-medium">Manage your SMTP server settings and sender identity.</p>
                </div>
                <nav class="flex px-5 py-2.5 text-slate-700 bg-white border border-slate-200 rounded-2xl shadow-sm" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                Dashboard
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-sm font-bold text-indigo-600 md:ml-2">Configuration</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            @if (session('success'))
                <div class="mb-8 p-5 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-3xl flex items-center gap-4 shadow-sm animate-in fade-in slide-in-from-top-4 duration-500">
                    <div class="p-2 bg-emerald-500 rounded-xl shadow-lg shadow-emerald-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="font-bold text-lg leading-none">Success!</p>
                        <p class="text-sm font-medium opacity-80 mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-2xl shadow-slate-200/50 sm:rounded-[3rem] border border-slate-100 transition-all duration-300">
                <div class="p-8 sm:p-14">
                    <form action="{{ route('admin.email-config.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="space-y-10">
                            {{-- Section: SMTP Settings --}}
                            <div class="relative">
                                <div class="absolute -left-14 top-0 hidden xl:flex flex-col items-center">
                                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                                    </div>
                                    <div class="w-px h-full bg-slate-100 mt-4"></div>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                                    <span class="p-1.5 bg-indigo-100 text-indigo-600 rounded-lg xl:hidden">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                                    </span>
                                    Connection Protocol
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">SMTP Status</label>
                                        <select name="is_smtp" class="w-full rounded-2xl border-slate-200 hover:border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 font-semibold text-slate-600 bg-slate-50/50 py-4 px-5 cursor-pointer">
                                            <option value="1" {{ (old('is_smtp', $settings['is_smtp']->value ?? '1') == '1') ? 'selected' : '' }}>✓ Activated</option>
                                            <option value="0" {{ (old('is_smtp', $settings['is_smtp']->value ?? '1') == '0') ? 'selected' : '' }}>✕ Deactivated</option>
                                        </select>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">SMTP Host *</label>
                                        <input type="text" name="smtp_host" value="{{ old('smtp_host', $settings['smtp_host']->value ?? '') }}" placeholder="e.g. smtp.mailjet.com" class="w-full rounded-2xl border-slate-200 hover:border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 font-semibold text-slate-700 py-4 px-5 bg-white shadow-sm placeholder:text-slate-300" required>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">SMTP Port *</label>
                                        <input type="text" name="smtp_port" value="{{ old('smtp_port', $settings['smtp_port']->value ?? '') }}" placeholder="e.g. 587" class="w-full rounded-2xl border-slate-200 hover:border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 font-semibold text-slate-700 py-4 px-5 bg-white shadow-sm placeholder:text-slate-300" required>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1 text-indigo-600">Secure Protocol</label>
                                        <div class="flex items-center h-[58px] px-5 bg-indigo-50/50 rounded-2xl border border-indigo-100/50">
                                            <span class="text-sm font-bold text-indigo-700 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 4.908-3.333 9.277-8 10.125a11.591 11.591 0 01-8-10.125c0-.681.057-1.35.166-2.001zM10 15a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                                                TLS / SSL Supported
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Section: Authentication --}}
                            <div class="relative">
                                <div class="absolute -left-14 top-0 hidden xl:flex flex-col items-center">
                                    <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                    <div class="w-px h-full bg-slate-100 mt-4"></div>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                                    <span class="p-1.5 bg-amber-100 text-amber-600 rounded-lg xl:hidden">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </span>
                                    Authentication Credentials
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">SMTP Username *</label>
                                        <input type="text" name="smtp_user" value="{{ old('smtp_user', $settings['smtp_user']->value ?? '') }}" placeholder="Enter username" class="w-full rounded-2xl border-slate-200 hover:border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 font-semibold text-slate-700 py-4 px-5 bg-white shadow-sm placeholder:text-slate-300" required>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">SMTP Password *</label>
                                        <div class="relative" x-data="{ show: false }">
                                            <input :type="show ? 'text' : 'password'" name="smtp_pass" value="{{ old('smtp_pass', $settings['smtp_pass']->value ?? '') }}" placeholder="Enter password" class="w-full rounded-2xl border-slate-200 hover:border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 font-semibold text-slate-700 py-4 px-5 bg-white shadow-sm placeholder:text-slate-300" required>
                                            <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-indigo-600 transition-colors">
                                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Section: Sender Identity --}}
                            <div class="relative">
                                <div class="absolute -left-14 top-0 hidden xl:flex flex-col items-center">
                                    <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                                    <span class="p-1.5 bg-blue-100 text-blue-600 rounded-lg xl:hidden">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </span>
                                    Sender Identity
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">From Email *</label>
                                        <input type="email" name="from_email" value="{{ old('from_email', $settings['from_email']->value ?? '') }}" placeholder="admin@atomforge.com" class="w-full rounded-2xl border-slate-200 hover:border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 font-semibold text-slate-700 py-4 px-5 bg-white shadow-sm placeholder:text-slate-300" required>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">From Name *</label>
                                        <input type="text" name="from_name" value="{{ old('from_name', $settings['from_name']->value ?? '') }}" placeholder="Atom Forge Construction" class="w-full rounded-2xl border-slate-200 hover:border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 font-semibold text-slate-700 py-4 px-5 bg-white shadow-sm placeholder:text-slate-300" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-10 flex flex-col sm:flex-row items-center justify-between gap-6 border-t border-slate-100">
                                <p class="text-sm font-medium text-slate-400 italic flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    Ensure these settings are verified with your provider.
                                </p>
                                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20 flex items-center justify-center gap-2 active:scale-[0.98]">
                                    Update Configuration
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
