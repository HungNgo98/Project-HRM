<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\coursesAPIController;
use App\Http\Controllers\API\courses_score_excel_filesAPIController;

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


Route::resource('courses', coursesAPIController::class);


Route::resource('courses_score_excel_files', courses_score_excel_filesAPIController::class);

Route::resource('positions', App\Http\Controllers\API\PositionsAPIController::class);

Route::resource('departments', DepartmentsAPIController::class);

Route::resource('employesses', EmployessAPIController::class);

Route::prefix('course')->group(function () {
    Route::get('all',[coursesAPIController::class,'index']);
    Route::post('create',[coursesAPIController::class,'store']);
});
