<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
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

// Auht routes
Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'auth'
], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

// User routes
Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'user'
], function () {
    Route::get('find/{id}', [UserController::class, 'findById']);
    Route::get('search', [UserController::class, 'search']);
    Route::post('add', [UserController::class, 'create']);
    Route::put('update/{id}', [UserController::class, 'update']);
    Route::put('reset_password/{id}', [UserController::class, 'resetPassword']);
    Route::delete('{id}', [UserController::class, 'delete']);
    Route::get('me', [UserController::class, 'me']);
});

// Role routes
Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'role'
], function () {
    Route::get('all', [RoleController::class, 'findAll']);
    Route::get('find/{id}', [RoleController::class, 'findById']);
    Route::get('search', [RoleController::class, 'search']);
    Route::post('add', [RoleController::class, 'create']);
    Route::put('update/{id}', [RoleController::class, 'update']);
    Route::delete('{id}', [RoleController::class, 'delete']);
});

// Permission routes
Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'permission'
], function () {
    Route::get('all', [PermissionController::class, 'findAll']);
    Route::get('search', [PermissionController::class, 'search']);
});

// Country routes
Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'country'
], function () {
    Route::get('all', [CountryController::class, 'findAll']);
    Route::get('find/{id}', [CountryController::class, 'findById']);
    Route::get('search', [CountryController::class, 'search']);
    Route::post('add', [CountryController::class, 'create']);
    Route::put('update/{id}', [CountryController::class, 'update']);
    Route::delete('{id}', [CountryController::class, 'delete']);
});

// City routes
Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'city'
], function () {
    Route::get('all', [CityController::class, 'findAll']);
    Route::get('find/{id}', [CityController::class, 'findById']);
    Route::get('search', [CityController::class, 'search']);
    Route::post('add', [CityController::class, 'create']);
    Route::put('update/{id}', [CityController::class, 'update']);
    Route::delete('{id}', [CityController::class, 'delete']);
});