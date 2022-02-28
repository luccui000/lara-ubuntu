<?php

use App\Http\Controllers\Api\CPUUsageController;
use App\Http\Controllers\Api\FileManagerController;
use App\Http\Controllers\Image\{
    UploadController as ImageUploadController,
    CropController as ImageCropController
} ;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cpu-usage'], function() {
    Route::get('/', [CPUUsageController::class, 'index']);
});

Route::group(['prefix' => 'files'], function () {
   Route::post('/', [FileManagerController::class, 'index']);
});


Route::group(['prefix' => 'images'], function () {
   Route::post('upload', ImageUploadController::class);
   Route::get('crop', ImageCropController::class);
});
