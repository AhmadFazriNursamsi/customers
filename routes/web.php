<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ApisController;
use App\Http\Controllers\DivisionControllers;
use App\Http\Controllers\servieController;
use App\Http\Controllers\ListaccessController;
use App\Http\Controllers\R404Controller;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerControllers;
use App\Http\Controllers\QrcodeController;

Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware'=>'auth'], function(){
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::get('/users/create', [UsersController::class, 'create']);
Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
Route::post('/users/store', [UsersController::class, 'store']);
Route::post('/users/update/{id}', [UsersController::class, 'update']);
Route::post('/users/delete/{id}', [ApisController::class, 'apideleteuserbyid']);
Route::post('/api/usersaccess/{id}', [ApisController::class, 'apiGetDataUserAccessById']);
Route::get('/api/usersaccess2/{id}', [ApisController::class, 'apiGetDataUserAccessById2']);
Route::get('/api/users/getdata', [ApisController::class, 'apigetdatauser']);
Route::get('/api/users/getdatabyid/{id}', [ApisController::class, 'apigetdatauserbyid']);
Route::get('/api/getdivision', [ApisController::class, 'apigetdivisi']);
Route::get('/api/getrole', [ApisController::class, 'apigetrole']);
Route::get('/listaccess', [ListaccessController::class, 'index'])->name('listaccess');
Route::post('/listaccess/delete/{id}', [ApisController::class, 'apiDeleteListAccessById']);
Route::get('/api/listaccess/getdata', [ApisController::class, 'apiGetDataListAccess']);
Route::post('/api/listaccess/getdatabyid/{id}', [ApisController::class, 'apiGetDataListAccessById']);
Route::post('/api/listaccess/insertdata', [ListaccessController::class, 'apiInsertData']);
Route::post('/api/listaccess/updatedata', [ListaccessController::class, 'apiUpdateData']);
Route::get('/config', [ConfigController::class, 'index'])->name('config');
Route::post('/api/generate/qrcode', [QrcodeController::class, 'generateqrcode']);
    
    
///Division CRUD
Route::get('/api/divi/getdata', [DivisionControllers::class, 'apigetdatadivi']);
Route::get('/api/getdivision', [DivisionControllers::class, 'apigetdivisi']);
Route::get('/division/detail/{id}', [DivisionControllers::class, 'apiDetail']);
Route::get('/division/delete/{id}', [DivisionControllers::class, 'apiDestroy']);
Route::get('/divisions/create', [DivisionControllers::class, 'create']);
Route::post('/divisions/store', [DivisionControllers::class, 'store']);
Route::get('/divisions/edit/{id}', [DivisionControllers::class, 'edit']);
Route::post('/divisions/update/{id}', [DivisionControllers::class, 'update']);
Route::get('/divisions', [DivisionControllers::class, 'index']);
Route::get('/api/divisionaccess/{id}', [DivisionControllers::class, 'apiGetDataDivisionAccessById']);



//Alamat CRUD 
Route::get('/api/customers/getdata', [CustomerController::class, 'apigetdatacustomers']);
Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers/store', [CustomerController::class, 'store']);
Route::get('/customers/detail/{id}', [CustomerController::class, 'show']);
Route::get('/customers/delete/{id}', [CustomerController::class, 'destroy']);
Route::get('/customers/edit/{id}', [CustomerController::class, 'edit']);
Route::post('/customers/update/{id}', [CustomerController::class, 'update']);

   
});

Route::get('/api/generate/qrcode', [QrcodeController::class, 'generateqrcode']);

Route::get('/404', [R404Controller::class, 'r404']);
Route::get('/405', [R404Controller::class, 'r405']);
Route::get('/500', [R404Controller::class, 'r500']);

require __DIR__.'/auth.php';
