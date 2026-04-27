<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('All Projects') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($projects as $project)
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
            <div class="p-8 flex-1">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 tracking-tight mb-1">{{ $project->name }}</h3>
                        <p class="text-slate-500 font-medium text-sm">{{ $project->location }}</p>
                    </div>
                    <span class="px-2.5 py-1 {{ $project->status === 'completed' ? 'bg-emerald-50 text-emerald-600' : 'bg-indigo-50 text-indigo-600' }} text-[10px] font-black rounded-lg uppercase tracking-wider">
                        {{ $project->status }}
                    </span>
                </div>
                
                <div class="space-y-4 mb-8">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Budget</span>
                        <span class="text-sm font-black text-slate-900">₹{{ number_format($project->total_budget, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Funding Status</span>
                        <span class="text-xs font-bold {{ $project->need_funding ? 'text-emerald-500' : 'text-slate-400' }}">
                            {{ $project->need_funding ? 'Open for Investment' : 'Fully Funded' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('investor.projects.details', $project->id) }}" class="text-indigo-600 hover:text-indigo-800 font-bold text-xs uppercase tracking-wider transition-colors">Project Details</a>
                @if($project->need_funding)
                <button class="px-4 py-2 bg-indigo-600 text-white text-[10px] font-black rounded-xl uppercase tracking-widest hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/20">Invest</button>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
