<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use  App\Http\Controllers\partyController;


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
Route::post('/login',[userController::class, 'login'] );

Route::post('/signUp',[userController::class, 'signUp'] );

Route::post('/uploadProfileImage',[userController::class, 'uploadProfileImage'] );

Route::post('/insertDeviceToken',[userController::class, 'insertDeviceToken'] );

Route::get('/getDeviceToken/{id}',[userController::class, 'getDeviceToken'] );
Route::get('/user/{id}',[userController::class, 'getUser'] );
Route::post('/createParty',[partyController::class, 'createParty'] );
Route::get('/getParties/{id}',[partyController::class, 'getPartyDetails'] );