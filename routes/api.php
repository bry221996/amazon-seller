<?php

use App\Http\Controllers\V1\API\Account\AccountController;
use App\Http\Controllers\V1\API\Account\Advertising\PortfolioController;
use App\Http\Controllers\V1\API\Account\Advertising\ProfileController;
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

Route::group(['prefix' => 'v1'], function () {
    Route::get('/accounts/{account}', [AccountController::class, 'show']);

    Route::get('/accounts/{account}/advertising/profiles', [ProfileController::class, 'index']);
    Route::get('/accounts/{account}/advertising/profiles/{profile}/portfolios', [PortfolioController::class, 'index']);
});
