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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('positions', App\Http\Controllers\API\PositionsAPIController::class);

Route::resource('departments', App\Http\Controllers\API\DepartmentsAPIController::class);

Route::resource('employesses', App\Http\Controllers\API\EmployessAPIController::class);
