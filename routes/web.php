<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardsController;
use App\Http\Controllers\CardsController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//Route::get('/user/{id}', [UserController::class, 'show']);

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
    return redirect('/board');
});


Route::group(['middleware' => 'auth'], function () {
    Route::resource('board', BoardsController::class);
    Route::resource('card', CardsController::class);

    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/boards', [AdminController::class, 'boards'])->name('boards');
    });
});
