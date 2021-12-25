<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Models\User;

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

Route::group(['middleware' => ['auth', 'blocked']], function () {
    Route::get('/', function () {
        $users = User::orderBy('id', 'asc')->get();
        return view('homepage.homepage', compact('users'));
    })->name('homepage');

    Route::group(['middleware' => ['admin']], function () {
        Route::post('/block', [UserController::class, 'block'])->name('block');
        Route::post('/unblock', [UserController::class, 'unblock'])->name('unblock');
        Route::post('/delete', [UserController::class, 'delete'])->name('delete');
    });

    Route::get('/profile', function () {
        $user = \Illuminate\Support\Facades\Auth::user();
        $messages = $user->messages;
        return view('profile.profile', compact('messages'));
    })->name('profile');

    Route::get('/send_message', [MessageController::class, 'message'])->name('message');
    Route::post('/send_message', [MessageController::class, 'send_message'])->name('send_message');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');

    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

Route::fallback(function () {
    abort(404);
});
