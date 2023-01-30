<?php

use App\Http\Controllers\Admin\ClinicsController;
use App\Http\Controllers\Admin\ClinicsSpecialtiesController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReportTypeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
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

// Route::group(['middleware' => ['auth', 'user-access:admin'], 'prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin']
// ,function () {
//     Route::get('/home',[HomeController::class,'index'])->name('admin.home');




// });

Route::group([ 'prefix' => 'admin', 'as' => 'admin.']
,function () {

      // Roles
      Route::delete('roles/destroy',[RolesController::class,'massDestroy'] )->name('roles.massDestroy');
      Route::resource('roles', RolesController::class);

      // Permissions
      Route::delete('permissions/destroy',[PermissionsController::class,'massDestroy'] )->name('permissions.massDestroy');
      Route::resource('permissions', PermissionsController::class);

      // Users
      Route::delete('users/destroy',[UsersController::class,'massDestroy'] )->name('users.massDestroy');
      Route::post('users/media',[UsersController::class,'storeMedia']  )->name('users.storeMedia');
      Route::post('users/ckmedia', [UsersController::class,'storeCKEditorImages'] )->name('users.storeCKEditorImages');
      Route::resource('users', UsersController::class);

       // Clinics Specialties
      Route::delete('clinics-specialties/destroy', [ClinicsSpecialtiesController::class,'massDestroy'])->name('clinics-specialties.massDestroy');
      Route::post('clinics-specialties/parse-csv-import', [ClinicsSpecialtiesController::class,'parseCsvImport'])->name('clinics-specialties.parseCsvImport');
      Route::post('clinics-specialties/process-csv-import', [ClinicsSpecialtiesController::class,'processCsvImport'])->name('clinics-specialties.processCsvImport');
      Route::resource('clinics-specialties', ClinicsSpecialtiesController::class);

      // Clinics
      Route::delete('clinics/destroy', [ClinicsController::class,'classmassDestroy'])->name('clinics.massDestroy');
      Route::post('clinics/media', [ClinicsController::class,'storeMedia'])->name('clinics.storeMedia');
      Route::post('clinics/ckmedia', [ClinicsController::class,'storeCKEditorImages'])->name('clinics.storeCKEditorImages');
      Route::post('clinics/parse-csv-import', [ClinicsController::class,'parseCsvImport'])->name('clinics.parseCsvImport');
      Route::post('clinics/process-csv-import', [ClinicsController::class,'processCsvImport'])->name('clinics.processCsvImport');
      Route::resource('clinics', ClinicsController::class);

      // Report Type
      Route::delete('report-types/destroy', [ReportTypeController::class,'massDestroy'])->name('report-types.massDestroy');
      Route::post('report-types/parse-csv-import', [ReportTypeController::class,'parseCsvImport'])->name('report-types.parseCsvImport');
      Route::post('report-types/process-csv-import', [ReportTypeController::class,'processCsvImport'])->name('report-types.processCsvImport');
      Route::resource('report-types', ReportTypeController::class);

       // Report
      Route::delete('reports/destroy', [ReportController::class,'massDestroy'])->name('reports.massDestroy');
      Route::resource('reports', ReportController::class);


});

Route::get('/clear', function () {

    $exitCode = \Illuminate\Support\Facades\Artisan::call('view:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('optimize');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('route:clear');

});

Auth::routes(['register' => false]);
Auth::routes(['login' => false]);


    // Route::get('elogin/{token}',[LoginController::class,'elogin'] )->name('admin.elogin');

// Route::redirect('/', '/login');
// Route::get('/home', function () {
    // if (session('status')) {
        // return redirect()->route('admin.home')->with('status', session('status'));
    // }

    // return redirect()->route('admin.home');
// });
// Route::group(['namespace' => 'Admin','middleware' => ['web', 'guest']], function ()
// {
//     // LOGIN ROUTE
//     Route::get('login', [LoginController::class,'getIndex'])->name('admin.login');
//     Route::post('adminlogin', [LoginController::class,'postIndex'])->name('adminlogin');
// });
