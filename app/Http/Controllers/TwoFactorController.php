<?php

namespace App\Http\Controllers;

use App\Notifications\SendTwoFactorCode;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function index()
    {
        return view('auth.two-factor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required|integer',
        ]);

        $user = auth()->user();

        if ($request->input('two_factor_code') == $user->two_factor_code && $user->two_factor_expires_at->isFuture()) {
            $user->resetTwoFactorCode();

            session(['two_factor_verified' => true]);

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['two_factor_code' => 'The two factor code you entered is invalid or has expired.']);
    }

    public function resend()
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();
        $user->notify(new SendTwoFactorCode);

        return back()->with('status', 'The two factor code has been sent again.');
    }
}
