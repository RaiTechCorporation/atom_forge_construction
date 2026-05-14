<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Construction Plans') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Define and manage your construction pricing protocols.') }}
                </p>
            </div>
            <a href="{{ route('construction-plans.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                {{ __('Initialize New Plan') }}
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <p class="text-sm font-bold text-emerald-900">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ __('Plan ID') }}</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ __('Plan Name') }}</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ __('Price per Sq Ft') }}</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ __('Features') }}</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ __('Status') }}</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($plans as $plan)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="text-xs font-bold text-slate-400 tracking-wider">#{{ str_pad($plan->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-slate-50 text-slate-600 rounded-lg flex items-center justify-center border border-slate-100 flex-shrink-0">
                                            @if(str_contains(strtolower($plan->name), 'luxury'))
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"></path></svg>
                                            @elseif(str_contains(strtolower($plan->name), 'premium'))
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                            @else
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                            @endif
                                        </div>
                                        <span class="text-sm font-bold text-slate-900">{{ $plan->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-indigo-600">₹{{ number_format($plan->price_per_sqft) }}</span>
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider ml-1">/ sq ft</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @if($plan->features)
                                            @foreach(array_slice($plan->features, 0, 3) as $feature)
                                                <span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-[10px] font-bold rounded-md">
                                                    {{ $feature }}
                                                </span>
                                            @endforeach
                                            @if(count($plan->features) > 3)
                                                <span class="px-2 py-0.5 bg-slate-50 text-slate-400 text-[10px] font-bold rounded-md cursor-help" title="{{ implode(', ', array_slice($plan->features, 3)) }}">
                                                    +{{ count($plan->features) - 3 }} more
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-xs text-slate-400 italic">No features defined</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 {{ $plan->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }} text-[10px] font-bold uppercase tracking-wider rounded-lg">
                                        {{ $plan->is_active ? __('Active') : __('Inactive') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end items-center gap-2">
                                        <a href="{{ route('construction-plans.edit', $plan) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit Plan">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('construction-plans.destroy', $plan) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this plan?') }}')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete Plan">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if($plans->isEmpty())
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        </div>
                                        <p class="text-slate-500 font-medium">{{ __('No construction plans found.') }}</p>
                                        <a href="{{ route('construction-plans.create') }}" class="mt-4 text-sm font-bold text-indigo-600 hover:text-indigo-700">
                                            {{ __('Create your first plan') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
