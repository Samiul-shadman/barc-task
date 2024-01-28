<?php

use App\Http\Controllers\ExamAnsController;
use App\Http\Controllers\ExamController;
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
    return view('pages.auth.login-page');
});

Route::get('/login',[UserController::class, 'loginPage']);
Route::get('/registration',[UserController::class, 'registrationPage']);
Route::post('/user-create',[UserController::class, 'UserRegistration']);
Route::post('/user-login',[UserController::class, 'UserLogin']);
Route::get('/user-logout', [UserController::class, 'UserLogout']);


Route::middleware('tokenVerification')->group( function(){
    Route::get('/user-exam', [ExamController::class, 'UserExams']);
    Route::get('/exam-list',[UserController::class,'ExamList']);

    Route::post('/exam-page',[ExamController::class, 'ExamIdCheck']);
    Route::get('/page-question/{id}', [ExamController::class, 'ExamPage']);
    Route::get('/exam-question', [ExamController::class, 'ExamQuestion']);
    Route::post('/ans-store/{exam_id}', [ExamController::class, 'AnsStore']);
    Route::get('/exam-result', [ExamController::class, 'ExamResult']);
});


Route::post('/user-registration',[UserController::class,'UserRegistration']);
Route::post('/user-login',[UserController::class,'UserLogin']);
