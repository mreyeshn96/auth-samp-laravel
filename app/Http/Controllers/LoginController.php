<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     /**
     * Redirect the user to the google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $googleApi = Socialite::driver('google')->user();
        $currentUserRp = User::where('Email', $googleApi->getEmail())->first();
        $sessionId = $this->generateRandomString(10);

        if( $currentUserRp )
        {
            Auth::login($currentUserRp);

            $currentUserRp->google_id = $googleApi->getId();
            $currentUserRp->google_lastsessionid = $sessionId;
            $currentUserRp->save();
            
            $currentGoogleUser = googleUser::find($googleApi->getId());
            $currentGameUser = gameUser::find(Auth::user()->ID);

            if( !$currentGoogleUser )
            {
                $addGooglerUser = googleUser::create([ 
                    'gouser_id' => $googleApi->getId(),
                    'gouser_name' => $googleApi->getName(),
                    'gamuser_id' => Auth::user()->ID,
                    'gouser_nick' => Auth::user()->Nick,
                    'gouser_avatar' => $googleApi->getAvatar(),
                    'gouser_email' => $googleApi->getEmail(),
                    'gouser_ip' => $_SERVER["HTTP_CF_CONNECTING_IP"],
                ]);
            }

            if( !$currentGameUser )
            {
                $addGameUser = gameUser::create([ 
                   'gamuser_id' => Auth::user()->ID,
                   'gamuser_nick' => Auth::user()->Nick,
                ]);
            }

            $logGoogleLogin = googleUserLogin::create([
                'gosession_token' => $sessionId,
                'gouser_ip' => $_SERVER["HTTP_CF_CONNECTING_IP"],
                'gouser_id' => $googleApi->getId()
            ]);

            return redirect('/');
        }
        else
        {
            return redirect()->route("api.result", ['result_state' => 'error', 'result_aux' => "ERR04"]);
        }




        /*
        $myUser = Socialite::driver('google')->user();
        $manageUser = User::where('Email', $myUser->getEmail())->first();

        if( !$manageUser )
        {
            // $manageUser = User::create([
            //     'name' => $myUser->getName(),
            //     'email' => $myUser->getEmail(),
            //     'google_id' => $myUser->getId(),
            //     'google_avatar' => $myUser->getAvatar(),
            // ]);
            return redirect('/unkownemail');
        }
        else {
            Auth::login($manageUser);

            if( Auth::user()->Certificado < env("AUTH_MINIMUM_CERTIFICATE") )
            {
                return redirect('/invalidcert');
            }

            return redirect('/');
        }
        
        // $user->token;
        */
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
