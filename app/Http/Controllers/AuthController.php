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
    protected $clientIp;

    public function __construct(Request $request)
    {
        $this->instanceHandle = new ApiAuthController();
        $this->clientIp = env("APP_ON_CLOUDFLARE") ? $_SERVER['HTTP_CF_CONNECTION_IP'] : $request->ip();
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
        $existAuthRow = AuthHost::where("acc_id", $accountid)->orWhere("user_ip", "LIKE", $userip);
        $existAuthApi = $this->instanceHandle->existAuth($userip);

        if( $existAuthApi && !$existAuthRow )
        {
            // Si en un caso existe la IP en el API pero no en los registros.
            $currentAuthState = $this->instanceHandle->getStatusAuth($userip);
            
        }

        return true;
    }

    public function AddAuth($accountid, $userip)
    {
        $this->instanceHandle->AddAuth($userip);
        
        $addHost = new AuthHost();
        $addHost->ahost_ip = "INPROGRESS";
        $addHost->save();
        

        AuthClient::created([
            "ahost_id" => $addHost->id,
            "acc_id" => $accountid,
            "user_ip" => $this->clientIp
        ]);

        return true;
    }

    public function index()
    {
        $currentStatus = $this->existAuth(Auth::user()->acc_id, $this->clientIp);
        $responseInfo = array();

        if( strcmp($currentStatus, "NOTFOUND") === 0 )
        {
            $this->AddAuth(Auth::user()->acc_id, $this->clientIp);

            do
            {
                $response[1] = $this->instanceHandle->getStatusAuth($this->clientIp);
                sleep(1);
            }
            while( strcmp($response[1], "INPROGRESS") === 0 );
            $response[0] = "SUCCESS_AUTH";
        }
        else if( strcmp($currentStatus, "INPROGRESS") === 0 )
        {
            $response[0] = "INPROGRESS_AUTH";
        }
        else if( filter_var($currentStatus, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) )
        {
            $response[0] = "SUCCESS_AUTH";
            $response[1] = $currentStatus;
        }
        else
        {

        }

        return view("client.message", compact("responseInfo"));
    }
}
