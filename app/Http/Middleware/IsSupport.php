<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSupport
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if(!$user->is_support && !$user->is_admin){
            return redirect('/')->withErrors(["Sorry you're not authorized to see this page"]);
        }

        return $next($request);
    }
}
