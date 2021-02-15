<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MaintenanceModeMiddleware
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
        $enableMaintenance = true;
        if( $enableMaintenance )
        {
            $request->session()->flash("result_code", "MAINT_MODE");
            $request->session()->flash("result_code", env("MAINTENANCE_TEXT"));
            return redirect()->route("index.auth");
        }
        return $next($request);
    }
}
