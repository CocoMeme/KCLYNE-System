<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;

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

    // EMPLOYEE RELATED ADMIN

        Route::get('/employee-management', [EmployeeController::class, 'employeeManagement'])->name('employee.management');

        // Create
            Route::post('/employee/create', [EmployeeController::class, 'createEmployee'])->name('employee.create');

        // Read

        Route::get('/fetch-employee-documents/{id}', [EmployeeController::class, 'fetchEmployeeDocuments']);

        Route::get('/fetch-employee/{id}', [EmployeeController::class, 'fetchEmployee']);

        // Update

        Route::put('/update-employee/{id}', [EmployeeController::class, 'update']);
        //Documents
        Route::get('/edit-document/{employee_id}/{document_id}', [EmployeeController::class, 'editDocument']);


        // Delete

        Route::delete('/delete-document/{employee_id}/{document_id}', [EmployeeController::class, 'destroyDocument']);

// CUSTOMERS ////////////////////////////////////////////////////////////////

        // Register
            
            Route::get('/register', [CustomerController::class, 'showRegistrationForm'])->name('register');
            Route::post('/register', [CustomerController::class, 'register'])->name('customer.register');

        // Login 

            Route::get('/customer/login', [CustomerController::class, 'showLoginForm'])->name('customer.login');
            Route::post('/customer/login', [CustomerController::class, 'login'])->name('customer.login.submit');

        // Logout

            Route::post('/customer/logout', [CustomerController::class, 'logoutCustomer'])->name('customer.logout.submit');


// EMPLOYEES
