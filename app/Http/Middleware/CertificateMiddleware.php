<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateMiddleware
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
        $minCertificate = env("ACCOUNT_MIN_CERTIFICATE");
        if( Auth::user()->GameAccount->Certificado < $minCertificate )
        {
            $request->session()->flash("result_code", "MIN_CERTIFICATE");
            $request->session()->flash("result_aux", "");
            Auth::logout();
            return redirect()->route("index.auth");
        }
        return $next($request);
    }
}
