<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Expense Ledger') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Monitor and manage all operational expenditures.') }}
                </p>
            </div>
            <a href="{{ route('expenses.create') }}" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Record Expense
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-xl flex items-center gap-3 animate-fade-in" role="alert">
                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-semibold text-emerald-800 text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <form action="{{ route('expenses.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
                <div class="w-full md:w-72">
                    <label for="project_id" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">{{ __('Filter by Project') }}</label>
                    <select id="project_id" name="project_id" class="block w-full border-slate-200 bg-slate-50 px-4 py-2 text-slate-900 font-medium text-sm focus:ring-indigo-500 focus:border-indigo-500 rounded-xl transition-all">
                        <option value="">{{ __('All Projects') }}</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit" class="flex-1 md:flex-none px-6 py-2 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition-all text-sm shadow-sm">
                        Apply Filter
                    </button>
                    @if(request()->has('project_id') && request('project_id') != '')
                        <a href="{{ route('expenses.index') }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-6 py-2 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition-all text-sm">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Date</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Allocation</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Classification</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Details</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Amount</th>
                            <th class="px-6 py-4 text-center text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Proof</th>
                            <th class="px-6 py-4 text-right text-[10px] font-bold text-slate-500 uppercase tracking-widest whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($expenses as $expense)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-6 whitespace-nowrap text-xs font-bold text-slate-500">
                                    {{ \Carbon\Carbon::parse($expense->date)->format('d M, Y') }}
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Project</span>
                                        <span class="text-sm font-bold text-slate-900 leading-tight">
                                            {{ $expense->project->name }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="inline-flex px-2.5 py-0.5 bg-slate-100 text-slate-700 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                        {{ str_replace('_', ' ', $expense->category) }}
                                    </span>
                                </td>
                                <td class="px-6 py-6 max-w-xs">
                                    <p class="text-xs font-medium text-slate-500 leading-relaxed line-clamp-2">
                                        {{ $expense->description }}
                                    </p>
                                </td>
                                <td class="px-6 py-6 whitespace-nowrap">
                                    <span class="text-sm font-bold text-slate-900 tracking-tight">
                                        ₹{{ number_format($expense->amount, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    @if($expense->bill_path)
                                        <a href="{{ asset('storage/' . $expense->bill_path) }}" target="_blank" class="inline-flex items-center justify-center p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="View Receipt">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </a>
                                    @else
                                        <span class="text-[10px] font-medium text-slate-300 uppercase tracking-widest italic">No Bill</span>
                                    @endif
                                </td>
                                <td class="px-6 py-6 text-right whitespace-nowrap">
                                    <div class="flex justify-end items-center gap-2">
                                        <a href="{{ route('expenses.edit', $expense) }}" class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all" title="Edit Expense">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirm deletion of this financial record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete Expense">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-base font-bold text-slate-900">No Expenses Recorded</p>
                                            <p class="text-slate-500 text-sm font-medium">The financial ledger for the selected criteria is empty.</p>
                                        </div>
                                        <a href="{{ route('expenses.create') }}" class="mt-2 inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-500 transition-all text-sm">
                                            Log New Expenditure
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($expenses->hasPages())
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                    {{ $expenses->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
