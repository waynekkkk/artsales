<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');


Route::get('/main', [TaskController::class, 'index'])->middleware('auth')->name('mainpage');

Route::get('/add', [TaskController::class, 'add'])->middleware('auth')->name('add');
Route::post('/task', [TaskController::class, 'create'])->middleware('auth')->name('create');

Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->middleware('auth')->name('edit');
Route::post('/update/{id}', [TaskController::class, 'update'])->middleware('auth')->name('update');

Route::get('/delete', [TaskController::class, 'delete_id'])->middleware('auth')->name('delete_id');
Route::get('/delete2', [TaskController::class, 'delete2'])->middleware('auth')->name('delete2');
Route::get('/delete/{id}', [TaskController::class, 'delete'])->middleware('auth')->name('delete');

Route::get('/view/{id}', [TaskController::class, 'view'])->middleware('auth')->name('view');

