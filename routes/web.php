<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerChartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;


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

        // Update

            // Route for displaying the product update form
            Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');

            // Route for updating a product
            Route::put('/product/update/{id}', [ProductController::class, 'updateProduct'])->name('product.update');

        // Delete

            Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.delete');

        // CHART

            Route::get('/barchart', [CustomerChartController:: class, 'BarChart'])->name('bar.chart');
            Route::get('/piechart', [CustomerChartController:: class, 'pieChart'])->name('pie.chart');

    // SERVISE RELATED ADMIN

        Route::get('/service-management', [ServiceController::class, 'showService'])->name('service.show');

        // Create
        
            Route::post('/service/create', [ServiceController::class, 'createService'])->name('service.store');

        // Edit

            Route::get('/service/edit/{id}', [ServiceController::class, 'editService'])->name('service.edit');
            Route::put('/service/update/{id}', [ServiceController::class, 'updateService'])->name('service.update');

        // Delete

            Route::delete('/services/{id}', [ServiceController::class, 'deleteService'])->name('service.destroy');

        // Search

            Route::get('/service/search', [ServiceController::class, 'search'])->name('service.search');




// CUSTOMERS ////////////////////////////////////////////////////////////////

        Auth::routes([
            'verify' => true
        ]);

        // Register
            
            Route::get('/register', [CustomerController::class, 'showRegistrationForm'])->name('register');
            Route::post('/register', [CustomerController::class, 'register'])->name('customer.register');

        // Login 

            Route::get('/customer/login', [CustomerController::class, 'showLoginForm'])->name('customer.login');
            Route::post('/customer/login', [CustomerController::class, 'login'])->name('customer.login.submit');

        // Logout
        
            Route::post('/customer/logout', [CustomerController::class, 'logoutCustomer'])->name('customer.logout.submit');

        // Search

            Route::get('/search', [ProductController::class, 'searchProducts'])->name('searchProducts');




// SERVICES //////////////////////////////////////////////////////////////////////////////////

        // View

            Route::get('/customer-service', [ServiceController::class, 'showCustomerServices'])->name('customer.service');



// SHOP & TRANSACTION FOR CUSTOMER ///////////////////////////////////////////////////////////


        // Shop

            Route::get('/shop', [CustomerController::class, 'shop'])->name('shop');

        // View 

            Route::get('/shopInfo/{id}', [ShopController::class, 'show'])->name('shopInfo');

        // Cart
            Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');

            Route::get('/cart', [CartController::class, 'index'])->name('cartInfo');

        // Buy Now

            Route::post('/buy-now', [ShopController::class, 'buyNow'])->name('buyNow');

        // Add to Cart

            Route::post('/add-to-cart', [ShopController::class, 'addToCart'])->name('addToCart');








// EMPLOYEES /////////////////////////////////////////////////////////////////////////////////

    Route::get('/employee-management', [EmployeeController::class, 'employeeManagement'])->name('employee.management');

    // Create

        Route::post('/employee/create', [EmployeeController::class, 'createEmployee'])->name('employee.create');

    // Read

        Route::get('/fetch-employee-documents/{id}', [EmployeeController::class, 'fetchEmployeeDocuments']);

        Route::get('/fetch-employee/{id}', [EmployeeController::class, 'fetchEmployee']);

    // Update

        Route::get('/edit-employee/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('/update-employee/{id}', [EmployeeController::class, 'updateEmployee'])->name('employee.update');

    // Delete Documents

        Route::delete('/delete-document/{employee_id}/{document_id}', [EmployeeController::class, 'destroyDocument'])->name('delete-document');
    

// EMAIL VERIFICATION

        // Verify

            Route::get('/verify/{token}', [CustomerController::class, 'verify']);