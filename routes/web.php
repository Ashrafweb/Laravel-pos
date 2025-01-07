<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VariationController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout.app');
});

Route::get('/dashboard',[DashboardController::class,'index']);

/*Employee*/
Route::get('/employees',[EmployeeController::class,'show']);
Route::get('/employees/insert',[EmployeeController::class,'add']);
Route::post('/employees/insert',[EmployeeController::class,'create']);
Route::get('/employees/edit/{id}',[EmployeeController::class,'edit']);
Route::get('/employees/delete/{id}',[EmployeeController::class,'destroy']);

/*Category*/
Route::get('/categories',[CategoryController::class,'show']);
Route::get('/category/insert',[CategoryController::class,'add']);
Route::post('/category/insert',[CategoryController::class,'create']);
Route::get('/category/edit/{id}',[CategoryController::class,'edit']);
Route::get('/category/delete/{id}',[CategoryController::class,'destroy']);
Route::post('/category/status/{id}',[CategoryController::class,'status']);


/*Products*/
Route::get('/products',[ProductController::class,'show']);
Route::get('/products/insert',[ProductController::class,'add']);
Route::post('/products/create',[ProductController::class,'store']);
Route::get('/products/edit/{id}',[ProductController::class,'edit']);
Route::get('/products/delete/{id}',[ProductController::class,'destroy']);
Route::post('/product/status/{id}',[ProductController::class,'status']);

/*Variations*/

Route::get('/variation',[VariationController::class,'show']);
Route::get('/variation/insert',[VariationController::class,'add']);
Route::post('/variation/insert',[VariationController::class,'store']);
Route::get('/variation/edit/{id}',[VariationController::class,'edit']);
Route::get('/variation/delete/{id}',[VariationController::class,'destroy']);
Route::post('/variation/status/{id}',[VariationController::class,'status']);

/*Supplier*/

Route::get('/suppliers',[SupplierController::class,'show']);
Route::get('/supplier/insert',[SupplierController::class,'add']);
Route::post('/supplier/insert',[SupplierController::class,'create']);
Route::get('/supplier/edit/{id}',[SupplierController::class,'edit']);
Route::get('/supplier/delete/{id}',[SupplierController::class,'destroy']);
Route::post('/supplier/status/{id}',[SupplierController::class,'status']);


/*Customer*/

Route::get('/customers',[CustomerController::class,'show']);
Route::get('/customer/insert',[CustomerController::class,'add']);
Route::post('/customer/insert',[CustomerController::class,'create']);
Route::get('/customer/edit/{id}',[CustomerController::class,'edit']);
Route::get('/customer/delete/{id}',[CustomerController::class,'destroy']);
Route::post('/customer/status/{id}',[CustomerController::class,'status']);

/*Expense*/

Route::get('/expanse/insert',[EmployeeController::class,'add']);
Route::post('/expanse/insert',[EmployeeController::class,'create']);
Route::post('/expanse/edit/{id}',[EmployeeController::class,'edit']);
Route::get('/expanse/delete/{id}',[EmployeeController::class,'destroy']);

/*-------------Pos------------------*/

Route::get('/pos',[PosController::class,'index']);
Route::post('/posdata',[PosController::class,'add_to_cart']);
Route::post('/posdata/delete',[PosController::class,'remove_from_cart']);
Route::post('/posdata/update_qty',[PosController::class,'update_qty']);
Route::get('/pos/get_total_price',[PosController::class,'total']);
Route::post('/pos/sellcart',[PosController::class,'sellcart']);
Route::post('/pos/invoice',[PosController::class,'invoice']);
Route::post('/get_cart_id',[PosController::class,'get_cart_id']);


/*Orders*/

Route::get('/orders',[OrderController::class,'show']);
Route::get('/orders/pending',[OrderController::class,'pending']);
Route::get('/orders/success',[OrderController::class,'success_orders']);
Route::get('/orders/verify/{id}',[OrderController::class,'verify_order']);
Route::get('/orders/verify/download_pdf_invoice/{id}',[OrderController::class,'download_pdf']);
Route::post('/orders/verify/success',[OrderController::class,'success']);
Route::get('/data',function(){
    return view('data');
});



Route::get('file-import-export', [ProductController::class, 'fileImportExport']);
Route::post('file-import', [ProductController::class, 'fileImport'])->name('file-import');
Route::get('file-export', [ProductController::class, 'fileExport'])->name('file-export');






