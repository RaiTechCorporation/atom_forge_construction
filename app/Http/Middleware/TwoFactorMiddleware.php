<?php

namespace App\Http\Middleware;

use App\Notifications\SendTwoFactorCode;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (auth()->check() && $user->two_factor_enabled) {
            if (! $request->is('verify-two-factor*') && ! session()->has('two_factor_verified')) {
                if (! $user->two_factor_code || $user->two_factor_expires_at->isPast()) {
                    $user->generateTwoFactorCode();
                    $user->notify(new SendTwoFactorCode);
                }

                return redirect()->route('verify.index');
            }
        }

        return $next($request);
    }
}
