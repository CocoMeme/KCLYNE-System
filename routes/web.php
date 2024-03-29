<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

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
    
    // Login

        Route::get('/admin/login', function () {
            return view('admins.login');
        })->name('admin.login');

        Route::post('/admin/login', [AdminController::class, 'loginAdmin'])->name('admin.login.submit');

    // Logout

        Route::post('/admin/logout', [AdminController::class, 'logoutAdmin'])->name('admin.logout.submit');

    
    //  PRODUCTS RELATED ADMIN

        Route::get('/product-management', [ProductController::class, 'productManagement'])->name('product.management');

        // Create
            Route::post('/product/create', [ProductController::class, 'createProduct'])->name('product.create');


// CUSTOMERS ////////////////////////////////////////////////////////////////

        // Register
        Route::get('/register', [CustomerController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [CustomerController::class, 'register'])->name('customer.register');


// EMPLOYEES