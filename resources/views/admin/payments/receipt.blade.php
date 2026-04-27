<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                {{ __('Payment Receipt') }}
            </h2>
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all text-sm shadow-lg shadow-indigo-600/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                {{ __('Print Receipt') }}
            </button>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8">
        <div id="receipt" class="bg-white p-12 rounded-2xl border border-slate-200 shadow-sm print:shadow-none print:border-none">
            <div class="flex justify-between items-start mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/Atom Forge Logo.png For White Background.png') }}" alt="Logo" class="w-12 h-12 object-contain">
                        <span class="font-black text-xl text-slate-900 tracking-tighter uppercase italic">
                            Atom<span class="text-indigo-600">Forge</span>
                        </span>
                    </div>
                    <div class="text-sm font-medium text-slate-500 space-y-1">
                        <p>123 Construction Avenue, Tech City</p>
                        <p>Phone: +91 98765 43210</p>
                        <p>Email: finance@atomforge.ai</p>
                    </div>
                </div>
                <div class="text-right">
                    <h1 class="text-4xl font-black text-slate-900 uppercase tracking-tighter mb-2">{{ __('Receipt') }}</h1>
                    <div class="text-sm font-bold text-slate-500">
                        <p>{{ __('Date:') }} {{ $projectPayment->payment_date->format('d M, Y') }}</p>
                        <p>{{ __('Receipt No:') }} REC-{{ str_pad($projectPayment->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-12 mb-12">
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">{{ __('Received From') }}</h3>
                    <div class="space-y-1">
                        <p class="text-lg font-black text-slate-900">{{ $projectPayment->project->client_name ?? ($projectPayment->project->client->name ?? 'N/A') }}</p>
                        <p class="text-sm font-medium text-slate-600">{{ $projectPayment->project->client_email ?? ($projectPayment->project->client->email ?? '') }}</p>
                        <p class="text-sm font-medium text-slate-600">{{ $projectPayment->project->client_phone ?? '' }}</p>
                    </div>
                </div>
                <div class="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100">
                    <h3 class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-4">{{ __('Payment Details') }}</h3>
                    <div class="space-y-1">
                        <p class="text-sm font-bold text-slate-700">{{ __('Project:') }} <span class="text-slate-900">{{ $projectPayment->project->name }}</span></p>
                        <p class="text-sm font-bold text-slate-700">{{ __('Mode:') }} <span class="text-slate-900">{{ $projectPayment->payment_mode }}</span></p>
                        <p class="text-sm font-bold text-slate-700">{{ __('Ref No:') }} <span class="text-slate-900 font-mono">{{ $projectPayment->reference_no ?? 'N/A' }}</span></p>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-8 mb-12">
                <div class="flex justify-between items-center bg-slate-900 text-white p-8 rounded-2xl shadow-xl shadow-slate-900/20">
                    <div>
                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] opacity-60 mb-1">{{ __('Total Amount Received') }}</h4>
                        <p class="text-sm font-medium opacity-80">{{ __('Thank you for your business!') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-4xl font-black tracking-tighter italic">₹{{ number_format($projectPayment->amount_paid, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 mb-12">
                <div class="space-y-4">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Terms & Conditions') }}</h3>
                    <ul class="text-[10px] font-medium text-slate-500 list-disc list-inside space-y-1">
                        <li>This receipt is computer generated and does not require a signature.</li>
                        <li>Payments are subject to realization of cheques/bank transfers.</li>
                        <li>Amounts once paid are non-refundable as per project agreement.</li>
                    </ul>
                </div>
                <div class="flex flex-col justify-end items-end">
                    <div class="w-48 h-px bg-slate-200 mb-2"></div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Authorized Signatory') }}</p>
                </div>
            </div>

            <div class="text-center pt-8 border-t border-slate-100">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Generated via AtomForge Construction Management System</p>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #receipt, #receipt * {
                visibility: visible;
            }
            #receipt {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</x-app-layout>
