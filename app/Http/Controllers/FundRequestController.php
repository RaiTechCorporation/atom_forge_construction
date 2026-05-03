<?php

namespace App\Http\Controllers;

use App\Models\FundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FundRequestController extends Controller
{
    public function index()
    {
        $fundRequests = FundRequest::with('investor')->latest()->paginate(15);
        return view('admin.fund-requests.index', compact('fundRequests'));
    }

    public function approve(Request $request, FundRequest $fundRequest)
    {
        if ($fundRequest->status !== 'pending') {
            return back()->with('error', 'Request already processed.');
        }

        DB::transaction(function () use ($fundRequest) {
            $fundRequest->update([
                'status' => 'approved',
                'processed_by' => auth()->id(),
                'processed_at' => now(),
                'admin_notes' => request('admin_notes'),
            ]);

            $fundRequest->investor->increment('balance', $fundRequest->amount);
        });

        return back()->with('success', 'Fund request approved and balance credited.');
    }

    public function reject(Request $request, FundRequest $fundRequest)
    {
        if ($fundRequest->status !== 'pending') {
            return back()->with('error', 'Request already processed.');
        }

        $fundRequest->update([
            'status' => 'rejected',
            'processed_by' => auth()->id(),
            'processed_at' => now(),
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Fund request rejected.');
    }
}
