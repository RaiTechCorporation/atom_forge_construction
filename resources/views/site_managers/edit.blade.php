<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Edit Site Manager') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Update details for :name (:id)', ['name' => $siteManager->name, 'id' => $siteManager->manager_unique_id]) }}
                </p>
            </div>
            <a href="{{ route('site-managers.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition-all text-xs">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Directory
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        <form action="{{ route('site-managers.update', $siteManager) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PATCH')
            
            @include('site_managers.partials.form')

            <div class="flex justify-end gap-4 pb-12">
                <a href="{{ route('site-managers.index') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-700 font-black uppercase tracking-widest text-[10px] rounded-xl hover:bg-slate-50 transition-all flex items-center">
                    Cancel Changes
                </a>
                <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-black uppercase tracking-widest text-[10px] rounded-xl hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-600/20">
                    Update Manager Record
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
