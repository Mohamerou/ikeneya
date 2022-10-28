<?php

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


// Authentication routes
Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');

// Auth protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('users', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('user-profile', [App\Http\Controllers\UserController::class, 'profile']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('utilisateur/', [App\Http\Controllers\AuthController::class, 'user']);
});




// User related routes

Route::get('user-show/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::post('user-create', [App\Http\Controllers\AuthController::class, 'register']);
Route::put('user-update/{id}', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('user-delete/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
// User notify doctor
Route::post('check-for-notifications/', [App\Http\Controllers\NotificationController::class, 'CheckNotification'])->name('notification.check');
Route::post('rdv-request/', [App\Http\Controllers\NotificationController::class, 'RdvRequest'])->name('rdv.request');

// Doctor related routes
Route::get('doctors', [App\Http\Controllers\DoctorController::class, 'index']);
Route::get('doctor-show/{id}', [App\Http\Controllers\DoctorController::class, 'show']);
Route::post('doctor-create', [App\Http\Controllers\DoctorController::class, 'store']);
Route::put('doctor-update/{id}', [App\Http\Controllers\DoctorController::class, 'update']);
Route::delete('doctor-delete/{id}', [App\Http\Controllers\DoctorController::class, 'destroy']);

// Patient related routes
Route::get('patients', [App\Http\Controllers\PatientController::class, 'index']);
Route::get('patient-show/{id}', [App\Http\Controllers\PatientController::class, 'show']);
Route::post('patient-create', [App\Http\Controllers\PatientController::class, 'store']);
Route::put('patient-update/{id}', [App\Http\Controllers\PatientController::class, 'update']);
Route::delete('patient-delete/{id}', [App\Http\Controllers\PatientController::class, 'destroy']);

// Hospital related routes
Route::get('hospitals', [App\Http\Controllers\HospitalController::class, 'index']);
Route::get('hospital-show/{id}', [App\Http\Controllers\HospitalController::class, 'show']);
Route::post('hospital-create', [App\Http\Controllers\HospitalController::class, 'store']);
Route::put('hospital-update/{id}', [App\Http\Controllers\HospitalController::class, 'update']);
Route::delete('hospital-delete/{id}', [App\Http\Controllers\HospitalController::class, 'destroy']);

// Medical data related routes
Route::get('medical-datas', [App\Http\Controllers\MedicalCardController::class, 'index']);
Route::get('medical-data-show/{id}', [App\Http\Controllers\MedicalCardController::class, 'show']);
Route::post('medical-data-create', [App\Http\Controllers\MedicalCardController::class, 'store']);
Route::put('medical-data-update/{id}', [App\Http\Controllers\MedicalCardController::class, 'update']);
Route::delete('medical-data-delete/{id}', [App\Http\Controllers\MedicalCardController::class, 'destroy']);

