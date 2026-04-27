<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Investor Support') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
            <h3 class="text-xl font-bold text-slate-900 tracking-tight mb-6">Contact Your Manager</h3>
            <div class="flex items-center gap-6 mb-8">
                <div class="w-16 h-16 bg-slate-900 rounded-2xl flex items-center justify-center text-white text-xl font-black">
                    JD
                </div>
                <div>
                    <h4 class="font-black text-slate-900 uppercase">John Doe</h4>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Senior Portfolio Manager</p>
                </div>
            </div>
            <div class="space-y-4">
                <button class="w-full py-4 bg-indigo-600 text-white text-[10px] font-black rounded-2xl uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20 flex items-center justify-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    Send Message
                </button>
                <button class="w-full py-4 bg-white border border-slate-200 text-slate-600 text-[10px] font-black rounded-2xl uppercase tracking-widest hover:bg-slate-50 transition-all flex items-center justify-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    Schedule a Call
                </button>
                <a href="https://wa.me/918318754257" target="_blank" class="w-full py-4 bg-emerald-500 text-white text-xs font-black rounded-2xl uppercase tracking-widest hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-500/30 flex items-center justify-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.29-4.143c1.589.943 3.147 1.44 4.744 1.441 5.401 0 9.798-4.396 9.802-9.797 0-2.618-1.02-5.08-2.871-6.932-1.85-1.852-4.311-2.873-6.93-2.873-5.401 0-9.798 4.397-9.802 9.799 0 1.9.54 3.42 1.581 4.966l-.1.173-1.013 3.7.126.033 3.663-.957zm11.532-6.536c-.234-.117-1.385-.683-1.599-.761-.215-.078-.371-.117-.527.117-.156.234-.605.761-.742.918-.137.156-.273.176-.508.059-.234-.117-.988-.364-1.882-1.161-.695-.62-1.165-1.385-1.301-1.619-.137-.234-.015-.361.103-.477.106-.105.234-.273.351-.41.117-.137.156-.234.234-.391.078-.156.039-.293-.019-.41-.059-.117-.527-1.27-.723-1.738-.191-.462-.387-.399-.527-.406-.136-.007-.293-.009-.449-.009-.156 0-.41.059-.625.293-.215.234-.82.801-.82 1.953s.84 2.266.957 2.422c.117.156 1.653 2.523 4.004 3.538.559.241.996.386 1.337.494.56.178 1.069.153 1.472.093.449-.066 1.385-.566 1.581-1.113.195-.547.195-1.016.137-1.113-.058-.097-.214-.156-.448-.273z"></path></svg>
                    WhatsApp Support
                </a>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
            <h3 class="text-xl font-bold text-slate-900 tracking-tight mb-6">Frequently Asked Questions</h3>
            <div class="space-y-6">
                <div>
                    <h4 class="text-sm font-black text-slate-900 uppercase mb-2">How are payouts calculated?</h4>
                    <p class="text-sm text-slate-600">Payouts are based on the project profit margins and your equity share as defined in the master agreement.</p>
                </div>
                <div>
                    <h4 class="text-sm font-black text-slate-900 uppercase mb-2">When can I withdraw capital?</h4>
                    <p class="text-sm text-slate-600">Capital withdrawals are subject to the lock-in period specified for each project, typically 12-24 months.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
