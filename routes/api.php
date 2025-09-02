<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommonController;

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
Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);
Route::get('/logout',[AuthController::class, 'logout']);
Route::post('/fetch-professionals',[CommonController::class, 'fetch_professionals']);
Route::get('/fetch-specialities',[CommonController::class, 'fetch_specialities']);
Route::post('/view-professional',[CommonController::class, 'view_professional']);
Route::post('/book-appointment',[CommonController::class, 'book_appointment']);
Route::post('/my-appointments',[CommonController::class, 'my_appointment']);
Route::post('/update-appointment-status',[CommonController::class, 'update_appointment_status']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
