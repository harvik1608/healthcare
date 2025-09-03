<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfessionalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('sign_in');
});
Route::get('/sign-in', [CustomAuthController::class, 'index'])->name("user.sign-in");
Route::post('/submit-signin', [CustomAuthController::class, 'submit_signin'])->name("submit-signin");
Route::get('/sign-up', [CustomAuthController::class, 'sign_up'])->name("user.sign-up");
Route::post('/submit-signup', [CustomAuthController::class, 'submit_signup'])->name("user.signup");
Route::get('/logout', [CustomAuthController::class, 'logout'])->name("user.logout");
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('user.dashboard');
Route::get('/professionals', [ProfessionalController::class, 'index'])->middleware('auth')->name('user.professionals');
Route::get('/load-professionals', [ProfessionalController::class, 'load'])->middleware('auth')->name('user.load_professionals');
Route::get('/professionals/{id}', [ProfessionalController::class, 'show'])->middleware('auth')->name('user.professionals.show');
Route::post('/book', [ProfessionalController::class, 'book'])->middleware('auth')->name('user.book_appointment');
Route::get('/appointments', [ProfessionalController::class, 'my_appointments'])->middleware('auth')->name('user.appointments');
Route::get('/cancel-appointment/{id}', [ProfessionalController::class, 'cancel'])->middleware('auth')->name('user.cancel_appointment');
Route::get('/complete-appointment/{id}', [ProfessionalController::class, 'complete'])->middleware('auth')->name('user.complete_appointment');