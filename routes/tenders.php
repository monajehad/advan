<?php

use App\Http\Controllers\Admin\ClientsSpecialtiesController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Tenders\CompetitorController;
use App\Http\Controllers\Tenders\ItemController;
use App\Http\Controllers\Tenders\SupplierController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::prefix('item')->name('item.')->group(function(){
    Route::get('/', [ItemController::class,'index'])->name('index');
    Route::get('/download/excel', [ItemController::class,'download_excel'])->name('download.excel');
    Route::get('/data/{id}', [ItemController::class,'get_item'])->name('data');
    Route::post('/store', [ItemController::class,'store'])->name('store');
    Route::post('/import/excel', [ItemController::class,'import_excel'])->name('import.excel');
    Route::post('/update', [ItemController::class,'edit'])->name('update');
    Route::post('/delete', [ItemController::class,'delete'])->name('delete');
    Route::post('change/status/{id}', [ItemController::class,'change_status'])->name('change.status');

    Route::get('/export/excel', [ItemController::class,'export_excel'])->name('export.excel');

});

Route::prefix('supplier')->name('supplier.')->group(function(){
    Route::get('/',[SupplierController::class,'index'] )->name('index');
    Route::post('/store', [SupplierController::class,'add'])->name('store');
    Route::get('/data/{id}', [SupplierController::class,'get_supplier'])->name('data');
    Route::post('/update', [SupplierController::class,'edit'])->name('update');
    Route::post('/delete', [SupplierController::class,'delete'])->name('delete');
    Route::post('change/status/{id}', [SupplierController::class,'change_status'])->name('change.status');

    Route::get('/export/excel', [SupplierController::class,'export_excel'])->name('export.excel');

});

Route::prefix('competitor')->name('competitor.')->group(function(){
    Route::get('/',[CompetitorController::class,'index'] )->name('index');
    Route::post('/store', [CompetitorController::class,'add'])->name('store');
    Route::get('/data/{id}', [CompetitorController::class,'get_competitor']);
    Route::post('/update', [CompetitorController::class,'edit'])->name('update');
    Route::post('/delete', [CompetitorController::class,'delete'])->name('delete');
    Route::post('change/status/{id}', [CompetitorController::class,'change_status'])->name('change.status');

    Route::get('/export/excel', [CompetitorController::class,'export_excel'])->name('export.excel');

});
