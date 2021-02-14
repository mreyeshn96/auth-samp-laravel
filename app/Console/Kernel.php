<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Http\Controllers\AuthController;
use App\Models\AuthClient;
use App\Models\AuthHost;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $this->call(function() {
            $pendingClient = AuthClient::AuthHost()->where("ahost_ip", "LIKE", "INPROGRESS")->get();
            $handleAuth = new AuthController();
            foreach($pendingClient->AuthHost() as $currentHost)
            {
                $stateAuth = $handleAuth->getStatusAuth("$currentHost->ahost_ip");
                if( filter_var($stateAuth, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) )
                {
                    $updateHost = $pendingClient->AuthHost()->update([
                        'ahost_ip' => $stateAuth
                        ]
                    );
                }
            }

        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
