<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SampQueryAPI;
use Exception;

class ShowSampDashboard extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __invoke(Request $request)
    {
        try {
            $sampInstance = new SampQueryAPI();
            $sampIsOnline = $sampInstance->isOnline();
            $sampPlayers = null;
            $sampInfo = null;
            if( $sampIsOnline )
            {
                $sampInfo = $sampInstance->getInfo();
                $sampPlayers = $sampInstance->getDetailedPlayers();
            }
        }
        catch(Exception $ex)
        {
            $sampIsOnline = false;
            $sampInfo = null;
            $sampPlayers = null;
        }
        
        return view('admin.samp-server', compact("sampIsOnline", "sampPlayers", "sampInfo"));
    }
}
