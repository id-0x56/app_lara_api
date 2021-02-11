<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//http://app_lara.test/api/home?name=the&price_start=374662.00&price_end=384356.00&bedroom=4&bathroom=2&storey=2&garage=2
Route::get('/house/{query?}', [\App\Http\Controllers\HouseController::class, 'search']);
