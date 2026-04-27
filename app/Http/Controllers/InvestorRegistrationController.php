<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestorRegistrationController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        if ($user->investor) {
            return redirect()->route('investor.dashboard');
        }

        return view('investor.register');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->investor) {
            return redirect()->route('investor.dashboard');
        }

        $request->validate([
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        $user->investor()->create([
            'name' => $user->name,
            'phone' => $request->phone,
            'email' => $user->email,
            'address' => $request->address,
            'status' => 'active',
        ]);

        // Ensure user role is investor
        if ($user->role !== 'investor') {
            $user->update(['role' => 'investor']);
        }

        return redirect()->route('investor.dashboard')
            ->with('success', 'Investor profile created successfully! Welcome to the investor portal.');
    }
}
