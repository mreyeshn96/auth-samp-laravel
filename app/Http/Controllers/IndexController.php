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

    public function index()
    {
        if( Auth::check() )
        {
            return $this->auth_page();
        }
        else
        {
            return $this->login_page();
        }
    } 

    public function login_page()
    {
        return view("client.login");
    }

    public function auth_page()
    {
        return view("client.auth");
    }
}
