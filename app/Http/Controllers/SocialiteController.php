<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\Facades\Socialite;

use App\Models\Account;
use App\Models\GameAccount;

class SocialiteController extends Controller
{
    public $driverSocial;

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
        $gameAccount = GameAccount::where("email", $driverAccount->getEmail())->first();

        if( !$gameAccount )
        {
            return view("client.message", ['message_code' => 'NOT_FOUND_ACCOUNT']);
        }
        else
        {
            $authAccount = Account::where("acc_nickname", "LIKE", $gameAccount->Nick)->first();

            if( !$authAccount )
            {
                Account::create([
                    'acc_nickname' => $gameAccount->Nick,
                    'acc_name' => $driverAccount->getName(),
                    'game_acc_id' => $gameAccount->ID
                ]);
            }

            $authAccount = Account::where("acc_nickname", $gameAccount->Nick)->first();
            Auth::login($authAccount);
        }

        return redirect('/');
    }
}
