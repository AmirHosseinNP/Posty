<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserPostController;
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
    return view('home');
})->name('home');

Route::resource('login', LoginController::class)->only([
    'create', 'store'
]);
Route::delete('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::resource('register', RegisterController::class)->only([
    'create', 'store'
]);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('posts', PostController::class)->only([
    'index', 'store', 'destroy', 'show'
]);

Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])
    ->name('user.posts');

Route::post('/posts/{post}/like', [LikeController::class, 'store']);
Route::post('/posts/{post}/dislike', [DislikeController::class, 'store']);

