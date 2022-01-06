<?php

use App\Http\Controllers\AuthController;
use App\Jobs\SendMailJob;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $user = User::first();
    for($i=0; $i < 20; $i++){
        dispatch(new SendMailJob($user));
    }
    return "Mail sent";
});
Route::view("/login","login");
Route::view("/admin","admin")->middleware(["authM"]);
Route::view("/author","author")->middleware(["authM",'checkAuthorism']);
Route::post("login", [AuthController::class, "login"])->name("user.login");
Route::get("logout", [AuthController::class, "logout"])->name("user.logout");