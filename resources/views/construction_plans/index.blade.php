<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 py-2">
            <div>
                <h2 class="font-black text-3xl text-black leading-tight tracking-tighter uppercase italic">
                    {{ __('Pricing Architecture') }}
                </h2>
                <p class="mt-1 text-base font-bold text-slate-800 uppercase tracking-widest text-[10px]">
                    {{ __('Define and deploy construction plan protocols') }}
                </p>
            </div>
            <a href="{{ route('construction-plans.create') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 border-4 border-black text-white font-black rounded-xl hover:bg-blue-700 transition-all shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none uppercase tracking-widest text-xs">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                Initialize New Plan
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-8 p-6 bg-emerald-100 border-4 border-black rounded-2xl flex items-center gap-4 shadow-[8px_8px_0px_0px_rgba(16,185,129,0.2)]">
                    <div class="w-10 h-10 bg-emerald-500 border-2 border-black rounded-lg flex items-center justify-center text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <p class="font-black text-emerald-900 uppercase tracking-widest text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($plans as $plan)
                    <div class="bg-white rounded-[2.5rem] border-4 border-black p-10 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] flex flex-col hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all duration-300">
                        <div class="flex justify-between items-start mb-8">
                            <div class="w-14 h-14 bg-slate-900 text-white border-2 border-black rounded-2xl flex items-center justify-center shadow-[4px_4px_0px_0px_rgba(59,130,246,1)]">
                                @if(str_contains(strtolower($plan->name), 'luxury'))
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"></path></svg>
                                @elseif(str_contains(strtolower($plan->name), 'premium'))
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                @else
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('construction-plans.edit', $plan) }}" class="p-2 bg-slate-50 border-2 border-black rounded-lg text-black hover:bg-yellow-400 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('construction-plans.destroy', $plan) }}" method="POST" onsubmit="return confirm('Execute deletion protocol?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-slate-50 border-2 border-black rounded-lg text-black hover:bg-red-500 hover:text-white transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <h3 class="text-2xl font-black text-black uppercase tracking-tight mb-2">{{ $plan->name }}</h3>
                        <div class="mb-8 flex items-baseline gap-2">
                            <span class="text-4xl font-black text-blue-600">₹{{ number_format($plan->price_per_sqft) }}</span>
                            <span class="text-slate-500 font-black uppercase text-[10px] tracking-widest">/ SQ FT</span>
                        </div>

                        <div class="flex-grow space-y-4 mb-10">
                            @if($plan->features)
                                @foreach($plan->features as $feature)
                                    <div class="flex items-center gap-3 text-sm font-bold text-slate-700 uppercase tracking-tight">
                                        <div class="w-5 h-5 bg-blue-100 border border-black rounded flex items-center justify-center text-blue-600">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        {{ $feature }}
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="pt-6 border-t-4 border-slate-100 flex justify-between items-center mt-auto">
                            <span class="text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-lg border-2 border-black {{ $plan->is_active ? 'bg-emerald-400 text-black' : 'bg-red-400 text-black' }}">
                                {{ $plan->is_active ? 'PROTOCOL ACTIVE' : 'PROTOCOL HALTED' }}
                            </span>
                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">UNIT: {{ $plan->id }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
