<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware(['jwt.verify'])->group(function () {
    // Auht routes
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });

    // User routes
    Route::prefix('user')->group(function () {
        Route::get('find/{id}', [UserController::class, 'findById']);
        Route::get('search', [UserController::class, 'search']);
        Route::post('add', [UserController::class, 'create']);
        Route::put('update/{id}', [UserController::class, 'update']);
        Route::put('reset_password/{id}', [UserController::class, 'resetPassword']);
        Route::delete('{id}', [UserController::class, 'delete']);
        Route::get('me', [UserController::class, 'me']);
    });

    // Role routes
    Route::prefix('role')->group(function () {
        Route::get('all', [RoleController::class, 'findAll']);
        Route::get('find/{id}', [RoleController::class, 'findById']);
        Route::get('search', [RoleController::class, 'search']);
        Route::post('add', [RoleController::class, 'create']);
        Route::put('update/{id}', [RoleController::class, 'update']);
        Route::delete('{id}', [RoleController::class, 'delete']);
    });

    // Permission routes
    Route::prefix('permission')->group(function () {
        Route::get('all', [PermissionController::class, 'findAll']);
        Route::get('search', [PermissionController::class, 'search']);
    });

    // Country routes
    Route::prefix('country')->group(function () {
        Route::get('all', [CountryController::class, 'findAll']);
        Route::get('find/{id}', [CountryController::class, 'findById']);
        Route::get('search', [CountryController::class, 'search']);
        Route::post('add', [CountryController::class, 'create']);
        Route::put('update/{id}', [CountryController::class, 'update']);
        Route::delete('{id}', [CountryController::class, 'delete']);
    });

    // City routes
    Route::prefix('city')->group(function () {
        Route::get('all', [CityController::class, 'findAll']);
        Route::get('find/{id}', [CityController::class, 'findById']);
        Route::get('search', [CityController::class, 'search']);
        Route::post('add', [CityController::class, 'create']);
        Route::put('update/{id}', [CityController::class, 'update']);
        Route::delete('{id}', [CityController::class, 'delete']);
    });

    // Customer routes
    Route::prefix('customer')->group(function () {
        Route::get('find/{id}', [CustomerController::class, 'findById']);
        Route::get('search', [CustomerController::class, 'search']);
        Route::post('add', [CustomerController::class, 'create']);
        Route::put('update/{id}', [CustomerController::class, 'update']);
        Route::delete('{id}', [CustomerController::class, 'delete']);
    });

    // Payment type routes
    Route::prefix('payment-type')->group(function () {
        Route::get('all', [PaymentTypeController::class, 'findAll']);
        Route::get('find/{id}', [PaymentTypeController::class, 'findById']);
        Route::get('search', [PaymentTypeController::class, 'search']);
        Route::post('add', [PaymentTypeController::class, 'create']);
        Route::put('update/{id}', [PaymentTypeController::class, 'update']);
        Route::delete('{id}', [PaymentTypeController::class, 'delete']);
    });
});
