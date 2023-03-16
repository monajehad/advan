<?php

use App\Http\Controllers\Admin\FCMController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\AttendanceApiController;
use App\Http\Controllers\Api\V1\CategoryApiController;
use App\Http\Controllers\Api\V1\ClientsApiController;
use App\Http\Controllers\Api\V1\ClientsSpecialtiesApiController;
use App\Http\Controllers\Api\V1\HitsApiController;
use App\Http\Controllers\Api\V1\HitsTypeApiController;
use App\Http\Controllers\Api\V1\KindsOfOccasionsApiController;
use App\Http\Controllers\Api\V1\ReportApiController;
use App\Http\Controllers\Api\V1\ReportTypeApiController;
use App\Http\Controllers\Api\V1\SamplesApiController;
use App\Http\Controllers\Api\V1\VacationRequestApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
//     Route::post('/login', [AuthController::class,'logoin']);
//     Route::post('/register',[AuthController::class,'register'] );
// Route::group(['prefix' => 'api', 'as' => 'api.'], function () {

// });


// });
Route::post('/register',[AuthController::class,'register'] );
Route::post('/login', [AuthController::class,'logoin']);

    // Attendance
Route::apiResource('/attendances', AttendanceApiController::class);
Route::get('/user', [AuthController::class,'user']);

 // Vacation Request
 Route::apiResource('vacation-requests', VacationRequestApiController::class);

 // Category
 Route::apiResource('categories', CategoryApiController::class);
 Route::get('categories/{id}/sample-stocks', [CategoryApiController::class,'sample_stock']);

 // Samples
 Route::apiResource('samples', SamplesApiController::class)->only(['index', 'store']);
 Route::post('samples/{id}/confirm', [SamplesApiController::class,'confirm']);
 Route::get('/samples/have',[SamplesApiController::class,'have']);


    // Clinics Specialties
Route::apiResource('clients-specialties', ClientsSpecialtiesApiController::class);

    // Kinds Of Occasions
Route::apiResource('kinds-of-occasions', KindsOfOccasionsApiController::class);

// Report Type
Route::apiResource('report-types', ReportTypeApiController::class);

// Hits Type
Route::apiResource('hits-types', HitsTypeApiController::class);

 // Hits
 Route::apiResource('hits', HitsApiController::class);
 Route::post('hits/{id}/update',[HitsApiController::class,'update'] );

 // Clinics
 Route::post('clients/media', [ClientsApiController::class,'storeMedia'])->name('clients.storeMedia');
 Route::apiResource('clients', ClientsApiController::class);

  // Report
  Route::apiResource('reports', ReportApiController::class);
  Route::post('reports/{id}/update',[ReportApiController::class,'update'] );

 // Sms Message
 Route::apiResource('sms-messages', SmsMessageApiController::class);

Route::group(['prefix' => 'api', 'as' => 'api.'], function () {

    Route::get('/logout', [AuthController::class,'logout']);
    Route::post('/updateProfile', [AuthController::class,'update_profile']);
    Route::post('/updatePassword', [AuthController::class,'update_passwprd']);

});


// Route::post('/save-token', [FCMController::class,'index']);
Route::post('/notification/save-token', [NotificationController::class,'index'])->name('notification.save-token');
