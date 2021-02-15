<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public $clientIp;

    public function __construct(Request $request)
    {
        $this->clientIp = env("APP_ON_CLOUDFLARE") ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $request->ip();
    }

    public function index(Request $request)
    {
        if( env("MAINTENANCE_MODE") == false )
        {
            if( $request->session()->has("result_code") )
            {
                return $this->message_page($request);
            }
            else
            {
                if( Auth::check() )
                {
                    return $this->auth_page($request);
                }
                else
                {
                    return $this->login_page($request);
                }
            }
        }
        else
        {
            return view("client.maintenance");
        }
    }

    public function login_page($request)
    {
        $request->session()->put("can_auth", "0");
        return view("client.login");
    }

    public function auth_page($request)
    {

        $request->session()->put("can_auth", "1");
        return view("client.auth");
    }

    public function message_page($requestp)
    {
        $resultCode = $requestp->session()->get("result_code");
        $resultAux = $requestp->session()->get("result_aux");
        return view("client.message", compact("resultCode", "resultAux"));
    }
}
