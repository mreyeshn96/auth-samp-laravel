<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ApiAuthController;
use App\Models\AuthHost;
use App\Models\AuthClient;

class AuthController extends Controller
{
    protected $instanceHandle;

    public function __construct()
    {
        $this->middleware("proxycheckmd");
        $this->instanceHandle = new ApiAuthController();
        
    }

    public function HealthlyService()
    {
        return true;
    }

    public function getStatusAuth($accountid, $userip)
    {
        
    }

    public function existAuth($accountid, $userip)
    {
        $existAuthRow = AuthClient::where("acc_id", $accountid)->first();
        //$existAuthApi = $this->instanceHandle->existAuth($userip);

        return $existAuthRow->ahost_id;
    }

    public function AddAuth($accountid, $userip)
    {
        $this->instanceHandle->AddAuth($userip);
        
        $addHost = new AuthHost();
        $addHost->ahost_ip = "INPROGRESS";
        $addHost->save();
        
        AuthClient::create([
            "ahost_id" => $addHost->ahost_id,
            "acc_id" => $accountid,
            "user_ip" => $this->clientIp
        ]);

        return true;
    }

    public function index(Request $request)
    {
        if( $request->session()->has("can_auth") )
        {
            if( $request->session()->get("can_auth") == 0 )
            {
                $responseInfo[0] = "INVALID_SESSION_ID";
                $responseInfo[1] = "";
            }
        }
        
        $this->clientIp = env("APP_ON_CLOUDFLARE") ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $request->ip();

        //$currentExist = $this->existAuth(Auth::user()->acc_id, $this->clientIp);
        $currentExist = $this->instanceHandle->existAuth($this->clientIp);
        $responseInfo = [];

        $responseInfo[1] = "";

        if( $currentExist )
        {
            $currentStatus = $this->instanceHandle->getStatusAuth($this->clientIp);            
            if( strcmp($currentStatus, "INPROGRESS") === 0 )
            {
                $responseInfo[0] = "INPROGRESS_AUTH";
            }
            else if( filter_var($currentStatus, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) )
            {
                AuthHost::where("ahost_id", "=", "$currentExist")->update([
                    'ahost_ip' => $currentStatus
                ]);

                $responseInfo[0] = "SUCCESS_AUTH";
                $responseInfo[1] = $currentStatus;
            }
            else
            {
                $responseInfo[0] = "ERROR_AUTH";
                $responseInfo[1] = $currentStatus;
            }
        }
        else
        {
            $this->AddAuth(Auth::user()->acc_id, $this->clientIp);
            $currentSecond = 0;
            do
            {
                if( $currentSecond >= 40 )
                {
                    break;
                }
                $responseInfo[1] = $this->instanceHandle->getStatusAuth($this->clientIp);
                $currentSecond++;
                sleep(1);
            }
            while( strcmp($responseInfo[1], "INPROGRESS") === 0 );

            if( $currentSecond >= 40 )
            {
                $request->session()->flash("demoring_auth", "1");
                return redirect()->route("index.auth");
            }
            $responseInfo[0] = "SUCCESS_AUTH";
        }

        $request->session()->flash("result_code", $responseInfo[0]);
        $request->session()->flash("result_aux", $responseInfo[1]);
        return redirect()->route("index.auth");
    }
}
