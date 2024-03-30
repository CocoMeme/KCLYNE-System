<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
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

        // Update

            // Route for displaying the product update form
            Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');

            // Route for updating a product
            Route::put('/product/update/{id}', [ProductController::class, 'updateProduct'])->name('product.update');

        // Delete

            Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.delete');

        // SERVISE RELATED ADMIN

            // Route for showing a service
            Route::get('/service-management', [ServiceController::class, 'showService'])->name('service.show');

            // Route for creating a service (POST request)
            Route::post('/service/create', [ServiceController::class, 'createService'])->name('service.store');

            //EDit
            Route::get('/service/edit/{id}', [ServiceController::class, 'editService'])->name('service.edit');

            // Route for updating a service (PUT request)
            Route::put('/service/update/{id}', [ServiceController::class, 'updateService'])->name('service.update');

            // Route for deleting a service (DELETE request)
            Route::delete('/services/{id}', [ServiceController::class, 'deleteService'])->name('service.destroy');





// CUSTOMERS ////////////////////////////////////////////////////////////////

        // Register
            
            Route::get('/register', [CustomerController::class, 'showRegistrationForm'])->name('register');
            Route::post('/register', [CustomerController::class, 'register'])->name('customer.register');

        // Login 

            Route::get('/customer/login', [CustomerController::class, 'showLoginForm'])->name('customer.login');
            Route::post('/customer/login', [CustomerController::class, 'login'])->name('customer.login.submit');


// EMPLOYEES