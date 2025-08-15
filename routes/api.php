<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Example default route
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


use App\Http\Controllers\Api\ProfessionClinicController;

Route::apiResource('profession-clinics', ProfessionClinicController::class);


use App\Http\Controllers\Api\HeroSectionController;

Route::apiResource('hero-sections', HeroSectionController::class);


use App\Http\Controllers\Api\MakeAnAppointmentController;

Route::apiResource('make-appointments', MakeAnAppointmentController::class);

use App\Http\Controllers\Api\CertifiedDentistController;

Route::apiResource('certified-dentists', CertifiedDentistController::class);

use App\Http\Controllers\Api\PlanController;

Route::apiResource('plans', PlanController::class);


use App\Http\Controllers\Api\StatisticController;

Route::apiResource('statistics', StatisticController::class);

use App\Http\Controllers\Api\DentalNewsController;

Route::apiResource('dental-news', DentalNewsController::class);

Route::apiResource('our-services', \App\Http\Controllers\Api\OurServiceController::class);

use App\Http\Controllers\Api\ProfessionalDoctorController;

Route::apiResource('professional-doctors', ProfessionalDoctorController::class);


use App\Http\Controllers\API\CommentController;

Route::apiResource('comments', CommentController::class);
