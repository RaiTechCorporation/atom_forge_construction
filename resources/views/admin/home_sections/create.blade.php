<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('home-sections.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-600 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Add Home Section') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Create a new custom section for your home page.') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl">
        <form action="{{ route('home-sections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="premium-card overflow-hidden">
                <div class="p-8 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-indigo-600 rounded-full"></div>
                        <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">Section Details</h3>
                    </div>
                </div>
                <div class="p-8">
                    @include('admin.home_sections.partials.form')
                </div>
                <div class="p-8 bg-slate-50 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="group relative px-12 py-4 bg-slate-900 text-white font-black uppercase tracking-widest text-[11px] rounded-2xl hover:bg-indigo-600 transition-all duration-300 shadow-2xl shadow-slate-900/20 hover:shadow-indigo-600/30">
                        <span class="relative z-10 flex items-center gap-3">
                            {{ __('Create Section') }}
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
