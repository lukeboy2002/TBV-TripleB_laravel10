<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin|member'])->group(function () {
    Route::get('settings', function () {
        return view('admin.dashboard');
    })->name('settings');
    //Slides
    Route::resource('slides', \App\Http\Controllers\admin\SlideController::class);
    //ImageUpload
    Route::post('upload', [\App\Http\Controllers\admin\ImageController::class, 'upload'])->name('upload');
    Route::delete('revert', [\App\Http\Controllers\admin\ImageController::class, 'revert'])->name('revert');
    //Sponsors
    Route::resource('sponsors', \App\Http\Controllers\admin\SponsorController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin'])->group(function () {
    //Slides
});
