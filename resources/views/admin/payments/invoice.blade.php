<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                {{ __('Project Invoice') }}
            </h2>
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl transition-all text-sm shadow-lg shadow-emerald-600/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                {{ __('Print Invoice') }}
            </button>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4">
        <div id="invoice" class="bg-white p-16 rounded-[2.5rem] border border-slate-200 shadow-sm print:shadow-none print:border-none print:p-0">
            <!-- Invoice Header -->
            <div class="flex flex-col md:flex-row justify-between gap-12 mb-20">
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-slate-900 rounded-3xl flex items-center justify-center text-white shadow-2xl">
                            <img src="{{ asset('images/cropped-Atom-Forge-Logo.png-For-White-Background.png') }}" alt="Logo" class="w-10 h-10 object-contain invert">
                        </div>
                        <div>
                            <span class="font-black text-2xl text-slate-900 tracking-tighter uppercase italic block leading-none">
                                Atom<span class="text-indigo-600">Forge</span>
                            </span>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] mt-1 block">Construction Excellence</span>
                        </div>
                    </div>
                    <div class="text-xs font-bold text-slate-500 space-y-1 max-w-xs">
                        <p class="text-slate-900">AtomForge Infrastructure Pvt. Ltd.</p>
                        <p>123 Construction Avenue, Sky Tower, Floor 14</p>
                        <p>Tech City, Karnataka 560001, India</p>
                        <p>GSTIN: 29AAAAA0000A1Z5</p>
                    </div>
                </div>
                <div class="text-right flex flex-col justify-end">
                    <h1 class="text-7xl font-black text-slate-100 uppercase tracking-tighter mb-4 print:text-slate-200">{{ __('Invoice') }}</h1>
                    <div class="space-y-1">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">{{ __('Invoice Number') }}</p>
                        <p class="text-lg font-black text-slate-900">INV-{{ date('Y') }}-{{ str_pad($projectPayment->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
            </div>

            <!-- Billing Info -->
            <div class="grid grid-cols-2 gap-20 mb-20">
                <div>
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">{{ __('Bill To') }}</h3>
                    <div class="space-y-1">
                        <p class="text-xl font-black text-slate-900">{{ $projectPayment->project->client_name ?? ($projectPayment->project->client->name ?? 'N/A') }}</p>
                        <p class="text-sm font-bold text-slate-600">{{ $projectPayment->project->client_email ?? ($projectPayment->project->client->email ?? '') }}</p>
                        <p class="text-sm font-bold text-slate-600">{{ $projectPayment->project->client_phone ?? '' }}</p>
                        <div class="pt-4 max-w-xs">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ __('Project Location') }}</p>
                            <p class="text-xs font-bold text-slate-700 leading-relaxed">{{ $projectPayment->project->site_address }}, {{ $projectPayment->project->city }}, {{ $projectPayment->project->state }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-end">
                    <div class="space-y-6 w-full max-w-[200px]">
                        <div class="text-right">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ __('Date of Issue') }}</p>
                            <p class="text-sm font-black text-slate-900">{{ $projectPayment->payment_date->format('d M, Y') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ __('Project Code') }}</p>
                            <p class="text-sm font-black text-slate-900">{{ $projectPayment->project->project_code }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Table -->
            <div class="mb-20">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-slate-900">
                            <th class="text-left py-4 text-[10px] font-black text-slate-900 uppercase tracking-widest">{{ __('Description') }}</th>
                            <th class="text-right py-4 text-[10px] font-black text-slate-900 uppercase tracking-widest">{{ __('Project Value') }}</th>
                            <th class="text-right py-4 text-[10px] font-black text-slate-900 uppercase tracking-widest">{{ __('Amount') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="group">
                            <td class="py-8">
                                <p class="text-sm font-black text-slate-900 mb-1">{{ __('Progressive Payment for Project') }}: {{ $projectPayment->project->name }}</p>
                                <p class="text-xs font-medium text-slate-500">{{ __('Payment recorded via') }} {{ $projectPayment->payment_mode }} @if($projectPayment->reference_no) ({{ $projectPayment->reference_no }}) @endif</p>
                            </td>
                            <td class="py-8 text-right align-top">
                                <p class="text-sm font-bold text-slate-700">₹{{ number_format($projectPayment->project->total_budget, 2) }}</p>
                            </td>
                            <td class="py-8 text-right align-top">
                                <p class="text-sm font-black text-slate-900">₹{{ number_format($projectPayment->amount_paid, 2) }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Financial Summary -->
            <div class="flex justify-end mb-20">
                <div class="w-full max-w-sm space-y-4">
                    <div class="flex justify-between items-center px-4">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Total Budget') }}</span>
                        <span class="text-sm font-bold text-slate-700">₹{{ number_format($projectPayment->project->total_budget, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center px-4">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Previously Paid') }}</span>
                        <span class="text-sm font-bold text-slate-700">₹{{ number_format($projectPayment->project->total_paid - $projectPayment->amount_paid, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center px-4">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest text-emerald-500">{{ __('Current Payment') }}</span>
                        <span class="text-sm font-black text-emerald-600">₹{{ number_format($projectPayment->amount_paid, 2) }}</span>
                    </div>
                    <div class="h-px bg-slate-100 my-4"></div>
                    <div class="flex justify-between items-center bg-slate-900 text-white p-6 rounded-2xl shadow-xl shadow-slate-900/20">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-60">{{ __('Balance Due') }}</span>
                        <span class="text-2xl font-black italic">₹{{ number_format($projectPayment->project->balance_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="pt-20 border-t border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                <div>
                    <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] mb-4">{{ __('Payment Notes') }}</h4>
                    <p class="text-[10px] font-medium text-slate-500 max-w-md leading-relaxed">
                        {{ $projectPayment->note ?? __('Thank you for your prompt payment. This helps us maintain the project schedule and quality standards.') }}
                    </p>
                </div>
                <div class="text-right">
                    <div class="mb-4">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ urlencode(request()->fullUrl()) }}" alt="QR Code" class="ml-auto opacity-50 grayscale hover:opacity-100 hover:grayscale-0 transition-all">
                    </div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Digitally verified by AtomForge Finance</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #invoice, #invoice * {
                visibility: visible;
            }
            #invoice {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
            }
            header, footer, .no-print {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
