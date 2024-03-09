<?php

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // public routes
    Route::post('/login', [ApiAuthController::class, 'login']);
});

Route::middleware('api.auth')->group(function () {
   Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    // our routes to be protected will go in here
});

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
