<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create']);
Route::post('/users/create', [App\Http\Controllers\UserController::class, 'store']);
Route::get('/users/update/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('/users/update/{id}', [App\Http\Controllers\UserController::class, 'update']);
Route::get('/users/delete/{id}', [App\Http\Controllers\UserController::class, 'delete']);
Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);

//Tasks route
Route::resource('tasks', App\Http\Controllers\TaskController::class);

require __DIR__.'/auth.php';
