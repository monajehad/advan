<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\ClientsSpecialtiesController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\Admin\FCMController;
use App\Http\Controllers\Admin\HitsController;
use App\Http\Controllers\Admin\HitsTypeController;
use App\Http\Controllers\Admin\KindsOfOccasionsController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReportTypeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SamplesController;
use App\Http\Controllers\Admin\SampleStockController;
use App\Http\Controllers\Admin\SmsMessageController;
use App\Http\Controllers\admin\SystemConstantController;
use App\Http\Controllers\admin\TenderController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VacationRequestController;
use App\Http\Controllers\HomeController;
use App\Models\User;
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

    Route::get('/massage',[FCMController::class,'get'] )->middleware('auth');
    Route::post('/massage',[FCMController::class,'createChat'])->name('createChat')->middleware('auth');
    Route::get('/notification',[NotificationController::class,'get'] );

    Route::post('/send_notification',[NotificationController::class,'sendNotification'] )->name('send.notification');
    // Route::post('/save_notification',[NotificationController::class,'createNotification'])->name('createNotificatio')->middleware('auth');

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
    Route::post('users/delete', [UsersController::class,'destroy'])->name('users.delete');

     // Employees
    Route::prefix('employee')->name('employee.')->group(function(){
    Route::get('/',[EmployeeController::class,'index'] )->name('index');
    Route::get('/profile',[EmployeeController::class,'show'] )->name('show');
    Route::post('/change/employee/password',[EmployeeController::class,'change_user_password'] )->name('password');
    Route::post('/store', [EmployeeController::class,'add'])->name('store');
    Route::get('/data/{id}', [EmployeeController::class,'get_user'])->name('data');
    Route::post('/update', [EmployeeController::class,'update'])->name('update');
    Route::post('/delete', [EmployeeController::class,'delete'])->name('delete');
    Route::post('change/status/{id}', [EmployeeController::class,'change_status'])->name('change.status');
    Route::post('change/password', [EmployeeController::class,'change_password'])->name('change.password');
    Route::get('/permissions/{id}', [EmployeeController::class,'get_permissions'])->name('get.permissions');
    Route::post('grant/permissions', [EmployeeController::class,'grant_employee_permissions'])->name('permissions');

    Route::get('/export/excel', [EmployeeController::class,'export_excel'])->name('export.excel');

  });
       // Clients Specialties
      Route::delete('clients-specialties/destroy', [ClientsSpecialtiesController::class,'massDestroy'])->name('clients-specialties.massDestroy');
      Route::post('clients-specialties/parse-csv-import', [ClientsSpecialtiesController::class,'parseCsvImport'])->name('clients-specialties.parseCsvImport');
      Route::post('clients-specialties/process-csv-import', [ClientsSpecialtiesController::class,'processCsvImport'])->name('clients-specialties.processCsvImport');
      Route::resource('clients-specialties', ClientsSpecialtiesController::class);

      // Clinics
      Route::delete('clients/destroy', [ClientsController::class,'classmassDestroy'])->name('clients.massDestroy');
      Route::post('clients/media', [ClientsController::class,'storeMedia'])->name('clients.storeMedia');
      Route::post('clients/ckmedia', [ClientsController::class,'storeCKEditorImages'])->name('clients.storeCKEditorImages');
      Route::post('clients/parse-csv-import', [ClientsController::class,'parseCsvImport'])->name('clients.parseCsvImport');
      Route::post('clients/process-csv-import', [ClientsController::class,'processCsvImport'])->name('clients.processCsvImport');
      Route::resource('clients', ClientsController::class);

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

      Route::get('/online_map', function () {
        $users = User::where('user_type' , 2)->where('status' , 1)->get();
        return view('advan.admin.onlineMap' , compact('users'));
    });

       // Category
    Route::delete('categories/destroy', [CategoryController::class,'massDestroy'])->name('categories.massDestroy');
    Route::post('categories/parse-csv-import', [CategoryController::class,'parseCsvImport'])->name('categories.parseCsvImport');
    Route::post('categories/process-csv-import', [CategoryController::class,'processCsvImport'])->name('categories.processCsvImport');
    Route::resource('categories', CategoryController::class);
    Route::post('/categories/status/update' , [CategoryController::class , 'updateStatus'])->name('categories.updateStatus');

     // Kinds Of Occasions
     Route::delete('kinds-of-occasions/destroy', [KindsOfOccasionsController::class,'massDestroy'])->name('kinds-of-occasions.massDestroy');
     Route::post('kinds-of-occasions/parse-csv-import', [KindsOfOccasionsController::class,'parseCsvImport'])->name('kinds-of-occasions.parseCsvImport');
     Route::post('kinds-of-occasions/process-csv-import', [KindsOfOccasionsController::class,'processCsvImport'])->name('kinds-of-occasions.processCsvImport');
     Route::resource('kinds-of-occasions', KindsOfOccasionsController::class);


     // Sample Stock
    Route::delete('sample-stocks/destroy', [SampleStockController::class,'massDestroy'])->name('sample-stocks.massDestroy');
    Route::resource('sample-stocks', SampleStockController::class);

     // Samples
    Route::delete('samples/destroy', [SamplesController::class,'massDestroy'])->name('samples.massDestroy');
    Route::resource('samples', SamplesController::class);

    //tenders
    Route::prefix('tenders')->name('tenders.')->group(function(){
        Route::get('/',[TenderController::class,'index'] )->name('index');
        // ->middleware('can:tenders-list')
        Route::get('/clients',[TenderController::class,'get_clients'] )->name('clients');
        // ->middleware(['can:tenders-add','can:tenders-update']);
        Route::post('/store', [TenderController::class,'add'])->name('store');
        // ->middleware('can:tenders-add');
        Route::get('/items/{id}', [TenderController::class,'get_item'])->name('item.data');
        // ->middleware(['can:tenders-add','can:tenders-competitor','can:tenders-update']);
        Route::get('/item/trade_names/{id}', [TenderController::class,'get_item_trade_names'])->name('item.trade.names');
        // ->middleware(['can:tenders-add','can:tenders-competitor','can:tenders-update']);
        Route::get('/tender/{id}', [TenderController::class,'get_tender'])->name('tender.data');
        // ->middleware('can:tenders-update');
        Route::post('/update', [TenderController::class,'update'])->name('update');
        // ->middleware('can:tenders-update');
        Route::get('/competitors/prices/{id}', [TenderController::class,'get_competitors_prices'])->name('competitors.prices');
        // ->middleware('can:tenders-competitor');
        Route::post('save/competitors/prices', [TenderController::class,'save_competitors_prices'])->name('competitors.prices.save');
        // ->middleware('can:tenders-competitor');
        Route::post('save/accepted/items', [TenderController::class,'save_accepted_items'])->name('accepted.items.save');
        // ->middleware('can:tenders-accept-items');
        Route::get('/accepting/items/{id}', [TenderController::class,'get_accepted_items'])->name('accepted.items');
        // ->middleware('can:tenders-accept-items');
        Route::post('/delete', [TenderController::class,'delete'])->name('delete');
        // ->middleware('can:tenders-delete');
        Route::get('/show/{id}', [TenderController::class,'show_tender'])->name('show');
        // ->middleware('can:tenders-list');
        Route::post('/delete_check', [TenderController::class,'delete_check'])->name('delete_check');
        // ->middleware('can:tenders-delete');

        Route::post('supply/items', [TenderController::class,'save_supplied_items'])->name('supplied.items.save');
        // ->middleware('can:tenders-supply');
        Route::get('/supplied/items/{id}', [TenderController::class,'get_supplied_items'])->name('supplied.items');
        // ->middleware('can:tenders-supply');
        Route::post('/remove/supplied/item', [TenderController::class,'delete_supplied_item'])->name('delete.supplied.item');
        // ->middleware('can:tenders-supply');;

        Route::get('/generate/pdf', [TenderController::class,'generate_tender_pdf'])->name('tender.generate.pdf');
        // ->middleware('can:tenders-print-pdf');
        Route::get('/for/calender', [TenderController::class,'tenders_for_calender'])->name('calender');

        Route::post('/duplicate/tender', [TenderController::class,'duplicate_tender_to_branch'])->name('duplicate.tender');

        Route::post('/add/trade-name', [TenderController::class,'add_new_trade_name'])->name('trade.name');


    });
    Route::get('/massage',[FCMController::class,'get'] );
    Route::post('/massage',[FCMController::class,'createChat'])->name('createChat');


    Route::prefix('system/constants')->name('system.constants.')->group(function(){
        Route::get('/',[SystemConstantController::class,'index'] )->name('index');
        // ->middleware('can:constants-list');
        Route::post('/store', [SystemConstantController::class,'add'])->name('store');
        // ->middleware('can:constants-add');
        Route::get('/data/{id}', [SystemConstantController::class,'get_constant']);
        // ->name('data')->middleware('can:constants-update');
        Route::post('/update', [SystemConstantController::class,'update'])->name('update');
        // ->middleware('can:constants-update');
        Route::post('/delete', [SystemConstantController::class,'delete'])->name('delete');
        // ->middleware('can:constants-delete');
        Route::post('change/status/{id}', [SystemConstantController::class,'change_status'])->name('change.status');
        // ->middleware('can:constants-status');

    });

    // Sms Message
    Route::delete('sms-messages/destroy', [SmsMessageController::class,'classmassDestroy'])->name('sms-messages.massDestroy');
    Route::resource('sms-messages', SmsMessageController::class);


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
