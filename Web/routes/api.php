<?php

use App\Http\Controllers\MarketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\EmailVerificationRequest;
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
// Protected routes
Route::middleware(['auth:sanctum','approved'])->group(function (){
    Route::group(['prefix' => 'users'], function(){
        Route::get('approved', [UserController::class, 'getAllApproved']);
        Route::get('role/{role}', [UserController::class, 'getByRole']);
        Route::apiResource('',UserController::class)->parameter('','user');
        Route::put('profile/{profile}', [ProfileController::class, 'update']);
        Route::post('register', [UserController::class, 'register']);
    });

//    Route::post('users/register', [UserController::class, 'register']);
    // Market endpoints
    Route::group(['prefix' => 'markets'], function (){
        Route::post('',[MarketController::class, 'storeMarket']);
        Route::post('/relations', [MarketController::class, 'getAllWithGivenRelations']);
        Route::post('/{market}/relations', [MarketController::class, 'getByIdWithGivenRelations']);
        Route::put('/{market}', [MarketController::class, 'updateMarket']);
        Route::delete('/{market}', [MarketController::class, 'destroyMarket']);
        Route::delete('/{market}', [MarketController::class, 'destroyMarket']);
    });
    // MarketBranch endpoints
    Route::group(['prefix' => 'market-branches'], function (){
        Route::post('/{marketBranch}/subscribe', [MarketController::class, 'toggleUserSubscriptionToMarketBranch']);
        Route::post('/{market}/{city}', [MarketController::class, 'storeMarketBranch']);
        Route::put('/{marketBranch}', [MarketController::class, 'updateMarketBranch']);
        Route::delete('/{marketBranch}', [MarketController::class, 'destroyMarketBranch']);
    });
    Route::apiResource('cities',CityController::class);
});

// Public routes
Route::post('login', [AuthController::class, 'login'])->name('login');
// Mobile registration
Route::post('register', [AuthController::class, 'register']);

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect(env('APP_URL').'/verified');
})->name('verification.verify');


