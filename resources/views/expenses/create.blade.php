<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Record Expense') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Log operational expenditures and manage payment documentation.') }}
                </p>
            </div>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg>
                        <a href="{{ route('expenses.index') }}" class="text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors">{{ __('Expenses') }}</a>
                    </li>
                    <li class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg>
                        <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded">{{ __('New Record') }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
            <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('expenses.partials.form', ['submitText' => __('Save Expense Record')])
            </form>
        </div>
    </div>
</x-app-layout>
