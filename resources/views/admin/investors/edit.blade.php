<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 py-2">
            <div>
                <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Edit Investor Profile') }}
                </h2>
                <p class="mt-1 text-base font-bold text-slate-500">
                    {{ __('Modify account details for') }} {{ $investor->name }}
                </p>
            </div>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center bg-white px-5 py-3 rounded-2xl border border-slate-100 shadow-sm">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-xs font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition-colors">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-slate-200 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('investors.index') }}" class="text-xs font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition-colors">{{ __('Investors') }}</a>
                    </li>
                    <li class="flex items-center" aria-current="page">
                        <svg class="w-5 h-5 text-slate-200 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-xs font-black uppercase tracking-widest text-indigo-600">{{ __('Edit') }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('investors.update', $investor->id) }}" method="POST">
                @csrf
                @method('PATCH')
                @include('admin.investors.partials.form', ['submitText' => __('Update Investor Profile')])
            </form>
        </div>
    </div>
</x-app-layout>
