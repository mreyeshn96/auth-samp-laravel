<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiAuthController;

class HealthlyApiMiddleware
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
        $instanceHandle = new ApiAuthController;
        if( !$instanceHandle->Healthly() )
        {
            $request->session()->flash("result_code", "FAIL_HEALTH");
            $request->session()->flash("result_aux", "FAIL_HEALTH");
            return redirect()->route("index.auth");
        }
        return $next($request);
    }
}
