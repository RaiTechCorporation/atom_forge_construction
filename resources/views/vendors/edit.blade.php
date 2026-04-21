<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 py-2">
            <div>
                <h2 class="font-black text-3xl text-black leading-tight tracking-tighter">
                    {{ __('Edit Vendor') }}: <span class="text-indigo-800">{{ $vendor->name }}</span>
                </h2>
                <p class="mt-1 text-base font-bold text-slate-800">
                    {{ __('Update vendor profiles and contact information.') }}
                </p>
            </div>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center bg-white px-5 py-3 rounded-xl border-2 border-slate-400 shadow-sm">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="text-xs font-black uppercase tracking-widest text-slate-700 hover:text-indigo-800 transition-colors">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-slate-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('vendors.index') }}" class="text-xs font-black uppercase tracking-widest text-slate-700 hover:text-indigo-800 transition-colors">{{ __('Vendors') }}</a>
                    </li>
                    <li class="flex items-center" aria-current="page">
                        <svg class="w-5 h-5 text-slate-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-xs font-black uppercase tracking-widest text-indigo-800">{{ __('Edit') }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-transparent overflow-hidden">
                <form action="{{ route('vendors.update', $vendor) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('vendors.partials.form', ['submitText' => __('Update Vendor')])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
