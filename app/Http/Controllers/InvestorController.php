<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $investors = \App\Models\Investor::withCount('investments')
            ->withSum('investments as total_invested', 'investment_amount')
            ->latest()
            ->paginate(12);

        return view('admin.investors.index', compact('investors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $investor = new Investor();
        return view('admin.investors.create', compact('investor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max-255',
            'email' => 'required|string|email|max-255|unique:users',
            'phone' => 'required|string|max-20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'password' => 'required|string|min:8|confirmed',
        ]);

        \DB::transaction(function () use ($request) {
            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Hash::make($request->password),
                'role' => 'investor',
            ]);

            $user->investor()->create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'status' => $request->status,
            ]);
        });

        return redirect()->route('investors.index')
            ->with('success', 'Investor registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $investor = \App\Models\Investor::with(['investments', 'payouts'])
            ->withCount('investments')
            ->withSum('investments as total_invested', 'investment_amount')
            ->findOrFail($id);

        return view('admin.investors.show', compact('investor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $investor = \App\Models\Investor::findOrFail($id);
        return view('admin.investors.edit', compact('investor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $investor = \App\Models\Investor::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $investor->user_id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        \DB::transaction(function () use ($request, $investor) {
            $user = $investor->user;
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $user->update(['password' => \Hash::make($request->password)]);
            }

            $investor->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'status' => $request->status,
            ]);
        });

        return redirect()->route('investors.index')
            ->with('success', 'Investor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $investor = \App\Models\Investor::findOrFail($id);
        
        \DB::transaction(function () use ($investor) {
            // The user will be deleted due to cascade onDelete in migration
            $investor->user->delete();
            $investor->delete();
        });

        return redirect()->route('investors.index')
            ->with('success', 'Investor deleted successfully.');
    }
}
