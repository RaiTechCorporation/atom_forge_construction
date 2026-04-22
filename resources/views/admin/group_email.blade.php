<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Group Email') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Breadcrumb and Header --}}
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Group <span class="text-indigo-600">Email</span></h2>
                    <p class="mt-1 text-slate-500 font-medium">Broadcast messages to specific user groups instantly.</p>
                </div>
                <nav class="flex px-5 py-2.5 text-slate-700 bg-white border border-slate-200 rounded-2xl shadow-sm" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 00-1.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                Dashboard
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-sm font-bold text-indigo-600 md:ml-2">Group Email</span>
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
                        <p class="font-bold text-lg leading-none">Delivered!</p>
                        <p class="text-sm font-medium opacity-80 mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-8 p-5 bg-rose-50 border border-rose-100 text-rose-800 rounded-3xl flex items-center gap-4 shadow-sm">
                    <div class="p-2 bg-rose-500 rounded-xl shadow-lg shadow-rose-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <p class="font-bold text-lg">{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-2xl shadow-slate-200/50 sm:rounded-[3rem] border border-slate-100 transition-all duration-300">
                <div class="p-8 sm:p-14">
                    <form action="{{ route('admin.group-email.send') }}" method="POST">
                        @csrf

                        <div class="space-y-10">
                            {{-- Recipient Selection --}}
                            <div class="relative">
                                <div class="absolute -left-14 top-0 hidden xl:flex flex-col items-center">
                                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    <div class="w-px h-full bg-slate-100 mt-4"></div>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                                    <span class="p-1.5 bg-indigo-100 text-indigo-600 rounded-lg xl:hidden">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </span>
                                    Target Audience
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Select User Type*</label>
                                        <select name="type" class="w-full rounded-2xl border-slate-200 hover:border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 font-semibold text-slate-600 bg-slate-50/50 py-4 px-5 cursor-pointer" required>
                                            <option value="all">Broadcast to All Users</option>
                                            <option value="client">Active Clients Only</option>
                                            <option value="investor">Investors Portal Users</option>
                                            <option value="admin_staff">Internal Admin Staff</option>
                                        </select>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Email Subject *</label>
                                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Subject line..." class="w-full rounded-2xl border-slate-200 hover:border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 font-semibold text-slate-700 py-4 px-5 bg-white shadow-sm placeholder:text-slate-300" required>
                                    </div>
                                </div>
                            </div>

                            {{-- Message Content --}}
                            <div class="relative">
                                <div class="absolute -left-14 top-0 hidden xl:flex flex-col items-center">
                                    <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                                    <span class="p-1.5 bg-blue-100 text-blue-600 rounded-lg xl:hidden">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </span>
                                    Compose Message
                                </h3>

                                <div class="space-y-4">
                                    <div class="rounded-[2rem] overflow-hidden border border-slate-200 shadow-inner">
                                        <textarea name="body" id="editor" class="w-full min-h-[400px]">{{ old('body') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-10 flex flex-col sm:flex-row items-center justify-between gap-6 border-t border-slate-100">
                                <div class="flex items-center gap-4 text-slate-400">
                                    <div class="flex -space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center text-[10px] font-bold">JD</div>
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-indigo-600">AS</div>
                                        <div class="w-8 h-8 rounded-full bg-slate-200 border-2 border-white flex items-center justify-center text-[10px] font-bold">+</div>
                                    </div>
                                    <p class="text-xs font-semibold uppercase tracking-widest">Multi-recipient delivery</p>
                                </div>
                                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20 flex items-center justify-center gap-2 active:scale-[0.98]">
                                    <span>Send Broadcast</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
            border-radius: 0 0 1rem 1rem !important;
        }
        .ck-editor__top {
            border-radius: 1rem 1rem 0 0 !important;
        }
    </style>
</x-app-layout>
