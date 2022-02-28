<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FilesManager\IndexController as FilesManagerIndexController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/cpu-usage', function () {
   return view('cpu-usage.index');
})->name('cpu-usage.index');

Route::group(['prefix' => 'files-manager'], function() {
    Route::get('/', FilesManagerIndexController::class)->name('files-manager.index');
});
