<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageController;

Route::prefix('images')->group(function () {
    Route::get('/', [ImageController::class, 'index']);         // Get all images
    Route::post('/store', [ImageController::class, 'store']);    // Store a new image
    Route::get('/{id}', [ImageController::class, 'show']);        // Get an image by ID
    Route::put('/{id}', [ImageController::class, 'update']);      // Update an image by ID
    Route::delete('/{id}', [ImageController::class, 'destroy']);  // Delete an image by ID
});

use App\Http\Controllers\PictureAnnouncementController;
// In your routes/api.php
Route::get('/announcements', [PictureAnnouncementController::class, 'getAnnouncements']);
Route::post('/announcements', [PictureAnnouncementController::class, 'store']);
Route::delete('/announcements/{id}', [PictureAnnouncementController::class, 'deleteAnnouncement']);
Route::put('/announcements/{id}', [PictureAnnouncementController::class, 'updateAnnouncement']);

use App\Http\Controllers\Cevent;
// In your routes/api.php
Route::get('/allevents', [Cevent::class, 'showEventslanding']);

