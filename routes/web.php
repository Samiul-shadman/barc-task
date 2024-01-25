<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddlware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/user-create',[UserController::class, 'UserRegistration']);
Route::post('/user-login',[UserController::class, 'UserLogin']);
Route::get('/user-logout', [UserController::class, 'UserLogout']);

Route::get('/user-exam', [UserController::class, 'UserExams'])->middleware([TokenVerificationMiddlware::class]);
