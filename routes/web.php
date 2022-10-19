<?php

use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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

// Route::get('/', function () {
//     return view('auth.login');
// })->middleware('guest');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// // Route::get('/main', [TaskController::class, 'index'])->middleware('auth')->name('mainpage');

// Route::get('/add', [TaskController::class, 'add'])->middleware('auth')->name('add');
// Route::post('/task', [TaskController::class, 'create'])->middleware('auth')->name('create');

// Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->middleware('auth')->name('edit');
// Route::post('/update/{id}', [TaskController::class, 'update'])->middleware('auth')->name('update');

// Route::get('/delete', [TaskController::class, 'delete_id'])->middleware('auth')->name('delete_id');
// Route::get('/delete2', [TaskController::class, 'delete2'])->middleware('auth')->name('delete2');
// Route::get('/delete/{id}', [TaskController::class, 'delete'])->middleware('auth')->name('delete');

// Route::get('/view/{id}', [TaskController::class, 'view'])->middleware('auth')->name('view');


// for wad2

// home
Route::get('/main', [HomeController::class, 'index'])->name('home'); 

// user
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->middleware('auth')->name('edit_particulars');
Route::post('/user/{id}/update', [UserController::class, 'update'])->middleware('auth')->name('update_particulars');

// gallery
Route::get('/gallery/new', [GalleryController::class, 'add'])->middleware('auth')->name('add_new_gallery');
Route::post('/gallery/updateNewGallery/{user_id}', [GalleryController::class, 'updateAdd'])->middleware('auth')->name('update_add_new_gallery');

// about (website)
Route::get('/about-us', function(){
    return view('wad2.about.about-us');
})->name('about_us'); 

// about (user)
Route::get('/user/{user_id}/account', [UserController::class, 'show'])->name('user.account'); 

// artworks (user)
Route::get('/user/artworks', function(){
    return view('wad2.user.artworks');
})->name('user.artworks'); 

// events (user)
Route::get('/user/events', function(){
    return view('wad2.user.events');
})->name('user.events'); 
