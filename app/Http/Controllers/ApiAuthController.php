<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    protected $apiUrl;
    protected $apiKey;
    protected $apiResponse;

    public function __construct()
    {
        $this->apiKey = env("API_AUTH_KEY");
        $this->apiUrl = "https://test.tradingfreecurso.site/api.php?api_key=$this->apiKey";
    }

    public function Healthly()
    {
        $bindUrl = "$this->apiUrl&statusip=1.9.2.3";
        $this->apiResponse = file_get_contents($bindUrl);
        $this->apiResponse = json_decode($this->apiResponse, true);
        $this->apiResponse = $this->apiResponse['response'];

        return strcmp($this->apiResponse, "NOTFOUND") === 0 ? true : false;
    }

    public function existAuth($userip)
    {
        $bindUrl = "$this->apiUrl&statusip=$userip";

        $this->apiResponse = file_get_contents($bindUrl);
        $this->apiResponse = json_decode($this->apiResponse, true);
        $this->apiResponse = $this->apiResponse['response'];

        return strcmp($this->apiResponse, "INPROGRESS") === 0 || filter_var($this->apiResponse, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? true : false;
    }

    public function AddAuth($userip)
    {
        $bindUrl = "$this->apiUrl&addip=$userip";
        $this->apiResponse = file_get_contents($bindUrl);
        $this->apiResponse = json_decode($this->apiResponse, true);
        $this->apiResponse = $this->apiResponse['response'];
    }

    public function getStatusAuth($userip)
    {
        $bindUrl = "$this->apiUrl&statusip=$userip";
        $this->apiResponse = file_get_contents($bindUrl);
        $this->apiResponse = json_decode($this->apiResponse, true);
        $this->apiResponse = $this->apiResponse['response'];
        return $this->apiResponse;
    }
}
