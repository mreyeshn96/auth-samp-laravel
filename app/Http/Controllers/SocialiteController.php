<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    protected $driverSocial;

    public function __construct(Request $request)
    {
        $this->driverSocial = $request->route('driver_name');
    }

    public function redirect(Request $request)
    {
        return Socialite::driver($this->driverSocial)->redirect();
    }

    public function callback(Request $request)
    {
        $driverAccount = Socialite::driver($this->driverSocial)->user();
        return redirect('/');
    }
}
