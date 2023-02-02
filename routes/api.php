<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\AttendanceApiController;
use App\Http\Controllers\Api\V1\CategoryApiController;
use App\Http\Controllers\Api\V1\ClinicsApiController;
use App\Http\Controllers\Api\V1\ClinicsSpecialtiesApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
//     Route::post('/login', [AuthController::class,'logoin']);
//     Route::post('/register',[AuthController::class,'register'] );


// });
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
Route::apiResource('clinics-specialties', ClinicsSpecialtiesApiController::class);

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
 Route::post('clinics/media', [ClinicsApiController::class,'storeMedia'])->name('clinics.storeMedia');
 Route::apiResource('clinics', ClinicsApiController::class);

  // Report
  Route::apiResource('reports', ReportApiController::class);
  Route::post('reports/{id}/update',[ReportApiController::class,'update'] );



Route::group(['prefix' => 'api', 'as' => 'api.'], function () {

    Route::get('/logout', [AuthController::class,'logout']);
    Route::post('/updateProfile', [AuthController::class,'update_profile']);
    Route::post('/updatePassword', [AuthController::class,'update_passwprd']);

});
