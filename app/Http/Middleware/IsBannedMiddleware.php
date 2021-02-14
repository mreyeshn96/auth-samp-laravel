<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsBannedMiddleware
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
        if( Auth::check() && Auth::user()->BannedInfo->where('jugador', Auth::user()->GameAccount->ID)->where('baneado', 1)->first() )
        {
            $request->session()->flash("result_code", "BANNED_ACCOUNT");
            $request->session()->flash("result_aux", Auth::user()->BannedInfo->razon);
            Auth::logout();
            return redirect()->route("index.auth");
        }
        return $next($request);
    }
}
