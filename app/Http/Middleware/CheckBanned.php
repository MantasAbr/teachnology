<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && (auth()->user()->is_blocked == 0)){
            
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Jūsų paskyra užblokuota');
        }
        return $next($request);
    }
}
