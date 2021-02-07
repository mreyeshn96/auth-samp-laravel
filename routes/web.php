<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampQueryAPI;
use Laravel\Socialite\Facades\Socialite;
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

Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);

Route::get('oauth/{driver_name}/redirect', [App\Http\Controllers\SocialiteController::class, 'redirect'])->name("oauth.redirect");
Route::get('oauth/callback', [App\Http\Controllers\SocialiteController::class, 'callback'])->name("oauth.callback");

Route::group(['prefix' => 'admin'], function() {
    Route::get("dashboard", App\Http\Controllers\ShowDashboard::class)->name("admin.dashboard");
    Route::get("samp", App\Http\Controllers\ShowSampDashboard::class)->name("admin.samp");
});
