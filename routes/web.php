<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController
};



Route::middleware('guest')->group(function () {
    Route::redirect('/', 'login');

    Route::get('login', Login::class)
        ->name('login');

    Route::get('register/new-user-account-mdrrmo', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {

    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');

    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');

    Route::middleware('user.type:1001')->prefix('user')->as('user.')->group(function () {
        Route::view('home', 'pages.dashboard')
        ->name('home');

        Route::view('equipment', 'pages.equipment')
        ->name('equipment');

        Route::view('log', 'pages.log')
        ->name('log');
    });

    Route::middleware('user.type:1010')->prefix('barangay')->as('barangay.')->group(function () {
        Route::view('home', 'pages.equipment')
        ->name('home');

        Route::view('equipment', 'pages.equipment')
        ->name('equipment');

        Route::view('log', 'pages.log')
        ->name('log');
    });
   
    Route::middleware('user.type:1111')->prefix('admin')->as('admin.')->group(function () {
        Route::view('home', 'pages.dashboard')
        ->name('home');

        Route::view('log', 'pages.log')
        ->name('log');

        // User Management Routes
        Route::controller(UserController::class)->prefix('usermanagement')->as('usermanagement.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/update', 'update')->name('update');
            Route::delete('/destroy', 'destroy')->name('delete');
        });


    });
});





