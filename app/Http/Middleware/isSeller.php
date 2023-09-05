<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isSeller
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
        $user = auth()->user();
        if(!$user ){
            return redirect('/login')->withErrors(['You must be logged in to access this page']);
        }

        if(!$user->is_seller){
            return redirect('/')->withErrors(['ghayraa']);
        }

        return $next($request);
    }
}
