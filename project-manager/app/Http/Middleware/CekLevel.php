<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLevel
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        $user = $request->user();

        if ($user && in_array($user->level, $levels)) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have access to this section.');
    }
}
