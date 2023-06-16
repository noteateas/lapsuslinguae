<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecapController;
use App\Http\Controllers\SentenceController;
use App\Http\Controllers\TaskInfoController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [FrontController::class, 'home'])->name('home');

Route::get('/about',[FrontController::class, 'about'])->name('about');

Route::middleware('isntLoggedIn')->group(function (){
    Route::get('/login',[AccountController::class, 'getlogin'])->name('login');
    Route::post('/login',[AccountController::class, 'login']);

    Route::get('/register',[AccountController::class, 'getregister'])->name('register');
    Route::post('/register',[AccountController::class, 'register']);
    Route::get('/check-username-email',[AccountController::class, 'checkExistsEmailOrUsernameDuringRegister']);
});

Route::middleware('isLoggedIn')->group(function () {
    Route::get('/logout',[AccountController::class, 'logout'])->name('logout');

    Route::get('/practice',[PracticeController::class, 'index'])->name('practice');
    Route::get('/task/exit',[PracticeController::class, 'exitTask'])->name('exit-task');
    Route::get('/task/{id}',[PracticeController::class, 'task'])->name('task');
    Route::get('/task/{id}/check-translation',[PracticeController::class, 'checkAnswer']);
    Route::get('/practice/task-info/{id}',[PracticeController::class, 'taskInfoIndex'])->name('task-info');

    Route::get('/profile',[ProfileController::class, 'index'])->name('profile');
    Route::get('/edit-profile',[ProfileController::class, 'editProfileIndex'])->name('edit-profile');
    Route::post('/edit-profile',[ProfileController::class, 'editProfile']);
    Route::put('/delete-profile',[ProfileController::class, 'deleteProfile'])->name('delete-profile');

    Route::get('/change-password',[ProfileController::class, 'changePasswordIndex'])->name('change-password');
    Route::post('/change-password',[ProfileController::class, 'changePassword']);

    Route::get('/edit-goal',[ProfileController::class, 'editGoalIndex'])->name('edit-goal');
    Route::post('/edit-goal',[ProfileController::class, 'editGoal']);

    Route::get('/change-language/{language_id}',[ProfileController::class, 'changeLanguage'])->name('change-language');


});

Route::get('/recap',[RecapController::class, 'index'])->name('recap');
Route::get('/recap/search-words',[RecapController::class, 'search']);


Route::prefix('admin')->group(function () {
    Route::middleware('isntLoggedIn')->group(function (){
        Route::get('/login', [AdminController::class,'getlogin'])->name('admin-login');
        Route::post('/login', [AdminController::class,'login']);
    });

    Route::middleware('isAdmin')->group(function (){
        Route::get('/home', [AdminController::class,'home'])->name('admin-home');
        Route::resource('words', WordController::class);
        Route::resource('sentences', SentenceController::class);
        Route::resource('task-info', TaskInfoController::class);
    });
});


