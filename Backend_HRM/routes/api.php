<?php

use App\Http\Controllers\API\courses_score_excel_filesAPIController;
use App\Http\Controllers\API\coursesAPIController;
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


//Route::resource('position', App\Http\Controllers\API\PositionsAPIController::class);
Route::prefix('positions')->group(function (){
    Route::post('create', [\App\Http\Controllers\API\PositionsAPIController::class, 'store']);
    Route::post('update/{id}', [\App\Http\Controllers\API\PositionsAPIController::class, 'update']);
    Route::delete('delete/{id}', [\App\Http\Controllers\API\PositionsAPIController::class, 'destroy']);
    Route::get('list', [\App\Http\Controllers\API\PositionsAPIController::class, 'index']);
});
//Route::resource('job_statuses', App\Http\Controllers\API\Job_statusAPIController::class);
Route::prefix('job_statuses')->group(function (){
    Route::post('create', [\App\Http\Controllers\API\PositionsAPIController::class, 'store']);
    Route::post('update/{id}', [\App\Http\Controllers\API\PositionsAPIController::class, 'update']);
    Route::delete('delete/{id}', [\App\Http\Controllers\API\PositionsAPIController::class, 'destroy']);
    Route::get('list', [\App\Http\Controllers\API\PositionsAPIController::class, 'index']);
});


Route::prefix('course')->group(function () {
    Route::get('all',[coursesAPIController::class,'index']);
    Route::post('create',[coursesAPIController::class,'store']);
    Route::post('update/{id}',[coursesAPIController::class,'update']);
    Route::delete('delete/{id}',[coursesAPIController::class,'destroy']);
});
Route::prefix('course_score')->group(function () {
    Route::get('all',[courses_score_excel_filesAPIController::class,'index']);
    Route::post('create',[courses_score_excel_filesAPIController::class,'store']);
    Route::post('update/{id}',[courses_score_excel_filesAPIController::class,'update']);
    Route::delete('delete/{id}',[courses_score_excel_filesAPIController::class,'destroy']);

});



