<?php

use App\Http\Controllers\V1\API\Account\AccountController;
use App\Http\Controllers\V1\API\Account\AccountMarketplaceController;
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
    Route::group(['prefix' => 'account', 'middleware' => 'account'], function () {
        Route::get('/', [AccountController::class, 'show']);
        Route::get('/marketplaces', [AccountMarketplaceController::class, 'index']);


        Route::group(['middleware' => 'marketplace'], function () {
            Route::group(['prefix' => 'advertising', 'middleware' => 'advertising'], function () {
                Route::resource('portfolios', PortfolioController::class, ['only' => ['index', 'show']]);
            });
        });
    });
});
