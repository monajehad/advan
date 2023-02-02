<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Tenders\ItemController;
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
    Route::post('/update', [ItemController::class,'update'])->name('update');
    Route::post('/delete', [ItemController::class,'delete'])->name('delete');
    Route::post('change/status/{id}', [ItemController::class,'change_status'])->name('change.status');

    Route::get('/export/excel', [ItemController::class,'export_excel'])->name('export.excel');

});
