<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;

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
    return view('home');
});

/* Default routes */
Route::get('/home', [HomeController::class, 'index'])->name('home');

/* Authentication routes */
Auth::routes();

/* Category routes */
Route::resource('categories', CategoryController::class);

/* ToDo routes */
Route::resource('todos', TodoController::class);
Route::controller(TodoController::class)->group(function () {
    Route::prefix('todos')->group(function () {
        Route::put('/finish/{todo}', 'finish')->name('todos.finish');
        Route::put('/activate/{todo}', 'activate')->name('todos.activate');
        Route::get('/restore/{todo}', 'restore')->name('todos.restore');
    });
});

