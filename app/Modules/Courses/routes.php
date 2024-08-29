<?php 

use App\Modules\Courses\Controllers\CourseController;
use App\Modules\Courses\Controllers\OtherController;



use App\Http\Middleware\UserLogging;

use Illuminate\Support\Facades\Route;



Route::middleware(['auth',UserLogging::class])->group(function () {

    Route::get('/courses/create', [CourseController::class, 'create'])->name('course.create');
    
    Route::post('/courses/create', [CourseController::class, 'store'])->name('course.store');

    Route::get('/courses/show', [CourseController::class, 'show'])->name('course.show');

    Route::get('/courses/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
    
    Route::post('/courses/edit/{id}', [CourseController::class, 'update'])->name('course.update');

    Route::get('/courses/delete/{id}', [CourseController::class, 'delete'])->name('course.delete');

    Route::get('/courses/list', [CourseController::class, 'list'])->name('course.list');

    Route::get('/courses/list/{id}', [CourseController::class, 'show_image'])->name('list.image');
    
        
    Route::get('/thumbnail/delete/{id}', [OtherController::class, 'thumbnail_delete'])->name('thumbnail.delete');

    Route::get('/thumbnail/show/{filename}', [OtherController::class, 'thumbnail_show'])->name('thumbnail.show');

    Route::post('/category/add', [OtherController::class, 'category_add']);
    
    Route::post('/tag/add', [OtherController::class, 'tag_add']);


});


