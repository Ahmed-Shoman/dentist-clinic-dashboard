<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Api\ProfessionClinicController;
use App\Http\Controllers\Api\HeroSectionController;
use App\Http\Controllers\Api\MakeAnAppointmentController;
use App\Http\Controllers\Api\CertifiedDentistController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\StatisticController;
use App\Http\Controllers\Api\DentalNewsController;
use App\Http\Controllers\Api\OurServiceController;
use App\Http\Controllers\Api\ProfessionalDoctorController;
use App\Http\Controllers\Api\BlogPostController;
use App\Http\Controllers\Api\DentistFactController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\CategoryController;







// Route::middleware(['language', 'auth:sanctum'])->group(function () {
//     Route::apiResource('doctors', DoctorController::class);
//     Route::apiResource('profession-clinics', ProfessionClinicController::class);
//     Route::apiResource('hero-sections', HeroSectionController::class);
//     Route::apiResource('make-appointments', MakeAnAppointmentController::class);
//     Route::apiResource('certified-dentists', CertifiedDentistController::class);
//     Route::apiResource('plans', PlanController::class);
//     Route::apiResource('statistics', StatisticController::class);
//     Route::apiResource('dental-news', DentalNewsController::class);
//     Route::apiResource('our-services', OurServiceController::class);
//     Route::apiResource('professional-doctors', ProfessionalDoctorController::class);
//     Route::apiResource('dentist-facts', DentistFactController::class);
//     Route::apiResource('comments', CommentController::class);
//     Route::get('blog-posts', [BlogPostController::class, 'index']);
// });

  Route::apiResource('doctors', DoctorController::class);
    Route::apiResource('profession-clinics', ProfessionClinicController::class);
    Route::apiResource('hero-sections', HeroSectionController::class);
    Route::apiResource('make-appointments', MakeAnAppointmentController::class);
    Route::apiResource('certified-dentists', CertifiedDentistController::class);
    Route::apiResource('plans', PlanController::class);
    Route::apiResource('statistics', StatisticController::class);
    Route::apiResource('dental-news', DentalNewsController::class);
    Route::apiResource('our-services', OurServiceController::class);
    Route::apiResource('professional-doctors', ProfessionalDoctorController::class);
    Route::apiResource('dentist-facts', DentistFactController::class);
    Route::apiResource('comments', CommentController::class);
    Route::get('blog-posts', [BlogPostController::class, 'index']);
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('profession-clinics', ProfessionClinicController::class);