<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Fund Requests') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Review and verify investor fund additions.') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-xl flex items-center gap-3" role="alert">
                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-semibold text-emerald-800 text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Investor</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Amount</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Method</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Details</th>
                            <th class="px-6 py-4 text-left text-[10px] font-bold text-slate-500 uppercase tracking-widest">Status</th>
                            <th class="px-6 py-4 text-right text-[10px] font-bold text-slate-500 uppercase tracking-widest">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($fundRequests as $request)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="text-sm font-bold text-slate-900">{{ $request->investor->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-black text-slate-900">₹{{ number_format($request->amount, 2) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">{{ str_replace('_', ' ', $request->payment_method) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs text-slate-500">
                                        @if($request->reference_number)
                                            <p><span class="font-bold">Ref:</span> {{ $request->reference_number }}</p>
                                        @endif
                                        @if($request->receipt_proof)
                                            <a href="{{ asset('storage/' . $request->receipt_proof) }}" target="_blank" class="text-indigo-600 hover:underline font-bold">View Receipt</a>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full border
                                        {{ $request->status === 'approved' ? 'bg-emerald-50 border-emerald-200 text-emerald-700' : '' }}
                                        {{ $request->status === 'pending' ? 'bg-amber-50 border-amber-200 text-amber-700' : '' }}
                                        {{ $request->status === 'rejected' ? 'bg-red-50 border-red-200 text-red-700' : '' }}">
                                        {{ $request->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($request->status === 'pending')
                                        <div class="flex justify-end gap-2">
                                            <button onclick="openProcessModal('{{ $request->id }}', 'approve')" class="px-3 py-1.5 bg-emerald-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-lg hover:bg-emerald-700 transition-colors">Approve</button>
                                            <button onclick="openProcessModal('{{ $request->id }}', 'reject')" class="px-3 py-1.5 bg-red-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-lg hover:bg-red-700 transition-colors">Reject</button>
                                        </div>
                                    @else
                                        <div class="text-[10px] text-slate-400 font-bold uppercase italic">
                                            Processed on {{ $request->processed_at->format('M d, Y') }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center text-slate-500 font-medium">No fund requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($fundRequests->hasPages())
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                    {{ $fundRequests->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Process Modal -->
    <div id="processModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="closeProcessModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-100">
                <form id="processForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="bg-white px-8 pt-8 pb-6">
                        <h3 class="text-xl font-bold text-slate-900 mb-4" id="modalTitle">Process Fund Request</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1">Admin Notes</label>
                                <textarea name="admin_notes" rows="3" class="w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-600/5 transition-all text-sm font-medium" placeholder="Optional notes..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-8 py-6 flex flex-row-reverse gap-3">
                        <button type="submit" id="submitBtn" class="px-6 py-2.5 bg-indigo-600 text-white text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20">Confirm</button>
                        <button type="button" onclick="closeProcessModal()" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-600 text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-slate-50 transition-all">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openProcessModal(id, action) {
            const form = document.getElementById('processForm');
            const title = document.getElementById('modalTitle');
            const btn = document.getElementById('submitBtn');
            
            form.action = `/fund-requests/${id}/${action}`;
            title.innerText = action === 'approve' ? 'Approve Fund Request' : 'Reject Fund Request';
            btn.className = action === 'approve' 
                ? 'px-6 py-2.5 bg-emerald-600 text-white text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20'
                : 'px-6 py-2.5 bg-red-600 text-white text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-red-700 transition-all shadow-lg shadow-red-600/20';
            
            document.getElementById('processModal').classList.remove('hidden');
        }

        function closeProcessModal() {
            document.getElementById('processModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
