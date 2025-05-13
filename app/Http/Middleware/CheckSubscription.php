<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($request->is('login') || $request->is('register')) {
            return $next($request);
        }

        $subscription = $user->subscriptions()
            ->where('subscription_ends_at', '>', now())
            ->orderByDesc('subscription_ends_at')
            ->first();

        if (!$subscription) {
            return redirect()->route('find.location')
                ->with('error', 'Your subscription has expired. Please subscribe.');
        }

        return $next($request);
    }
}
