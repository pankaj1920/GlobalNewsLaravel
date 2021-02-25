<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('admin_register',[AdminAuthController::class,'admin_register']);
Route::post('admin_email_login',[AdminAuthController::class,'admin_email_login']);
Route::post('admin_mobile_login',[AdminAuthController::class,'admin_mobile_login']);
Route::post('verify_otp',[AdminAuthController::class,'verify_otp']);