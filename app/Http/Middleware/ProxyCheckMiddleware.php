<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProxyCheckMiddleware
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
        $enabledProxyCheck = env("APP_PROXYCHECK_ENABLE");
        $apiKey = env("APP_PROXYCHECK_KEY");
        $clientIp = env("APP_ON_CLOUDFLARE") ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $request->ip();

        if( $enabledProxyCheck )
        {
            $bindUrl = "http://proxycheck.io/v2/clientIp?key=$apiKey&asn=1&vpn=1";
            $response = file_get_contents("$bindUrl");
            $response = json_decode($response, true);
            $response = $response["$clientIp"]["proxy"];

            if( strcmp($response, "yes") === 0 )
            {
                $request->session()->flash("result_code", "PROXY_DETECTED");
                $request->session()->flash("result_aux", "");
                Auth::logout();
                return redirect()->route("index.auth");
            }
        }
        return $next($request);
    }
}
