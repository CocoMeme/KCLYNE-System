<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// LAYOUTS //////////////////////////////////////////////////////////////////

    Route::get('/', function () {
        return view('Layouts/home');
    })->name('home');

    Route::get('/home', function () {
        return view('Layouts/home')->name('home');;
    });





// ADMIN ////////////////////////////////////////////////////////////////////

    // Register

        Route::get('/admin/register', function () {
            return view('admins.register');
        })->name('admin.register');
        
        Route::post('/admin/register', [AdminController::class, 'registerAdmin']);


// CUSTOMERS ////////////////////////////////////////////////////////////////
