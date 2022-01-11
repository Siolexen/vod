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
    return redirect()->route('login');
});

Auth::routes();
Route::post('custom-login', [App\Http\Controllers\Auth\LoginController::class, 'customLogin'])->name('login.custom');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')
    ->middleware(['auth', 'web'])
    ->name('user.')->group(function () {

        Route::resource('/course', App\Http\Controllers\Users\CourseController::class);
});

Route::get('/admin/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'getLogin'])->name('adminLogin');
Route::post('/admin/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
Route::get('/admin/logout', [App\Http\Controllers\Auth\AdminAuthController::class, 'logout'])->name('adminLogout');

Route::prefix('admin')
    ->middleware(['adminauth'])
    ->name('admin.')->group( function () {
    // Admin Dashboard
    Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('course', App\Http\Controllers\Admin\CourseController::class);
});

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
