<?php

use App\Http\Controllers\ProfileController;
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

//CREATE USER AFTER INVITATION
Route::get('users', [ProfileController::class, 'create'])->name('users.create')->middleware('hasInvitation');
Route::Post('users', [ProfileController::class, 'store'])->name('users.store');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin|member'])->group(function () {
    Route::get('settings', function () {
        return view('admin.dashboard');
    })->name('settings');
    //ImageUpload
    Route::post('upload', [\App\Http\Controllers\admin\ImageController::class, 'upload'])->name('upload');
    Route::delete('revert', [\App\Http\Controllers\admin\ImageController::class, 'revert'])->name('revert');
    //Slides
    Route::resource('slides', \App\Http\Controllers\admin\SlideController::class);
    //Sponsors
    Route::resource('sponsors', \App\Http\Controllers\admin\SponsorController::class);
    //Invite User
    Route::get('invitations', [\App\Http\Controllers\admin\InviteUserController::class, 'index'])->name('invitations.index');
    Route::get('invitations/create', [\App\Http\Controllers\admin\InviteUserController::class, 'create'])->name('invitations.create');
    Route::post('invitations', [\App\Http\Controllers\admin\InviteUserController::class, 'store'])->name('invitations.store');
    Route::delete('invitations/{id}', [\App\Http\Controllers\admin\InviteUserController::class, 'destroy'])->name('invitations.delete');
    //Users
    Route::get('users/trashed', [\App\Http\Controllers\admin\UserController::class, 'trashed'])->name('user.trashed');
    Route::get('users/trashed/{id}/restore', [\App\Http\Controllers\admin\UserController::class, 'trashedRestore'])->name('users.trashed.restore');
    Route::get('users/trashed/{id}/forse_delete', [\App\Http\Controllers\admin\UserController::class, 'trashedDelete'])->name('users.trashed.destroy');
    Route::resource('users', \App\Http\Controllers\admin\UserController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin'])->group(function () {
    Route::get('members/create', [\App\Http\Controllers\admin\MembersController::class, 'create'])->name('members.create');
    Route::post('members', [\App\Http\Controllers\admin\MembersController::class, 'store'])->name('members.store');
});
