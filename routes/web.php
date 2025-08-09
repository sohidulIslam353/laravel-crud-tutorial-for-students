<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('frontend.index');
});

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/settings', [HomeController::class, 'settings'])->name('settings');
//Route::post('/password-update', [HomeController::class, 'passwordUpdate'])->name('password.update');


Route::post('/post/store', [PostController::class, 'storePost'])->name('post.store');
Route::get('/post/delete/{id}', [PostController::class, 'deletePost'])->name('post.delete');

// blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
Route::get('/blog/edit/{slug}', [BlogController::class, 'edit'])->name('blog.edit');
Route::put('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
Route::delete('/blog/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
