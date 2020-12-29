<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ContactusController;


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
Route::get('/user/profile', [UserController::class, 'userProfile'])->middleware('auth');

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
Route::get('/employee/salarydue', [SalaryController::class, 'salaryDue']); //show due salary of the current year 
Route::get('/employee/salaryadvance', [SalaryController::class, 'salaryAdvance']); //show due salary of the current year 
