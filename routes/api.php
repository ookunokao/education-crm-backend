<?php

use App\Http\Controllers\AppraisalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\PersonalDataController;
use App\Http\Controllers\SchoolController;
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

Route::post('/signup', [AuthController::class, 'signUp']);
Route::post('/auth', [AuthController::class, 'signIn']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user/personal', [PersonalDataController::class, 'getPersonalData']);
    Route::post('/user/personal', [PersonalDataController::class, 'postPersonalData']);
    Route::patch('/user/personal', [PersonalDataController::class, 'patchPersonalData']);
    Route::get('user/passport', [PassportController::class, 'getPassportData']);
    Route::post('/user/passport', [PassportController::class, 'createPassportData']);
    Route::patch('/user/passport', [PassportController::class, 'updatePassportData']);
    Route::get('user/school', [SchoolController::class, 'getSchool']);
    Route::post('/user/school', [SchoolController::class, 'createSchoolData']);
    Route::patch('/user/school', [SchoolController::class, 'updateSchoolData']);
    Route::get('/user/stuff', [AppraisalController::class, 'getUserApproisal']);
    Route::post('user/stuff', [AppraisalController::class, 'createUserAppraisal']);
});


