<?php

use App\Http\Controllers\AuthStaffController;
use App\Http\Controllers\StudentController;
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
Route::middleware('auth:api')->group(function () {
    Route::post('staff/import',[StudentController::class,'import']);
    Route::get('student/search', [StudentController::class,'search']);
    Route::apiResource('student', StudentController::class);
});
Route::post('staff/login',[AuthStaffController::class,'login']);


