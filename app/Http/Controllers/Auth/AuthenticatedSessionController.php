<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();
        
        \Log::debug('User logged in: ' . $user->email . ' with role: ' . $user->role);

        if ($user->isAdmin()) {
            \Log::debug('Redirecting to dashboard');
            return redirect()->intended(route('dashboard'));
        } elseif ($user->isInvestor()) {
            \Log::debug('Redirecting to investor dashboard');
            return redirect()->intended(route('investor.dashboard'));
        } elseif ($user->isClient()) {
            \Log::debug('Redirecting to client-portal');
            return redirect()->intended('/client-portal');
        }

        \Log::debug('Redirecting to dashboard');
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
