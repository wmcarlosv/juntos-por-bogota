<?php

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

Route::get('/', function () {
	if(!Auth::check()){
		return view('welcome');
	}else{
		return redirect()->route('home');
	}
    
});

Auth::routes();

Route::get('/home/{tag?}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add', [App\Http\Controllers\HomeController::class, 'add'])->name('add');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::get('/edit-friend/{id}', [App\Http\Controllers\HomeController::class, 'edit_friend'])->name('edit_friend');
Route::put('/update-profile', [App\Http\Controllers\HomeController::class, 'update_profile'])->name('update_profile');
Route::put('/update-friend/{id}', [App\Http\Controllers\HomeController::class, 'update_friend'])->name('update_friend');
Route::post('/add-friend', [App\Http\Controllers\HomeController::class, 'add_friend'])->name('add_friend');
Route::delete('/delete-friend/{id}',[App\Http\Controllers\HomeController::class, 'delete_friend'])->name('delete_friend');
Route::get('/friend-list/{tag?}',[App\Http\Controllers\HomeController::class, 'friend_list'])->name('friend_list');

Route::get('/change_password',[App\Http\Controllers\HomeController::class, 'view_password'])->name('view_password');
Route::put('/change-password',[App\Http\Controllers\HomeController::class, 'change_password'])->name('change_password');
