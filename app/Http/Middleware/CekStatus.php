<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$statuss): Response
    {
        $user = Auth::user();

        if ($user->status !== $statuss && $user->status !== 'admin') {
            return redirect('/login'); // Redirect to home or a "No Access" page
        }
        return $next($request);
    }
}
