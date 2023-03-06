<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

//Welcome Route
Route::get('/', [WelcomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('admin.admin');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

//Installation 
Route::get('/recoversuperadmin', [InstallController::class, 'recoverSuperAdmin']);
Route::get('/installstepone', [InstallController::class, 'installStepOne']);
Route::get('/installsteptwo', [InstallController::class, 'installStepTwo']);
Route::post('/install', [InstallController::class, 'installTheApp']);

//User management
Route::get('/users', [UserController::class, 'users'])->middleware('auth');
Route::get('/user/edit/{id}', [UserController::class, 'userEdit'])->middleware('auth');
Route::post('/user/update/{id}', [UserController::class, 'userUpdate'])->middleware('auth');
Route::get('/user/delete/{id}', [UserController::class, 'userDelete'])->middleware('auth');
Route::get('/usercreate', [UserController::class, 'userCreate'])->middleware('auth');
Route::post('/userstore', [UserController::class, 'userStore'])->middleware('auth');

//User profile 
Route::get('/user/profile', [UserController::class, 'userProfile'])->middleware('auth'); //after login user can see only his/her profile
Route::get('/user/profile/{id}', [UserController::class, 'userProfileAll'])->middleware('auth'); //admin can view all user's profile

//Employee 
Route::get('/user/employee/create', [EmployeeController::class, 'createEmployees'])->middleware('auth');
Route::post('/user/employee/store', [EmployeeController::class, 'storeEmployees'])->middleware('auth');
Route::get('/user/allemployees', [EmployeeController::class, 'allEmployees'])->middleware('auth');
Route::get('/user/employee/edit/{id}', [EmployeeController::class, 'employeeEdit'])->middleware('auth');
Route::post('/user/employee/update/{id}', [EmployeeController::class, 'employeeUpdate'])->middleware('auth');
Route::get('/user/employee/delete/{id}', [EmployeeController::class, 'employeeDelete'])->middleware('auth');

//Customer 
Route::get('/user/customer', [CustomerController::class, 'allCustomer'])->middleware('auth');
Route::get('/user/customer/edit/{id}', [CustomerController::class, 'customerEdit'])->middleware('auth');
Route::post('/user/customer/update/{id}', [CustomerController::class, 'customerUpdate'])->middleware('auth');
Route::get('/user/customer/delete/{id}', [CustomerController::class, 'customerDelete'])->middleware('auth');

//Search User
Route::post('/user/search', [UserController::class, 'searchUser'])->middleware('auth');

//Contact
Route::get('/contactus', [ContactusController::class, 'contactUs']);

//Salary 
Route::get('/employee/salary', [SalaryController::class, 'index']); //show form to pay salary 
Route::post('/employee/salaryprovide', [SalaryController::class, 'salaryProvide']); //call salary paid method 
Route::get('/employee/salarydetails', [SalaryController::class, 'salaryDetails']); //show all employees with their salary 
Route::get('/employee/salaryedit/{id}', [SalaryController::class, 'salaryEdit']); //show form to edit salary information 
Route::post('/employee/salaryupdate/{id}', [SalaryController::class, 'salaryUpdate']); //call update salary method 
Route::get('/employee/salarydelete/{id}', [SalaryController::class, 'salaryDelete']); //call delete salary method 
Route::get('/employee/salaryadvance', [SalaryController::class, 'salaryAdvance']);
Route::post('/employee/salaryadvance', [SalaryController::class, 'salaryAdvanceDone']); //call the method 
Route::get('/employee/salaryadvancedetails', [SalaryController::class, 'salaryAdvanceDetails']);
Route::get('/employee/salaryloanpay/{id}', [SalaryController::class, 'salaryLoanPay']); //load paid by the employee 
Route::post('/employee/salaryloanpay/{id}', [SalaryController::class, 'salaryLoanPayDone']); //call the method of load paid by the employee 

//Product
Route::get('/product', [ProductController::class, 'index']); //show form to create product 
Route::post('/product/store', [ProductController::class, 'storeProduct']); //store data to the product table 
Route::get('/product/show', [ProductController::class, 'allProducts']); //show all products
Route::get('/product/productedit/{id}', [ProductController::class, 'productEdit']); //show form to create product  
Route::post('/product/productupdate/{id}', [ProductController::class, 'productUpdate']); //call update for product 
Route::get('/product/productdelete/{id}', [ProductController::class, 'productDelete']); //call update for product 

//Sales and ePOS 
Route::get('/sales/epos', [SaleController::class, 'index']); //sale home page 
Route::post('/sales/addsale', [SaleController::class, 'addSale']); //sale home page 
Route::get('/sales/showsale', [SaleController::class, 'showSale']); //show sale for a single customer by sale id
Route::get('/sales/newsale', [SaleController::class, 'newSale']); //show sale for a single customer by sale id
Route::get('/sales/deletesale/{id}', [SaleController::class, 'deleteSale']); //delete item from sales for a single customer
