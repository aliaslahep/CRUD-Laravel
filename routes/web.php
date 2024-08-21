<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\AccessLogController;

use App\Http\Controllers\PDFController;


use App\Http\Middleware\UserLogging;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified',UserLogging::class,'verified'])->name('dashboard');

Route::middleware(['auth',UserLogging::class])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/courses/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/courses/create', [CourseController::class, 'store'])->name('course.store');

    Route::get('/courses/show', [CourseController::class, 'show'])->name('course.show');

    Route::get('/courses/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
    Route::post('/courses/edit/{id}', [CourseController::class, 'update'])->name('course.update');

    Route::get('/courses/delete/{id}', [CourseController::class, 'delete'])->name('course.delete');

    Route::get('/courses/list', [CourseController::class, 'list'])->name('course.list');
    
    
    Route::get('/thumbnail/delete/{id}', [OtherController::class, 'thumbnail_delete'])->name('thumbnail.delete');

    Route::get('/thumbnail/show/{filename}', [OtherController::class, 'thumbnail_show'])->name('thumbnail.show');

    Route::post('/category/add', [OtherController::class, 'category_add']);
    Route::post('/tag/add', [OtherController::class, 'tag_add']);


});

Route::get('/access-log', [AccessLogController::class, 'access_log'])->name('access_log');
Route::post('/access-log', [AccessLogController::class, 'filter_log'])->name('filter_log');

Route::get('generate-pdf', [AccessLogController::class, 'generate_pdf']);



require __DIR__.'/auth.php';
