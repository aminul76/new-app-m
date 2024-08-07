<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::post('/ajax-login', [LoginController::class, 'ajaxLogin']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');




Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => ['auth', 'admin'],
], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});



// Ensure the namespace is correct and matches the controller file location
Route::group([
    'as' => 'author.',
    'prefix' => 'author',
    'namespace' => 'App\Http\Controllers\Author',
    'middleware' => ['auth', 'author'],
], function () {
    Route::get('dashboard', [AuthorDashboardController::class, 'index'])->name('dashboard');
});