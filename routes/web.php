<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientsSpecialtiesController;
use App\Http\Controllers\Admin\ClinicsController;
use App\Http\Controllers\Admin\ClinicsSpecialtiesController;
use App\Http\Controllers\Admin\HitsController;
use App\Http\Controllers\Admin\HitsTypeController;
use App\Http\Controllers\Admin\KindsOfOccasionsController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReportTypeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VacationRequestController;
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

       // Clients Specialties
      Route::delete('clients-specialties/destroy', [ClientsSpecialtiesController::class,'massDestroy'])->name('clients-specialties.massDestroy');
      Route::post('clients-specialties/parse-csv-import', [ClientsSpecialtiesController::class,'parseCsvImport'])->name('clients-specialties.parseCsvImport');
      Route::post('clients-specialties/process-csv-import', [ClientsSpecialtiesController::class,'processCsvImport'])->name('clients-specialties.processCsvImport');
      Route::resource('clients-specialties', ClientsSpecialtiesController::class);

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


         // Vacation Request
      Route::delete('vacation-requests/destroy', [VacationRequestController::class,'massDestroy'])->name('vacation-requests.massDestroy');
      Route::resource('vacation-requests', VacationRequestController::class);


      // Attendance
       Route::delete('attendances/destroy', [AttendanceController::class,'massDestroy'])->name('attendances.massDestroy');
       Route::post('attendances/parse-csv-import', [AttendanceController::class,'parseCsvImport'])->name('attendances.parseCsvImport');
       Route::post('attendances/process-csv-import', [AttendanceController::class,'processCsvImport'])->name('attendances.processCsvImport');
       Route::resource('attendances', AttendanceController::class);
       Route::get('attendances/{id}/track', [AttendanceController::class,'track'])->name('attendances.track');

         // Hits Type
       Route::delete('hits-types/destroy', [HitsTypeController::class,'massDestroy'])->name('hits-types.massDestroy');
       Route::post('hits-types/parse-csv-import', [HitsTypeController::class,'parseCsvImport'])->name('hits-types.parseCsvImport');
       Route::post('hits-types/process-csv-import', [HitsTypeController::class,'processCsvImport'])->name('hits-types.processCsvImport');
       Route::resource('hits-types', HitsTypeController::class);

       // Hits
      Route::delete('hits/destroy', [HitsController::class,'massDestroy'])->name('hits.massDestroy');
      Route::resource('hits', HitsController::class);
      Route::get('hits-map', [HitsController::class,'map'])->name('hits.hitsMap');
      Route::get('note', [HitsController::class,'note'])->name('hits.note');

       // Category
    Route::delete('categories/destroy', [CategoryController::class,'massDestroy'])->name('categories.massDestroy');
    Route::post('categories/parse-csv-import', [CategoryController::class,'parseCsvImport'])->name('categories.parseCsvImport');
    Route::post('categories/process-csv-import', [CategoryController::class,'processCsvImport'])->name('categories.processCsvImport');
    Route::resource('categories', CategoryController::class);

     // Kinds Of Occasions
     Route::delete('kinds-of-occasions/destroy', [KindsOfOccasionsController::class,'massDestroy'])->name('kinds-of-occasions.massDestroy');
     Route::post('kinds-of-occasions/parse-csv-import', [KindsOfOccasionsController::class,'parseCsvImport'])->name('kinds-of-occasions.parseCsvImport');
     Route::post('kinds-of-occasions/process-csv-import', [KindsOfOccasionsController::class,'processCsvImport'])->name('kinds-of-occasions.processCsvImport');
     Route::resource('kinds-of-occasions', KindsOfOccasionsController::class);

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
