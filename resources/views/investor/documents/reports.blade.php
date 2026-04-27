<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Project Reports') }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden p-8">
        <h3 class="text-xl font-bold text-slate-900 tracking-tight mb-8">Performance & Progress Reports</h3>
        
        <div class="space-y-4">
            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-between group hover:bg-white hover:shadow-xl hover:shadow-slate-200/50 transition-all cursor-pointer">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-slate-900 uppercase">Q1 2026 Portfolio Summary</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Generated Apr 15, 2026</p>
                    </div>
                </div>
                <button class="px-4 py-2 bg-white border border-slate-200 text-[10px] font-black rounded-xl uppercase tracking-widest hover:bg-slate-50 transition-all text-slate-600">Download PDF</button>
            </div>
        </div>
    </div>
</x-app-layout>
