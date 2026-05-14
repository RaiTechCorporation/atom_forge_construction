<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Record Material Transaction') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Log material purchases, transfers, and consumption for inventory tracking.') }}
                </p>
            </div>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-[10px] font-bold uppercase tracking-widest text-slate-500 hover:text-indigo-600 transition-colors">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-slate-300 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('material_transactions.index') }}" class="text-[10px] font-bold uppercase tracking-widest text-slate-500 hover:text-indigo-600 transition-colors">{{ __('Transactions') }}</a>
                    </li>
                    <li class="flex items-center" aria-current="page">
                        <svg class="w-4 h-4 text-slate-300 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-600">{{ __('Record') }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl">
            <form action="{{ route('material_transactions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('material_transactions.partials.form', ['submitText' => __('Record Transaction')])
            </form>
        </div>
    </div>
</x-app-layout>
