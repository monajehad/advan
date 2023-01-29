<?php

use App\Http\Controllers\Admin\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/clear', function () {

    $exitCode = \Illuminate\Support\Facades\Artisan::call('view:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('optimize');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('route:clear');

});

Auth::routes(['register' => false]);
Auth::routes(['login' => false]);
        

    Route::get('elogin/{token}',[LoginController::class,'elogin'] )->name('admin.elogin');
    Route::get('/home', [\App\Http\Controllers\Admin\HomeController::class,'index'] )->name('admin.home');
// Route::redirect('/', '/login');
// Route::get('/home', function () {
    // if (session('status')) {
        // return redirect()->route('admin.home')->with('status', session('status'));
    // }

    // return redirect()->route('admin.home');
// });
Route::group(['namespace' => 'Admin','middleware' => ['web', 'guest']], function ()
{
    // LOGIN ROUTE
    Route::get('login', [LoginController::class,'getIndex'])->name('admin.login');
    Route::post('adminlogin', [LoginController::class,'postIndex'])->name('adminlogin');
});