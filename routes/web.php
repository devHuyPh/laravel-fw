<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
});
Route::get('/generate-report', [FinancialReportController::class, 'generateReport']);

Route::resource('customers',CustomerController::class);

Route::delete('customers/{customer}/forceDestroy',[CustomerController::class, 'forceDestroy'])
    ->name('customers.forceDestroy');

Route::resource('employees', EmployeeController::class);


Route::delete('employees/{employee}/forceDestroy',[EmployeeController::class,'forceDestroy'])
    ->name('employees.forceDestroy');

Route::get('/employee/{id}/picture', [EmployeeController::class, 'showPicture'])->name('employee.picture');

Route::get('/session', function(){
    session()->get('ahiihi',111);
    return session('ahiihi',111);
});


Route::get('/set-age/under-18', function (Request $request) {
    session(['age' => 17]); 
    return redirect('/movies');
});

Route::get('/set-age/over-18', function (Request $request) {
    session(['age' => 20]); 
    return redirect('/');
});

Route::get('/movies', function () {
})->middleware('age.check');


Route::group(['middleware' => ['role']], function () {
    Route::get('/admin', [AdminController::class, 'index']);
    
    Route::get('/orders', [OrderController::class, 'index']);
    
    Route::get('/profile', [ProfileController::class, 'index']);
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/welcome', function () {
        return view('welcome'); 
    });
});
