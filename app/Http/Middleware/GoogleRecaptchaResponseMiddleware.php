<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Exception;

class GoogleRecaptchaResponseMiddleware
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
        $protocolSite = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $currentURL = $protocolSite . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
        try
        {
            $valueCaptcha = $_POST['g-recaptcha-response'];
            $secretKey = env('GOOGLE_RECAPTCHA_SECRET_KEY');
            $responseCaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$valueCaptcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
            $responseCaptcha = json_decode($responseCaptcha);

            if( !$responseCaptcha->success )
            {
                return redirect()->back()->with('recaptcha-error', 'No se ha completado correctamente la seguridad anti-robots.');
            }
        }
        catch(Exception $e)
        {
            return redirect()->back()->with('recaptcha-error', 'No se ha completado correctamente la seguridad anti-robots.');
        }
        
        
        return $next($request);
    }
}
