<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-4">
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 flex items-start gap-6 relative overflow-hidden group">
            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-indigo-600"></div>
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <div class="flex items-center justify-between mb-1">
                    <h4 class="text-sm font-black text-slate-900 uppercase">Payout Processed</h4>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">2 hours ago</span>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">Your quarterly payout for the **Skyline Apartments** project has been successfully processed and transferred to your registered bank account.</p>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 flex items-start gap-6 group opacity-75">
            <div class="w-12 h-12 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <div class="flex items-center justify-between mb-1">
                    <h4 class="text-sm font-black text-slate-900 uppercase">New Project Opportunity</h4>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Yesterday</span>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">A new commercial development project **Green Valley Mall** is now open for funding. Review the project details and projected ROI.</p>
            </div>
        </div>
    </div>
</x-app-layout>
