<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageController;
use App\Http\Controllers\PictureAnnouncementController;
use App\Http\Controllers\Cevent;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherAdvisoryController;

Route::prefix('images')->group(function () {
    Route::get('/', [ImageController::class, 'index']);         // Get all images
    Route::post('/store', [ImageController::class, 'store']);    // Store a new image
    Route::get('/{id}', [ImageController::class, 'show']);        // Get an image by ID
    Route::put('/{id}', [ImageController::class, 'update']);      // Update an image by ID
    Route::delete('/{id}', [ImageController::class, 'destroy']);  // Delete an image by ID
});

// In your routes/api.php
Route::get('/announcements', [PictureAnnouncementController::class, 'getAnnouncements']);
Route::post('/announcements', [PictureAnnouncementController::class, 'store']);
Route::delete('/announcements/{id}', [PictureAnnouncementController::class, 'deleteAnnouncement']);
Route::put('/announcements/{id}', [PictureAnnouncementController::class, 'updateAnnouncement']);

// In your routes/api.php
Route::get('/allevents', [Cevent::class, 'showEventslanding']);

// In your routes/api.php 
Route::get('/allsections', [SectionController::class, 'getAllSectionsByGrade']);
Route::get('/sections', [SectionController::class, 'getSectionByGrade']);

Route::get('/allsubjects', [SubjectController::class, 'getAllSubjectsByGrade']);

Route::get('/allteachers', [TeacherAdvisoryController::class, 'getAllAdviserByGrade']);
