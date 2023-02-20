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
Route::put('/todos/finish/{todo}', [TodoController::class, 'finish'])->name('todos.finish');
Route::put('/todos/activate/{todo}', [TodoController::class, 'activate'])->name('todos.activate');
Route::get('/todos/restore/{todo}', [TodoController::class, 'restore'])->name('todos.restore');

