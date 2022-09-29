<?php

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToDoController;

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


 Route::group(['middleware' => 'auth:web'], function() {

    Route::get('/', function () {
        if(Auth::check() == null){

            return redirect()->route('login');
        }

        return redirect()->route('home');

    });

    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('index', [ToDoController::class, 'index'])->name('index');


    Route::post('todos/create', [App\Http\Controllers\ToDoController::class, 'store'])->name('store');
    Route::resource('todos', ToDoController::class);

 });

Auth::routes();


Route::post('auth/login',[AuthController::class, 'login'])->name('login');
ROute::get('auth/login', [AuthController::class, 'loginForm'])->name('loginForm');

Route::post('auth/logout',[AuthController::class, 'logout'])->name('logout');
