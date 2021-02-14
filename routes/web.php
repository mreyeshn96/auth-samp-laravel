<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampQueryAPI;
use Laravel\Socialite\Facades\Socialite;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

use App\Http\Controllers\AuthController;
use App\Models\AuthClient;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->middleware("throttle:10,1")->name("index.auth");
Route::get('/logout', function() {
    Auth::logout();
    return redirect()->route("index.auth");
})->name("user.logout");

Route::get('oauth/{driver_name}/redirect', [App\Http\Controllers\SocialiteController::class, 'redirect'])->name("oauth.redirect");
Route::get('oauth/{driver_name}/callback', [App\Http\Controllers\SocialiteController::class, 'callback'])->name("oauth.callback");

Route::group(['middleware' => ['grecaptchamd', 'certificatemd']], function() {
    Route::post('run/auth', [App\Http\Controllers\AuthController::class, 'index'])->name("run.auth");
    
});

Route::group(['prefix' => 'admin', 'middleware' => ['role:super-admin']], function() {
    Route::get("dashboard", App\Http\Controllers\ShowDashboard::class)->name("admin.dashboard");
    Route::get("samp", App\Http\Controllers\ShowSampDashboard::class)->name("admin.samp");
});
