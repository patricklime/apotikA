<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::resource('medicines','MedicineController');
Route::get('coba1','MedicineController@coba1');

Route::resource('categories','CategoryController');
Route::get('report/listmedicine/{id}','CategoryController@showlist');

Route::get('report/listExpensiveMedicine','MedicineController@showMaxMedicine');

Route::get('/ceklayout', function () {
    return view('layout.conquer');
});

Route::post('/medicines/showInfo','MedicineController@showInfo')->name('medicines.showInfo');

Route::post('/category/showProducts','CategoryController@showProducts')->name('category.showProducts');

Route::resource('transaction','TransactionController');

Route::post('transaction/showDetail','TransactionController@showAjax')->name('transaction.showAjax');

Route::resource('supplier','SupplierController');

Route::post('supplier/getEditForm','SupplierController@getEditForm')->name('supplier.getEditForm');

Route::post('supplier/getEditForm2','SupplierController@getEditForm2')->name('supplier.getEditForm2');

Route::post('supplier/saveData','SupplierController@saveData')->name('supplier.saveData');

Route::post('supplier/deleteData','SupplierController@deleteData')->name('supplier.deleteData');

Route::post('medicines/getEditForm','MedicineController@getEditForm')->name('medicines.getEditForm');

Route::post('medicines/getEditForm2','MedicineController@getEditForm2')->name('medicines.getEditForm2');

Route::post('medicines/saveData','MedicineController@saveData')->name('medicines.saveData');

Route::post('medicines/deleteData','MedicineController@deleteData')->name('medicines.deleteData');