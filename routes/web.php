<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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


});

require __DIR__.'/auth.php';
