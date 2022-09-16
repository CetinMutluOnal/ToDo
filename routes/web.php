<?php

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome')
    ->with('todos', Todo::all());
});

Auth::routes();



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('index', [ToDoController::class, 'index'])->name('index');

Route::resource('todos', ToDoController::class);
Route::post('todos/create', [App\Http\Controllers\ToDoController::class, 'store'])->name('store');
